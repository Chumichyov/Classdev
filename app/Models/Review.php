<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function type()
    {
        return $this->belongsTo(TypeReview::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
