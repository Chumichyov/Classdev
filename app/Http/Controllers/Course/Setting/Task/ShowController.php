<?php

namespace App\Http\Controllers\Course\Setting\Task;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Models\Theme;
use App\Models\Type;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(Course $course, Task $task)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        $themes = Theme::where('course_id', $course->id)->get();
        $types = Type::all();
        $task->loadMissing('files');

        return view('course.setting.task.show', compact('courses', 'course', 'user', 'themes', 'types', 'task'));
    }
}
