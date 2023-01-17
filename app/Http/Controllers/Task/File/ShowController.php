<?php

namespace App\Http\Controllers\Task\File;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\File;
use App\Models\Task;
use App\Models\TypeReview;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Course $course, Task $task, File $file)
    {
        if ($file->extension == 'css' || $file->extension == 'txt' || $file->extension == 'html' || $file->extension == 'js') {
            $content = fopen(public_path($file->dataPath), 'r');

            $user = User::find(auth()->user()->id);
            $courses = $user->coursesUser()->get();

            while (!feof($content)) {
                $lines[] = str_replace(PHP_EOL, '', fgets($content));
            }

            fclose($content);
            !is_null($file->completed) ? $file->loadMissing('message') : '';
            $file->loadMissing('reviews');
            $types = TypeReview::all();
            return view('task.file.show', compact('file', 'lines', 'course', 'courses', 'task', 'types'));
        } else {
            return response()->file(public_path($file->dataPath));
        }
    }
}
