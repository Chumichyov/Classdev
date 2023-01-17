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

    protected $guarded = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function about()
    {
        return $this->hasOne(About::class);
    }

    public function invitation()
    {
        return $this->hasMany(Invitation::class);
    }

    public function coursesLeader()
    {
        return $this->hasMany(Course::class, 'leader_id');
    }

    public function coursesUser()
    {
        return $this->belongsToMany(Course::class, 'user_courses');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function completed()
    {
        return $this->hasMany(Completed::class);
    }
}
