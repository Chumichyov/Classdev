<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function __invoke(Request $request)
    {
        $page = ($request->route()->getName());

        // For sidebar
        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();

        return view('profile.security', compact('courses', 'user', 'page'));
    }
}
