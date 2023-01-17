<?php

namespace App\Http\Controllers\Task\File\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\File\Message\StoreRequest;
use App\Models\Course;
use App\Models\File;
use App\Models\Message;
use App\Models\Task;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request, Course $course, Task $task, File $file)
    {
        $message = $request->message;

        $oldMessage = Message::where('file_id', $file->id)->first();

        if (is_null($oldMessage)) {
            Message::create([
                'file_id' => $file->id,
                'text' => $message
            ]);
        } else {
            $oldMessage->update([
                'text' => $message
            ]);
        }

        return back();
    }
}
