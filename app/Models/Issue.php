<?php
// app/Models/Issue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'heading',
        'description',
        'report_type',
        'district',
        'ward',
        'area_name',
        'location',
        'photo1',
        'photo2',
        'support_count',
        'affected_count',
        'not_sure_count',
        'invalid_count',
        'fixed_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'issue_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(IssueReaction::class, 'issue_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(IssueComment::class, 'issue_id', 'id');
    }
}
