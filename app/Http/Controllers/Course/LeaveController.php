<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __invoke(Course $course)
    {
        UserCourse::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first()->delete();

        return back();
    }
}
