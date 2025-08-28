<?php
// app/Models/AdminUser.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'username',
        'password',
        'name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
