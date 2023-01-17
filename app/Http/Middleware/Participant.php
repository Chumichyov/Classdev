<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;

class Participant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $course = $request->route('course');

        gettype($course) == 'string' ? $course = Course::findOrFail($course) : '';

        if (!is_null($course->users()->where('user_id', auth()->user()->id)->first())) {
            return $next($request);
        }

        abort(403);

        // if (gettype($course) !== 'object') {
        //     $course = Course::find($course);
        // }


        // if (!is_null($task)) {
        //     if (gettype($task) !== 'object') {
        //         $task = Task::findOrFail($task);
        //         $courseTaskID = $task->course()->get();
        //     }
        // }

    }
}
