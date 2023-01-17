<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeReview extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
