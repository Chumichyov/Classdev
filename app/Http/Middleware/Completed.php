<?php

namespace App\Http\Middleware;

use App\Models\CompletedPath;
use Closure;
use Illuminate\Http\Request;

class Completed
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
        $filename = CompletedPath::find($request->route('filename'));
        if ($filename->completed()->first()->is_returned != 1) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
