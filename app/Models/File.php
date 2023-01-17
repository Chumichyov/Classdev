<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function completed()
    {
        return $this->belongsTo(Completed::class);
    }

    public function message()
    {
        return $this->hasOne(Message::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
