<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'course_info';


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
