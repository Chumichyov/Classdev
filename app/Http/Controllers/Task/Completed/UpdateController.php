<?php

namespace App\Http\Controllers\Task\Completed;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\Completed\UpdateRequest;
use App\Models\Completed;
use App\Models\Course;
use App\Models\Task;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Course $course, Task $task, Completed $completed)
    {
        $option_id = $request->option_id;

        if (auth()->user()->id != $course->leader_id) {
            $completed->update([
                'option_id' => $option_id,
            ]);

            return back();
        }

        abort(403);
    }
}
