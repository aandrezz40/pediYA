<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Helpers\TenderoStatus;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Barrio;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CambioEstadoPedido;

class TenderoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Verificar estado del tendero
        if (TenderoStatus::needsStoreRegistration($user)) {
            return redirect()->route('tendero.registroTienda')
                ->with('warning', TenderoStatus::getStatusMessage($user));
        }

        return view('tendero.homeTendero');
    }

    public function registroTienda()
    {
        $user = auth()->user();
        
        // Solo permitir acceso si necesita registrar tienda
        if (!TenderoStatus::needsStoreRegistration($user)) {
            return redirect()->route('homeTendero');
        }

        // Obtener barrios para el formulario
        $barrios = Barrio::all();

        return view('tendero.registroTienda', compact('barrios'));
    }

    public function storeRegistroTienda(Request $request)
    {
        $user = auth()->user();
        
        // Validar que el usuario necesite registrar tienda
        if (!TenderoStatus::needsStoreRegistration($user)) {
            return redirect()->route('homeTendero');
        }

        // Validar datos del formulario
        $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'address_line_1' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'delivery_contact_phone' => 'nullable|string|max:20',
            'offers_delivery' => 'boolean',
            'dias' => 'nullable|array',
            'payment_methods' => 'required|array|min:1',
            'payment_methods.*' => 'integer|in:1,2,3,4,5,6',
            'runt_number' => 'nullable|string|max:100',
            'chamber_of_commerce_registration' => 'nullable|string|max:100',
            'documento_identidad' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'documento_camara_comercio' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'authorization' => 'required|accepted',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'payment_methods.required' => 'Debes seleccionar al menos un método de pago.',
            'payment_methods.min' => 'Debes seleccionar al menos un método de pago.',
            'documento_identidad.required' => 'Debes subir tu documento de identidad.',
            'documento_identidad.file' => 'El documento de identidad debe ser un archivo.',
            'documento_identidad.mimes' => 'El documento de identidad debe ser PDF, JPG, JPEG o PNG.',
            'documento_identidad.max' => 'El documento de identidad no puede superar 5MB.',
            'documento_camara_comercio.required' => 'Debes subir el registro de Cámara de Comercio.',
            'documento_camara_comercio.file' => 'El registro de Cámara de Comercio debe ser un archivo.',
            'documento_camara_comercio.mimes' => 'El registro de Cámara de Comercio debe ser PDF, JPG, JPEG o PNG.',
            'documento_camara_comercio.max' => 'El registro de Cámara de Comercio no puede superar 5MB.',
            'authorization.required' => 'Debes aceptar la autorización para continuar.',
            'authorization.accepted' => 'Debes aceptar la autorización para continuar.',
        ]);

        // Procesar horarios y convertirlos a string
        $schedule = $this->processSchedule($request);

        // Preparar datos de la tienda
        $storeData = [
            'name' => $request->store_name,
            'description' => $request->description,
            'address_street' => $request->address_line_1,
            'address_neighborhood' => $request->neighborhood,
            'delivery_contact_phone' => $request->delivery_contact_phone,
            'offers_delivery' => $request->offers_delivery ?? false,
            'schedule' => $schedule,
            'runt_number' => $request->runt_number,
            'chamber_of_commerce_registration' => $request->chamber_of_commerce_registration,
        ];

        // Procesar imagen si se subió
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('store-logos', 'public');
            $storeData['logo_path'] = $logoPath;
        }

        // Crear la tienda
        $store = $user->store()->create($storeData);

        // Guardar los métodos de pago seleccionados
        if ($request->has('payment_methods') && is_array($request->payment_methods)) {
            $store->paymentMethods()->attach($request->payment_methods);
        }

        // Procesar y guardar documentos
        $documentos = [];
        
        if ($request->hasFile('documento_identidad')) {
            $documentoIdentidadPath = $request->file('documento_identidad')->store('documentos/identidad', 'public');
            $documentos['identidad'] = $documentoIdentidadPath;
        }
        
        if ($request->hasFile('documento_camara_comercio')) {
            $documentoCamaraPath = $request->file('documento_camara_comercio')->store('documentos/camara_comercio', 'public');
            $documentos['camara_comercio'] = $documentoCamaraPath;
        }

        // Enviar documentos por correo
        try {
            $this->enviarDocumentosPorCorreo($user, $store, $documentos);
            
            Log::info('Documentos de tienda enviados por correo exitosamente', [
                'user_id' => $user->id,
                'store_id' => $store->id,
                'documentos' => array_keys($documentos)
            ]);
        } catch (\Exception $e) {
            Log::error('Error al enviar documentos por correo', [
                'user_id' => $user->id,
                'store_id' => $store->id,
            ]);
        }

        // Actualizar estado del usuario a activo (1)
        $user->update(['is_active' => TenderoStatus::ACTIVE]);

        return redirect()->route('tendero.homeTendero')
            ->with('success', 'Tienda registrada correctamente. Los documentos han sido enviados para verificación. ¡Bienvenido!');
    }

    /**
     * Procesar los horarios del formulario y convertirlos a string
     */
    private function processSchedule($request)
    {
        $dias = $request->input('dias', []);
        $scheduleParts = [];

        $diasMap = [
            'Lunes' => 'lunes',
            'Martes' => 'martes', 
            'Miércoles' => 'miercoles',
            'Jueves' => 'jueves',
            'Viernes' => 'viernes',
            'Sábado' => 'sabado',
            'Domingo' => 'domingo'
        ];

        foreach ($dias as $dia) {
            $diaKey = $diasMap[$dia] ?? strtolower($dia);
            $horaInicio = $request->input("hora_inicio_{$diaKey}");
            $horaFin = $request->input("hora_fin_{$diaKey}");

            if ($horaInicio && $horaFin) {
                $horaInicioFormatted = $this->formatTime($horaInicio);
                $horaFinFormatted = $this->formatTime($horaFin);
                $scheduleParts[] = "{$dia}: {$horaInicioFormatted} - {$horaFinFormatted}";
            }
        }

        return implode(', ', $scheduleParts);
    }

    /**
     * Parsear horarios de la base de datos
     */
    public static function parseSchedule($schedule)
    {
        if (empty($schedule)) return [];
        
        $horarios = [];
        $parts = explode(', ', $schedule);
        
        foreach ($parts as $part) {
            // Acepta 1 o 2 dígitos, AM/PM en mayúsculas o minúsculas, con o sin puntos
            if (preg_match('/([^:]+):\s*(\d{1,2}:\d{2}\s*(?:[AaPp]\.?[Mm]\.?)?)\s*-\s*(\d{1,2}:\d{2}\s*(?:[AaPp]\.?[Mm]\.?)?)/', $part, $matches)) {
                $dia = trim($matches[1]);
                $horaInicio = trim($matches[2]);
                $horaFin = trim($matches[3]);
                $horarios[$dia] = [
                    'inicio' => $horaInicio,
                    'fin' => $horaFin
                ];
            }
        }
        
        return $horarios;
    }

    /**
     * Convertir hora de formato 12h a formato 24h para selects
     */
    private function convertTo24Hour($time12h)
    {
        if (empty($time12h)) return '';
        
        $time = trim($time12h);
        $period = substr($time, -2);
        $time = substr($time, 0, -3); // Remover AM/PM
        
        list($hour, $minute) = explode(':', $time);
        $hour = (int)$hour;
        
        if ($period === 'PM' && $hour !== 12) {
            $hour += 12;
        } elseif ($period === 'AM' && $hour === 12) {
            $hour = 0;
        }
        
        return sprintf('%02d:%02d', $hour, $minute);
    }

    /**
     * Formatear hora de formato 24h a formato legible
     */
    private function formatTime($time)
    {
        if (empty($time)) return '';
        
        $hour = (int)$time;
        $minute = 0;
        
        if (strpos($time, ':') !== false) {
            list($hour, $minute) = explode(':', $time);
            $hour = (int)$hour;
            $minute = (int)$minute;
        }

        if ($hour >= 12) {
            $period = 'PM';
            if ($hour > 12) $hour -= 12;
        } else {
            $period = 'AM';
            if ($hour == 0) $hour = 12;
        }

        return sprintf('%d:%02d %s', $hour, $minute, $period);
    }

    /**
     * Enviar documentos de la tienda por correo
     */
    private function enviarDocumentosPorCorreo($user, $store, $documentos)
    {
        $cuerpo = "Nuevo registro de tienda en PediYÁ\n";
        $cuerpo .= "=====================================\n\n";
        $cuerpo .= "Información del tendero:\n";
        $cuerpo .= "------------------------\n";
        $cuerpo .= "Nombre: {$user->name}\n";
        $cuerpo .= "Email: {$user->email}\n";
        $cuerpo .= "Teléfono: " . ($user->phone ?? 'No especificado') . "\n\n";
        
        $cuerpo .= "Información de la tienda:\n";
        $cuerpo .= "-------------------------\n";
        $cuerpo .= "Nombre: {$store->name}\n";
        $cuerpo .= "Dirección: {$store->address_street}\n";
        $cuerpo .= "Barrio: {$store->address_neighborhood}\n";
        $cuerpo .= "Descripción: " . ($store->description ?? 'No especificada') . "\n";
        $cuerpo .= "Teléfono de contacto: " . ($store->delivery_contact_phone ?? 'No especificado') . "\n";
        $cuerpo .= "RUNT: " . ($store->runt_number ?? 'No especificado') . "\n";
        $cuerpo .= "Registro Cámara de Comercio: " . ($store->chamber_of_commerce_registration ?? 'No especificado') . "\n";
        $cuerpo .= "Horarios: " . ($store->schedule ?? 'No especificados') . "\n";
        $cuerpo .= "Ofrece domicilio: " . ($store->offers_delivery ? 'Sí' : 'No') . "\n\n";
        
        $cuerpo .= "Métodos de pago aceptados:\n";
        $cuerpo .= "--------------------------\n";
        $paymentMethods = $store->paymentMethods;
        if ($paymentMethods->count() > 0) {
            foreach ($paymentMethods as $method) {
                $cuerpo .= "- {$method->name}\n";
            }
        } else {
            $cuerpo .= "No especificados\n";
        }
        
        $cuerpo .= "\nDocumentos adjuntos:\n";
        $cuerpo .= "-------------------\n";
        if (isset($documentos['identidad'])) {
            $cuerpo .= "- Documento de identidad\n";
        }
        if (isset($documentos['camara_comercio'])) {
            $cuerpo .= "- Registro de Cámara de Comercio\n";
        }
        
        $cuerpo .= "\nFecha de registro: " . now()->format('d/m/Y H:i:s') . "\n";
        $cuerpo .= "=====================================\n";
        $cuerpo .= "Este registro fue enviado automáticamente desde PediYÁ.";

        Mail::raw($cuerpo, function ($message) use ($user, $store, $documentos) {
            $message->to('aandrezz40@gmail.com')
                    ->subject('Nuevo registro de tienda - ' . $store->name)
                    ->replyTo($user->email, $user->name);

            // Adjuntar documentos
            if (isset($documentos['identidad'])) {
                $message->attach(storage_path('app/public/' . $documentos['identidad']), [
                    'as' => 'documento_identidad_' . $user->name . '.' . pathinfo($documentos['identidad'], PATHINFO_EXTENSION),
                    'mime' => 'application/octet-stream'
                ]);
            }
            
            if (isset($documentos['camara_comercio'])) {
                $message->attach(storage_path('app/public/' . $documentos['camara_comercio']), [
                    'as' => 'registro_camara_comercio_' . $store->name . '.' . pathinfo($documentos['camara_comercio'], PATHINFO_EXTENSION),
                    'mime' => 'application/octet-stream'
                ]);
            }
        });
    }

    /**
     * Mostrar lista de pedidos del tendero
     */
    public function pedidos()
    {
        $user = auth()->user();
        $store = $user->store;
        
        if (!$store) {
            return redirect()->route('tendero.registroTienda');
        }

        $orders = Order::where('store_id', $store->id)
            ->where('status', '!=', 'inactive')
            ->with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tendero.pedidos', compact('orders', 'store'));
    }

    /**
     * Cambiar estado de un pedido
     */
    public function cambiarEstadoPedido(Request $request, Order $order)
    {
        $user = auth()->user();
        $store = $user->store;
        
        // Verificar que el pedido pertenece a la tienda del tendero
        if ($order->store_id !== $store->id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate([
            'nuevo_estado' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled'
        ]);

        $estadoAnterior = $order->status;
        $nuevoEstado = $request->nuevo_estado;

        // Actualizar el estado del pedido
        $order->status = $nuevoEstado;
        $order->save();

        // Enviar notificación al cliente sobre el cambio de estado
        $order->user->notify(new CambioEstadoPedido($order, $estadoAnterior, $nuevoEstado));

        return response()->json([
            'success' => true,
            'message' => 'Estado del pedido actualizado correctamente',
            'nuevo_estado' => $nuevoEstado
        ]);
    }

    /**
     * Ver detalles de un pedido específico
     */
    public function verPedido(Order $order)
    {
        $user = auth()->user();
        $store = $user->store;
        
        // Verificar que el pedido pertenece a la tienda del tendero
        if ($order->store_id !== $store->id) {
            abort(403, 'No autorizado');
        }

        $order->load(['user', 'orderItems.product']);

        return view('tendero.detallePedido', compact('order'));
    }

    /**
     * Actualizar información básica de la tienda
     */
    public function updateStoreBasicInfo(Request $request)
    {
        \Log::info('Entró al método updateStoreBasicInfo');
        $user = auth()->user();
        $store = $user->store;
        
        if (!$store) {
            return redirect()->back()->with('error', 'No tienes una tienda registrada.');
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'store_name' => 'required|string|max:255',
            'delivery_contact_phone' => 'nullable|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            // Validación para horarios
            'schedule_monday' => 'nullable|boolean',
            'schedule_tuesday' => 'nullable|boolean',
            'schedule_wednesday' => 'nullable|boolean',
            'schedule_thursday' => 'nullable|boolean',
            'schedule_friday' => 'nullable|boolean',
            'schedule_saturday' => 'nullable|boolean',
            'schedule_sunday' => 'nullable|boolean',
            'monday_start' => 'nullable|string',
            'monday_end' => 'nullable|string',
            'tuesday_start' => 'nullable|string',
            'tuesday_end' => 'nullable|string',
            'wednesday_start' => 'nullable|string',
            'wednesday_end' => 'nullable|string',
            'thursday_start' => 'nullable|string',
            'thursday_end' => 'nullable|string',
            'friday_start' => 'nullable|string',
            'friday_end' => 'nullable|string',
            'saturday_start' => 'nullable|string',
            'saturday_end' => 'nullable|string',
            'sunday_start' => 'nullable|string',
            'sunday_end' => 'nullable|string',
            // // Validación para métodos de pago
            // 'payment_methods' => 'required|array|min:1',
            // 'payment_methods.*' => 'integer|in:1,2,3,4,5,6',
        ], [
            // 'payment_methods.required' => 'Debes seleccionar al menos un método de pago.',
            // 'payment_methods.min' => 'Debes seleccionar al menos un método de pago.',
        ]);

        // Actualizar información básica
        $store->update([
            'name' => $request->store_name,
            'delivery_contact_phone' => $request->delivery_contact_phone,
            'address_street' => $request->address_line_1,
            'description' => $request->description,
        ]);

        // Actualizar imagen si se subió una nueva
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Elimina la imagen anterior si existe y el path es válido
            if ($store->logo_path && \Storage::disk('public')->exists($store->logo_path)) {
                \Storage::disk('public')->delete($store->logo_path);
            }

            // Genera un nombre único para evitar caché y conflictos
            $extension = $file->getClientOriginalExtension();
            $filename = 'store_' . $store->id . '_' . time() . '.' . $extension;

            // Guarda la nueva imagen
            $path = $file->storeAs('store-logos', $filename, 'public');

            // Actualiza el campo logo_path SIEMPRE
            $store->logo_path = $path;
            $store->save();

            \Log::info('Imagen guardada en: ' . $path);
            \Log::info('Campo logo_path actualizado en la base de datos: ' . $store->logo_path);
        }

        // Actualizar horarios
        $schedule = $this->processScheduleFromForm($request);
        $store->update(['schedule' => $schedule]);

        // Sincronizar métodos de pago
        $store->paymentMethods()->sync($request->payment_methods);

        return redirect()->back();
    }

    /**
     * Actualizar horarios de la tienda
     */
    public function updateStoreSchedule(Request $request)
    {
        \Log::info('Request recibido en updateStoreSchedule', $request->all());
        $user = auth()->user();
        $store = $user->store;
        
        if (!$store) {
            return redirect()->back()->with('error', 'No tienes una tienda registrada.');
        }

        // Solo validación de horarios y domicilio
        $request->validate([
            'offers_delivery' => 'nullable|boolean',
            // Validación para horarios
            'dias' => 'nullable|array',
            'lunes_start' => 'nullable|string',
            'lunes_end' => 'nullable|string',
            'martes_start' => 'nullable|string',
            'martes_end' => 'nullable|string',
            'miercoles_start' => 'nullable|string',
            'miercoles_end' => 'nullable|string',
            'jueves_start' => 'nullable|string',
            'jueves_end' => 'nullable|string',
            'viernes_start' => 'nullable|string',
            'viernes_end' => 'nullable|string',
            'sabado_start' => 'nullable|string',
            'sabado_end' => 'nullable|string',
            'domingo_start' => 'nullable|string',
            'domingo_end' => 'nullable|string',
        ]);

        // Actualizar horarios
        $schedule = $this->processScheduleFromForm($request);
        $store->update([
            'schedule' => $schedule,
            'offers_delivery' => $request->has('offers_delivery') ? 1 : 0,
        ]);
        \Log::info('Store actualizado', $store->toArray());

        return redirect()->back();
    }

    /**
     * Actualizar métodos de pago de la tienda
     */
    public function updateStorePaymentMethods(Request $request)
    {
        $user = auth()->user();
        $store = $user->store;
        
        if (!$store) {
            return redirect()->back()->with('error', 'No tienes una tienda registrada.');
        }

        $request->validate([
            'payment_methods' => 'nullable|array',
            'payment_methods.*' => 'integer|in:1,2,3,4,5,6',
        ]);

        // Sincronizar métodos de pago
        // Si no se envía payment_methods, se asume array vacío (eliminar todos)
        $paymentMethods = $request->input('payment_methods', []);
        $store->paymentMethods()->sync($paymentMethods);

        return redirect()->back()->with('success', 'Métodos de pago actualizados correctamente.');
    }

    /**
     * Procesar horarios desde el formulario de edición
     */
    private function processScheduleFromForm($request)
    {
        $dias = [
            'Lunes' => 'lunes',
            'Martes' => 'martes',
            'Miércoles' => 'miercoles',
            'Jueves' => 'jueves',
            'Viernes' => 'viernes',
            'Sábado' => 'sabado',
            'Domingo' => 'domingo'
        ];

        $scheduleParts = [];

        foreach ($dias as $diaNombre => $diaKey) {
            $checkboxName = "schedule_{$diaKey}";
            $startName = "{$diaKey}_start";
            $endName = "{$diaKey}_end";

            if ($request->has($checkboxName) && $request->input($checkboxName)) {
                $horaInicio = $request->input($startName);
                $horaFin = $request->input($endName);

                if ($horaInicio && $horaFin) {
                    $horaInicioFormatted = $this->formatTime($horaInicio);
                    $horaFinFormatted = $this->formatTime($horaFin);
                    $scheduleParts[] = "{$diaNombre}: {$horaInicioFormatted} - {$horaFinFormatted}";
                }
            }
        }

        return implode(', ', $scheduleParts);
    }
}
