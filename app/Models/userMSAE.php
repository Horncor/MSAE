<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userMSAE extends Model
{
    protected $table = "USUARIO";

    public $timestamps = true;

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'ID_PERSONA',
        'NOMBRE',
        'CONTRASENA',
        'TIPO_USUARIO',
        'EMAIL',
        'ESTADO',
        'NIVEL_UNIVERSITARIO',
        'CURSO_ENCARGADO',
        'UNIVERSIDAD'
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
    public function getCourseInChargeAttribute(){
        return $this->attributes['CURSO_ENCARGADO'];
    }
    public function getUniversityLevelAttribute(){
        return $this->attributes['NIVEL_UNIVERSITARIO'];
    }
    public function getUniversityAttribute(){
        return $this->attributes['UNIVERSIDAD'];
    }
}
