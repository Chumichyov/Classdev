<?php

namespace App\Http\Controllers\Task\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\File\StoreRequest;
use App\Models\Course;
use App\Models\Task;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request, Course $course, Task $task)
    {
        $files = $request->validated();
        $this->service->store($task, $files, $course);

        return back();
    }
}
