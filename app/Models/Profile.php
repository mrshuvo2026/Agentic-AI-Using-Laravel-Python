<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // 👇 এই লাইনটি যোগ করুন
    protected $fillable = [
        'user_id', 
        'phone', // ভবিষ্যতে লাগলে যোগ করবেন
        'bio'    // ভবিষ্যতে লাগলে যোগ করবেন
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}