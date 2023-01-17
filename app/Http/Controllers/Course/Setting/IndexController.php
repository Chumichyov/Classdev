<?php

namespace App\Http\Controllers\Course\Setting;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends BaseController
{
    public function __invoke(Request $request, Course $course)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        return view('course.setting.index', compact('courses', 'course'));
    }
}
