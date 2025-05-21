<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller{
    public function contactanos_form()
    {
        return view('contactanos');
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'correo' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        $datos = $request->only('nombre', 'categoria', 'correo', 'mensaje');

        $cuerpo = "Nombre: {$datos['nombre']}\n";
        $cuerpo .= "Correo: {$datos['correo']}\n";
        $cuerpo .= "Categoría: {$datos['categoria']}\n";
        $cuerpo .= "Mensaje:\n{$datos['mensaje']}";

        Mail::raw($cuerpo, function ($message) use ($datos) {
            $message->to('aandrezz40@gmail.com')
                    ->subject('Nuevo mensaje de contacto de PediYÁ');
        });

        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
