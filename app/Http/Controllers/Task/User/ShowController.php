<?php

namespace App\Http\Controllers\Task\User;

use App\Http\Controllers\Controller;
use App\Models\Completed;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function __invoke(Course $course, Task $task, User $user, Request $request)
    {
        if ($task->course->id != $course->id)
            return abort(403);

        if ($task->type->id == 2) {
            $courses = User::find(auth()->user()->id)->coursesUser()->orderBy('id', 'desc')->get();
            $completed = Completed::where('user_id', $user->id)->where('task_id', $task->id)->with('files')->first();
            $task->loadMissing('files');

            if ($user->id == $course->leader_id) {
                return redirect()->route('course.user.index', compact('course', 'courses'));
            }

            return view('task.user.show', compact('course', 'task', 'user', 'courses', 'completed'));
        } else {
            return abort(404);
        }
    }
}
