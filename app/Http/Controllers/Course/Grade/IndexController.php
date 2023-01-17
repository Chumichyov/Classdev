<?php

namespace App\Http\Controllers\Course\Grade;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{

    public function __invoke(Request $request, Course $course)
    {
        $page = ($request->route()->getName());

        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        $tasks = $course->tasks()->where('type_id', 2)->orderBy('id', 'desc')->get();
        $users = $course->users()->get();

        return view('course.grade.index', compact('course', 'courses', 'page', 'tasks', 'users'));
    }
}
