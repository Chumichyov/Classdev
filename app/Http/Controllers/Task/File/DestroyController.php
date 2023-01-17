<?php

namespace App\Http\Controllers\Task\File;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\File;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{

    public function __invoke(Course $course, Task $task, File $file)
    {
        if ($file->user_id == auth()->user()->id) {

            $file->delete();
            Storage::disk('public')->delete(substr($file->dataPath, 9));

            if (isset($file->completed) && $file->completed->files->count() == 0) {
                $file->completed->delete();
            }

            return back();
        } else {
            abort(403);
        }
    }
}
