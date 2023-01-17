<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsUser
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
        $user = $request->route('user');
        gettype($user) == 'string' ? $user = User::findOrFail($user) : '';

        $course = $request->route('course');
        gettype($course) == 'string' ? $course = Course::findOrFail($course) : '';

        if ($user->id === auth()->user()->id || auth()->user()->id === $course->leader_id) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
