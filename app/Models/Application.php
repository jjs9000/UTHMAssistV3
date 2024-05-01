<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(TaskPosting::class, 'task_id');
    }

        /**
     * Accept the application.
     */
    public function accept()
    {
        $this->status = 'accepted';
        $this->save();
    }

    /**
     * Reject the application.
     */
    public function reject()
    {
        $this->status = 'rejected';
        $this->save();
    }
}
