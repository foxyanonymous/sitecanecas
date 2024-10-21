<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdmin extends Authenticatable
{
    protected $table = 'usersadmin'; // Nome da tabela de administradores
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
}

