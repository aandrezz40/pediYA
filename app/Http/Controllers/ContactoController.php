<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactoController extends Controller{
    public function contactanos_form()
    {
        return view('contactanos');
    }

    public function enviar(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'categoria' => 'required|string|in:Servicio técnico,Reclamo,Sugerencia,Otro',
                'correo' => 'required|email|max:255',
                'mensaje' => 'required|string|max:1000',
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'categoria.required' => 'Debes seleccionar una categoría.',
                'categoria.in' => 'La categoría seleccionada no es válida.',
                'correo.required' => 'El correo electrónico es obligatorio.',
                'correo.email' => 'El correo electrónico debe tener un formato válido.',
                'mensaje.required' => 'El mensaje es obligatorio.',
                'mensaje.max' => 'El mensaje no puede tener más de 1000 caracteres.',
            ]);

            $datos = $request->only('nombre', 'categoria', 'correo', 'mensaje');

            // Crear el cuerpo del mensaje
            $cuerpo = "Nuevo mensaje de contacto de PediYÁ\n";
            $cuerpo .= "=====================================\n\n";
            $cuerpo .= "Nombre: {$datos['nombre']}\n";
            $cuerpo .= "Correo: {$datos['correo']}\n";
            $cuerpo .= "Categoría: {$datos['categoria']}\n";
            $cuerpo .= "Fecha: " . now()->format('d/m/Y H:i:s') . "\n\n";
            $cuerpo .= "Mensaje:\n";
            $cuerpo .= "--------\n";
            $cuerpo .= $datos['mensaje'] . "\n\n";
            $cuerpo .= "=====================================\n";
            $cuerpo .= "Este mensaje fue enviado desde el formulario de contacto de PediYÁ.";

            // Enviar el correo
            Mail::raw($cuerpo, function ($message) use ($datos) {
                $message->to('aandrezz40@gmail.com')
                        ->subject('Nuevo mensaje de contacto de PediYÁ - ' . $datos['categoria'])
                        ->replyTo($datos['correo'], $datos['nombre']);
            });

            // Log del envío exitoso
            Log::info('Correo de contacto enviado exitosamente', [
                'nombre' => $datos['nombre'],
                'correo' => $datos['correo'],
                'categoria' => $datos['categoria']
            ]);

            return back()->with('success', '¡Tu mensaje ha sido enviado correctamente! Te responderemos pronto.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log de errores de validación
            Log::warning('Error de validación en formulario de contacto', [
                'errors' => $e->errors(),
                'data' => $request->except('_token')
            ]);
            
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            // Log de errores generales
            Log::error('Error al enviar correo de contacto', [
                'error' => $e->getMessage(),
                'data' => $request->except('_token')
            ]);
            
            return back()->with('error', 'Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente más tarde.')->withInput();
        }
    }
}
