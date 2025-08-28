<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueReaction extends Model
{
    protected $table = 'issue_reactions';

    protected $fillable = [
        'issue_id',
        'user_id',
        'reaction_type',
    ];

    protected $casts = [
        'reaction_type' => 'string', // Ensures enum is treated as string
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define relationships
    public function issue()
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
