<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'theme_id');
    }
}
