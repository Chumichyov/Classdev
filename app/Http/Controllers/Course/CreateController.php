<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends BaseController
{

    public function __invoke(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        $invitations = Invitation::where('user_id', $user->id)->with('course')->get();
        return view('course.create', compact('courses', 'invitations'));
    }
}
