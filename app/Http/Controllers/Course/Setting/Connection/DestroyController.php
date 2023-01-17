<?php

namespace App\Http\Controllers\Course\Setting\Connection;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Course $course, User $user)
    {
        if (!is_null(UserCourse::where('user_id', $user->id)->where('course_id', $course->id)->first())) {
            UserCourse::where('user_id', $user->id)->where('course_id', $course->id)->delete();
        } else {
            Invitation::where('user_id', $user->id)->where('course_id', $course->id)->delete();
        }

        return back();
    }
}
