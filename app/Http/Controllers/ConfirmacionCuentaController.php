<?php

namespace App\Http\Controllers;

use App\Models\statusUser;
use App\Models\userMSAE;
use Illuminate\Http\Request;

class ConfirmacionCuentaController extends Controller
{
    public function confirmar($token)
    {
        $usuario = userMSAE::on('msae')->where('TOKEN', $token)->first();

        if ($usuario) {
            $usuario->TOKEN = null;
            $usuario->estado = statusUser::ACTIVO;
            $usuario->save();

            // Realizar cualquier otra acción necesaria después de la confirmación

            return redirect()->route('home')->with('success', 'Tu cuenta ha sido confirmada exitosamente.');
        }

        return redirect()->route('home')->with('error', 'El enlace de confirmación no es válido.');
    }
}