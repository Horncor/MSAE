<?php

namespace App\Http\Controllers;

use App\Models\statusUser;
use App\Models\statusPerson;
use App\Models\person;
use App\Models\phone;
use App\Models\userMSAE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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


            DB::connection('sqlsrv')->beginTransaction();

            /* Proceso para guardar primero los datos de persona  */
            $person = new person();
            $person->CEDULA = $identificationCard;
            $person->NOMBRE = $name;
            $person->APELLIDO1 = $lastName1;
            $person->APELLIDO2 = $lastName2;
            $person->FECHA_DE_NACIMIENTO = $birthDate;
            $person->ESTADO = statusPerson::ACTIVO;
            $person->setConnection('sqlsrv');
            $person->save();


            /* Proceso para guardar el telefono de la persona */
            if ($phonePerson != '') {
                $phone = new phone();
                $phone->NOMBRE = 'PRINCIPAL';
                $phone->NUMERO_TELEFONO = $phonePerson;
                $phone->setConnection('sqlsrv');
                $phone->save();

                /* Proceso para actualizar/agregar el telefono a la persona registrada */
                person::on('sqlsrv')->where('ID', $person->id)->update(["ID_TELEFONO" => $phone->id]);
            }

            /* Proceso para guardar el usuario */
            $user = new userMSAE();
            $user->login = $userName;
            $user->contrasena = $password;
            $user->EMAIL = $email;
            $user->TIPO_USUARIO = $userType;
            $user->ESTADO = statusUser::ACTIVO;
            $user->ID_REGISTRADO = $person->id;
            $user->setConnection('sqlsrv');
            $user->save();
            DB::connection('sqlsrv')->commit();
            return view('home');
        } catch (\Throwable $th) {
            DB::connection('sqlsrv')->rollback();
            Log::error($th);
            return response($th, 500);
        }
    }

    public function verificEmail($user)
    {
        $email = $user->email;
        $token = Str::random(40);
        $userToken = userMSAE::on('sqlsrv')->update([]);
    }
}
