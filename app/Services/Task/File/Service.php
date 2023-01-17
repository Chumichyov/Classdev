<?php

namespace App\Services\Task\File;

use App\Models\Completed;
use App\Models\File;
use Illuminate\Support\Facades\DB;


class Service
{
    public function store($task, $files, $course)
    {
        if (isset($files['task'])) {
            $typeData = $task;
            $type = 'task_id';
            $typePath = '/task';
        } else {
            if (auth()->user()->id != $course->leader_id) {
                $typeData = Completed::where('user_id', auth()->user()->id)->where('task_id', $task->id)->count() > 0 ? Completed::where('user_id', auth()->user()->id)->where('task_id', $task->id)->first() : Completed::create(['user_id' => auth()->user()->id, 'task_id' => $task->id]);
                $type = 'completed_id';
                $typePath = '/completed';
            } else {
                abort(403);
            }
        }

        foreach ($files['files'] as $file) {

            $extension = $file->extension();


            if ($extension === 'txt') {
                $extension = ltrim(substr($file->getClientOriginalName(), -3), '.');
            }

            if ($extension == 'tml') {
                $extension = 'html';
            }

            $fileName = md5(microtime()) . '.' . $extension;
            $path = 'task/task-' . $task->id . $typePath;
            $file->storeAs('public/' . $path, $fileName);

            File::create([
                $type => $typeData->id,
                'user_id' => auth()->user()->id,
                'dataPath' => '/storage/' . $path . '/' . $fileName,
                'extension' => $extension,
                'originalName' => $file->getClientOriginalName()
            ]);
        }
    }
}
