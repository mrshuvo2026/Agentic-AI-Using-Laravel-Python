<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // 👇 এই অংশটুকু ঠিকভাবে বসাতে হবে
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function profile()
{
    return $this->hasOne(Profile::class);
}
public function courses()
{
    return $this->belongsToMany(Course::class, 'enrollments');
}

} // 👈 ক্লাসের শেষ ব্র্যাকেট
