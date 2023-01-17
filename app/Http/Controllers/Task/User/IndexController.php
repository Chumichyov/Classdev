<?php

namespace App\Http\Controllers\Task\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {

        // Request $request, Course $course, User $user


        // $page = ($request->route()->getName());
        // $authUser = User::find(auth()->user()->id);

        // $courses = $authUser->coursesUser()->orderBy('id', 'desc')->get();
        // $Allcompleted = Completed::where('user_id', $user->id)->get();
        // $completed = [];
        // foreach ($Allcompleted as $item) {
        //     $item->task->course_id === $course->id ? $completed[] = $item : '';
        // }

        // if ($user->id == $course->leader_id) {
        //     return redirect()->route('course.usersShow', compact('course', 'courses'));
        // }

        // return view('task.showUserFiles', compact('course', 'user', 'courses', 'page', 'completed'));
    }
}
