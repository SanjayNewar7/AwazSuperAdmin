<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{
    protected $table = 'issue_comments';

    protected $fillable = [
        'issue_id',
        'user_id',
        'comment',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
