<?php

namespace App\Http\Controllers\Task;

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

        $tasks = $course->tasks()->orderBy('id', 'desc')->get();
        $themes = Theme::where('course_id', $course->id)->get();
        return view('task.index', compact('tasks', 'themes', 'course', 'courses', 'page'));
    }
}
