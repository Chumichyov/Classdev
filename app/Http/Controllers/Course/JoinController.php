<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserCourse;

class JoinController extends Controller
{

    public function __invoke($unique)
    {
        $course = Course::where('uniqueLink', $unique)->first();
        $user = auth()->user()->id;
        if ($course !== null) {
            if ($course->users->where('id', $user)->first() == null) {
                UserCourse::create(['user_id' => $user, 'course_id' => $course->id]);
            }
            return redirect()->route('course.show', $course);
        } else {
            return abort(404);
        }
    }
}
