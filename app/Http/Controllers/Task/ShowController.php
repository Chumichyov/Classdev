<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Completed;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{

    public function __invoke(Request $request, Course $course, Task $task)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        if (auth()->user()->id == $course->leader_id) {
            // Лидер
            if (!empty(Completed::where('task_id', $task->id)->get()->toArray())) {
                $completed = Completed::where('task_id', $task->id)->get();
            } else {
                $completed = '';
            }
        } else {
            // Не лидер
            if (!empty(Completed::where('user_id', $user->id)->where('task_id', $task->id)->get()->toArray())) {
                $completed = Completed::where('user_id', $user->id)->where('task_id', $task->id)->first();
            } else {
                $completed = '';
            }
        }

        return view('task.show', compact('course', 'task', 'courses', 'completed'));
    }
}
