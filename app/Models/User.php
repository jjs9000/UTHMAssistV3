<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'usertype',
        'date_of_birth',
        'contact_number',
        'address',
        'post_code',
        'city',
        'state',
    ];

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
}
