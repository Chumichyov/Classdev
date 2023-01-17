<?php

namespace App\Http\Middleware;

use App\Models\File;
use Closure;
use Illuminate\Http\Request;

class Option
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
        $file = $request->file;

        gettype($file) == 'string' ? $file = File::findOrFail($file) : '';

        if ($file->completed == null || $file->completed->option_id != 1 || $file->completed->user_id == auth()->user()->id) {
            return $next($request);
        }
        return abort(403);
    }
}
