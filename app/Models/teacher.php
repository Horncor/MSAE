<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $table = "PROFESOR";
    protected $conntection = "sqlsrv";

    public $timestamps = true;

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'ID_PERSONA',
        'CURSO_ENCARGADO',
        'NIVEL_UNIVERSITARIO'
    ];

    public function getIdAttribute(){
        return $this->attributes['ID'];
    }
    public function getIdPersonAttribute(){
        return $this->attributes['ID_PERSONA'];
    }
    public function getCourseInChargeAttribute(){
        return $this->attributes['CURSO_ENCARGADO'];
    }
    public function getUniversityLevelAttribute(){
        return $this->attributes['NIVEL_UNIVERSITARIO'];
    }
}
