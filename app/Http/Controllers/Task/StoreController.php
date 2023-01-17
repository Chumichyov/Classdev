<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Course;
use App\Models\Task;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request, Course $course)
    {
        $data = $request->validated();
        $this->service->store($course, $data);

        return bacK();
    }
}
