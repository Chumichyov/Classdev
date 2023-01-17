<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        return view('course.index', compact('courses'));
    }
}
