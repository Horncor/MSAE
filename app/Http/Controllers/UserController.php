<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionCuenta;
use App\Models\statusUser;
use App\Models\statusPerson;
use App\Models\person;
use App\Models\phone;
use App\Models\userMSAE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userStorage(Request $request)
    {
        try {
            /*      $informationValidation = $request->validate([
                'identificationCard' => 'required|string|max:12',
                'name' => 'required|string|max:60',
                'lastName1' => 'required|string|max:50',
                'lastName2' => 'required|string|max:50',
                'birthDate' => 'required|date',
                'phone' => 'string|max:12',
                'email' => 'required|email|max:120',
                'user' => 'required|string|max:60',
                'password' => 'required|string|max:12',
                'userType' => 'required|numeric'
            ]);

            if (!$informationValidation) {
                return;
            } */
            $identificationCard = $request->identificationCard;
            $name = $request->name;
            $lastName1 = $request->lastName1;
            $lastName2 = $request->lastName2;
            $birthDate = $request->birthDate;
            $phonePerson = $request->phone;
            $email = $request->email;
            $userName = $request->user;
            $password = $request->password;
            $userType = intval($request->userType);


            DB::connection('msae')->beginTransaction();

            /* Proceso para guardar primero los datos de persona  */
            $person = new person();
            $person->CEDULA = $identificationCard;
            $person->NOMBRE = $name;
            $person->APELLIDO1 = $lastName1;
            $person->APELLIDO2 = $lastName2;
            $person->FECHA_DE_NACIMIENTO = $birthDate;
            $person->ESTADO = statusPerson::ACTIVO;
            $person->setConnection('msae');
            $person->save();


            /* Proceso para guardar el telefono de la persona */
            if ($phonePerson != '') {
                $phone = new phone();
                $phone->NOMBRE = 'PRINCIPAL';
                $phone->ID_PERSONA = $person->id;
                $phone->NUMERO_TELEFONO = $phonePerson;
                $phone->setConnection('msae');
                $phone->save();
            }

            /* Proceso para guardar el usuario */
            $token = Str::random(40);
            $user = new userMSAE();
            $user->NOMBRE = $userName;
            $user->CONTRASENA = $password;
            $user->EMAIL = $email;
            $user->TIPO_USUARIO = $userType;
            $user->ESTADO = statusUser::INACTIVO;
            $user->TOKEN = $token;
            $user->ID_PERSONA = $person->id;
            $user->setConnection('msae');
            $user->save();
            DB::connection('msae')->commit();
            
            $urlConfirmacion = route('confirmar-cuenta', ['token' => $user->token]);

            Mail::to($user->email)->send(new ConfirmacionCuenta($urlConfirmacion));
            return view('home');
        } catch (\Throwable $th) {
            DB::connection('msae')->rollback();
            Log::error($th);
            return response($th, 500);
        }
    }

    public function verificEmail($user)
    {
        $email = $user->email;
        $token = Str::random(40);
        $userToken = userMSAE::on('msae')->update([]);
    }
}
