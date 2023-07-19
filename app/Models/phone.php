<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $table = "TELEFONO";
    protected $conntection = "sqlsrv";

    public $timestamps = true;

    protected $primaryKey = 'ID';

    public function getIdAttribute(){
        return $this->attributes['ID'];
    }
}
