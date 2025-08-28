<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'district',
        'city',
        'ward',
        'area_name',
        'phone_number',
        'gender',
        'email',
        'bio',
        'profile_image',
        'password_hash',
        'citizenship_front_image',
        'citizenship_back_image',
        'citizenship_id_number',
        'is_verified',
        'agreed_to_terms',
        'likes_count',
        'posts_count',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
        'api_token',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'user_id', 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(IssueReaction::class, 'user_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(IssueComment::class, 'user_id', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }
}
