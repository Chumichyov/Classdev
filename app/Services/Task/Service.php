<?php

namespace App\Services\Task;

use App\Models\CompletedDataPath;
use App\Models\CompletedPath;
use App\Models\Course;
use App\Models\File;
use App\Models\Task;
use App\Models\TaskPath;
use App\Models\Theme;
use App\Models\UserCourse;
use Illuminate\Support\Facades\DB;


class Service
{
    public function update($course, $data, ...$variable)
    {
        try {
            DB::beginTransaction();

            if ($variable[0]->getTable() == 'themes') {
                $theme = $variable[0];
            }

            if ($variable[0]->getTable() == 'tasks') {
                $task = $variable[0];
            }

            if (isset($data['theme']) && isset($theme)) {
                Theme::where('course_id', $course->id)->where('title', $theme->title)->first()->update([
                    'title' => $data['theme'],
                ]);
            }

            if (isset($task)) {
                $data['theme_id'] = $data['themeId'];
                unset($data['themeId']);
                $task->update($data);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function store($course, $data)
    {
        try {
            DB::beginTransaction();
            // Добавление темы заданий
            if (isset($data['theme'])) {
                Theme::create([
                    'course_id' => $course->id,
                    'title' => $data['theme'],
                ]);
                unset($data['theme']);
            }

            // Создание заданий и материала
            if (isset($data['type_id'])) {

                if (isset($data['files'])) {
                    $files = $data['files'];
                    unset($data['files']);
                }

                $task = Task::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'course_id' => $course->id,
                    'theme_id' => $data['theme_id'],
                    'type_id' => $data['type_id']
                ]);
            }

            // Добавление файлов
            if (isset($files)) {
                foreach ($files as $file) {

                    $extension = $file->extension();


                    if ($extension === 'txt') {
                        $extension = ltrim(substr($file->getClientOriginalName(), -3), '.');
                    }

                    if ($extension == 'tml') {
                        $extension = 'html';
                    }

                    $fileName = md5(microtime()) . '.' . $extension;
                    $path = 'task/task-' . $task->id . '/files';
                    $file->storeAs('public/' . $path, $fileName);

                    File::create([
                        'task_id' => $task->id,
                        'user_id' => auth()->user()->id,
                        'dataPath' => '/storage/' . $path . '/' . $fileName,
                        'extension' => $extension,
                        'originalName' => $file->getClientOriginalName()
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function return($grade, $task, $user)
    {
        try {
            DB::beginTransaction();
            $completed = $task->completed->where('user_id', $user->id)->first();
            $completed->update(['grade' => $grade, 'option_id' => 3]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
