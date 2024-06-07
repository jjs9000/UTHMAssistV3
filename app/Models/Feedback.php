<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function task()
    {
        return $this->belongsTo(TaskPosting::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
