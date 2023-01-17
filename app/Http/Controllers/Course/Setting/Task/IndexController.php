<?php

namespace App\Http\Controllers\Course\Setting\Task;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request, Course $course)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        $themes = Theme::where('course_id', $course->id)->get();
        $tasks = $course->tasks;
        return view('course.setting.task.index', compact('courses', 'course', 'themes', 'tasks'));
    }
}
