<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "USUARIO";
    protected $conntection = "sqlsrv";

    public $timestamps = true;

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'NOMBRE',
        'CONTRASENA',
        'TIPO_USUARIO',
        'EMAIL',
        'ESTADO'
    ];

    public function getIdAttribute(){
        return $this->attributes['ID'];
    }
    public function getUserAttribute(){
        return $this->attributes['NOMBRE'];
    }
    public function getPasswordAttribute(){
        return $this->attributes['CONTRASENA'];
    }
    public function getTypeUserAttribute(){
        return $this->attributes['TIPO_USUARIO'];
    }
    public function getEmailAttribute(){
        return $this->attributes['EMAIL'];
    }
    public function getEstatusAttribute(){
        return $this->attributes['ESTADO'];
    }
}
