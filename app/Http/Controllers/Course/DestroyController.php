<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Course $course)
    {
        $course->delete();

        return back();
    }
}
