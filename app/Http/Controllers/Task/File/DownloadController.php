<?php

namespace App\Http\Controllers\Task\File;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\File;
use App\Models\Task;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Course $course, Task $task, File $file)
    {
        return response()->download(public_path($file->dataPath), $file->originalName);
    }
}
