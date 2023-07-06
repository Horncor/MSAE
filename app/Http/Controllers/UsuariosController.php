<?php

namespace App\Http\Controllers;

use App\Models\EstadoPersona;
use App\Models\EstadoUsuario;
use App\Models\Persona;
use App\Models\Telefono;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function registroDeUsuario(Request $request)
    {
        $validacionDeInformacion = $request->validate([
            'cedula' => 'required|string|max:12',
            'nombre' => 'required|string|max:60',
            'apellido1' => 'required|string|max:50',
            'apellido2' => 'required|string|max:50',
            'fechaDeNacimiento' => 'required|date',
            'telefono' => 'string|max:12',
            'correo' => 'required|email|max:120',
            'usuario' => 'required|string|max:60',
            'contrasena' => 'required|string|max:12',
            'tipoUsuario'=> 'required|numeric'
        ]);

        if (!$validacionDeInformacion) {
            return;
        }

        $cedula = $request->cedula;
        $nombre = $request->nombre;
        $apellido1 = $request->apellido1;
        $apellido2 = $request->apellido2;
        $fechaDeNacimiento = $request->fechaDeNacimiento;
        $numeroDeTelefono = $request->telefono;
        $correo = $request->correo;
        $nombreDeUsuario = $request->usuario;
        $contrasena = $request->contrasena;
        $tipoUsuario = $request->tipoUsuario;

        /* Proceso para guardar primero los datos de persona  */
        $persona = new Persona();
        $persona->CEDULA = $cedula;
        $persona->NOMBRE = $nombre;
        $persona->APELLIDO1 = $apellido1;
        $persona->APELLIDO2 = $apellido2;
        $persona->FECHA_DE_NACIMIENTO = $fechaDeNacimiento;
        $persona->ESTADO = EstadoPersona::ACTIVO;
        $persona->setConnection('sqlsrv');
        $persona->save();

        /* Proceso para guardar el telefono de la persona */
        if ($numeroDeTelefono != '') {
            $telefono = new Telefono();
            $telefono->NOMBRE = 'PRINCIPAL';
            $telefono->NUMERO_TELEFONO = $numeroDeTelefono;
            $telefono->setConnection('sqlsrv');
            $telefono->save();
            /* Proceso para actualizar/agregar el telefono a la persona registrada */
            Persona::on('sqlsrv')->where('ID', $persona->id)->update(["ID_TELEFONO" => $telefono->id]);
        }

        $usuario = new Usuario();
        $usuario->NOMBRE = $nombreDeUsuario;
        $usuario->CONTRASENA = $contrasena;
        $usuario->EMAIL = $correo;
        $usuario->ID_REGISTRADO = $persona->id;
        $usuario->TIPO_USUARIO = $tipoUsuario;
        $usuario->ESTADO = EstadoUsuario::ACTIVO;
        $usuario->setConnection('sqlsrv');
        $usuario->save();
    }
}
