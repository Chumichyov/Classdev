<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Models\Theme;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Request $request, Course $course, ...$task)
    {
        if (!isset($task[0])) {
            // Simplified
            $theme = isset($request->theme_id) ? Theme::find($request->theme_id) : null;
            $tasks = $theme->tasks;
            foreach ($tasks as $task) {
                $task->update([
                    'theme_id' => null,
                ]);
            }
            $theme->delete();
        } else {
            $task = Task::find($task[0]);
            $task->delete();
            return redirect()->route('course.setting.task.index', compact('course', 'task'));
        }

        return back();
    }
}
