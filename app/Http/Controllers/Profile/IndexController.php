<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $page = ($request->route()->getName());

        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        return view('profile.index', compact('courses', 'user', 'page'));
    }
}
