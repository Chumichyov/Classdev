<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function invitation()
    {
        return $this->hasMany(Invitation::class);
    }

    public function info()
    {
        return $this->hasOne(CourseInfo::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
