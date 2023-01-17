<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request, Course $course)
    {
        $page = ($request->route()->getName());

        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        $users = $course->users()->get();

        return view('course.user.index', compact('users', 'course', 'courses', 'page'));
    }
}
