<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalController extends BaseController
{
    public function __invoke(Request $request)
    {
        $page = ($request->route()->getName());

        // For sidebar
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        return view('profile.personal', compact('courses', 'user', 'page'));
    }
}
