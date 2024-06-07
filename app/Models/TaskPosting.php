<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TaskPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'requirement',
        'salary',
        'location',
        'location_detail',
        'location',
        'deadline',
        'status',
        'tags',
        'availability',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function isExpired($task = null)
    {
        // If $task is provided, use it; otherwise, use $this
        $task = $task ?: $this;

        // Compare the deadline with the current date
        return Carbon::now()->greaterThanOrEqualTo($task->deadline);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
