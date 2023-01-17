<?php

namespace App\Http\Controllers\Task\File\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\File\Review\UpdateRequest;
use App\Models\Course;
use App\Models\File;
use App\Models\Review;
use App\Models\Task;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Course $course, Task $task, File $file, Review $review)
    {
        $updated = $request->validated();
        $review->update($updated);

        return back();
    }
}
