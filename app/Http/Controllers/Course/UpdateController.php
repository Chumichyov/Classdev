<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\User;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Course $course)
    {
        $data = $request->validated();

        $this->service->update($data, $course);

        return back();
    }
}
