<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['reporter_id', 'reported_user_id', 'reason', 'additional_reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
