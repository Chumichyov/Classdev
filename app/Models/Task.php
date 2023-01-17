<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function completed()
    {
        return $this->hasMany(Completed::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
