<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Course;
use App\Models\Task;
use App\Models\Theme;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Course $course, ...$task)
    {
        $data = $request->validated();
        if (isset($request->theme_id)) {
            //Simplified
            $theme = Theme::find($request->theme_id);
            $this->service->update($course, $data, $theme);
        } else {
            $task = Task::find($task[0]);
            $this->service->update($course, $data, $task);
        }

        return back();
    }
}
