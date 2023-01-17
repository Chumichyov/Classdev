<?php

namespace App\Http\Controllers\Course\Setting\Connection;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke(Course $course)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        $users = $course->users;
        $invitations = $course->invitation;
        return view('course.setting.connection.index', compact('course', 'courses', 'users', 'invitations'));
    }
}
