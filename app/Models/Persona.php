<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "PERSONA";
    protected $conntection = "sqlsrv";

    public $timestamps = true;

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'CEDULA',
        'NOMBRE',
        'APELLIDO1',
        'APELLIDO2',
        'FECHA_DE_NACIMIENTO',
        'ESTADO'
    ];

    public function getIdAttribute(){
        return $this->attributes['ID'];
    }
    public function getIdentificationAttribute(){
        return $this->attributes['CEDULA'];
    }
    public function getNameAttribute(){
        return $this->attributes['NOMBRE'];
    }
    public function getLastName1Attribute(){
        return $this->attributes['APELLIDO1'];
    }
    public function getLastName2Attribute(){
        return $this->attributes['APELLIDO2'];
    }
    public function getBirthDateAttribute(){
        return $this->attributes['FECHA_DE_NACIMIENTO'];
    }
    public function getStatusAttribute(){
        return $this->attributes['ESTADO'];
    }
}
