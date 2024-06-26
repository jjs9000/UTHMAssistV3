<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('username', 'like', "%{$value}%")
              ->orWhere('email', 'like', "%{$value}%")
              ->orWhere('first_name', 'like', "%{$value}%")
              ->orWhere('last_name', 'like', "%{$value}%");
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function taskPostings()
    {
        return $this->hasMany(TaskPosting::class);
    }

    public function feedbackGiven()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function feedbackReceived()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function isSuspended()
    {
        return $this->is_suspended;
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function getMessageCount(){
        if(auth()->check()){
            $count = ChMessage::where('to_id', auth()->id())->where('seen', '0')->count();
            return $count;
        }
        return 0;
    }
}
