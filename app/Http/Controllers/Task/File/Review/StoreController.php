<?php

namespace App\Http\Controllers\Task\File\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\File\Review\StoreRequest;
use App\Models\Course;
use App\Models\File;
use App\Models\Review;
use App\Models\Task;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Course $course, Task $task, File $file)
    {
        $review = $request->validated();
        $review['file_id'] = $file->id;
        Review::create($review);

        return back();
    }
}
