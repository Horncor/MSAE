<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'USUARIO';
    protected $conntection = "sqlsrv";


    protected $fillable = [
        'ID',
        'login',
        'contrasena',
        'email',
    ];

    /**
     * The primary key for the model.
     * @var string
     */
    protected $primaryKey = 'ID';

    protected $maps = [
        'id' => 'ID',
        'login' => 'login',
        'password' => 'contrasena',
        'email' => 'email',
        'remember_token' => 'token_recordarme',
        'email_verified_at' => 'email_verificado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verificado' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['contrasena'];
    }

    public function getAuthIdentifierName()
    {
        return 'ID';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['ID'];
    }

    public function getNameAttribute()
    {
        return $this->attributes['login'];
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email'];
    }
}
