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
    // protected $fillable = [
    //     'username',
    //     'first_name',
    //     'last_name',
    //     'ic',
    //     'email',
    //     'password',
    //     'usertype',
    //     'date_of_birth',
    //     'contact_number',
    //     'address',
    //     'post_code',
    //     'city',
    //     'state',
    //     'profile_picture'
    // ];

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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Delete profile picture from profile_pictures directory
            if ($user->profile_picture && Storage::disk('local')->exists('profile_pictures/' . basename($user->profile_picture))) {
                Storage::disk('local')->delete('profile_pictures/' . basename($user->profile_picture));
            }

            // Clean up temporary files in livewire-tmp directory
            $files = Storage::disk('local')->files('livewire-tmp');
            foreach ($files as $file) {
                if (strpos($file, basename($user->profile_picture)) !== false) {
                    Storage::disk('local')->delete($file);
                }
            }
        });
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
}
