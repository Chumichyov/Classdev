<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateUserCompletedRequest;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;

class ReturnController extends BaseController
{
    public function __invoke(UpdateUserCompletedRequest $request, Course $course, Task $task, User $user)
    {
        $grade = $request->grade;
        $this->service->return($grade, $task, $user);
        return back();
    }
}
