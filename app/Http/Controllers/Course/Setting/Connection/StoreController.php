<?php

namespace App\Http\Controllers\Course\Setting\Connection;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\Setting\Connection\StoreRequest;
use App\Models\Course;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserCourse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Course $course)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!is_null($user)) {
            if (Invitation::where('user_id', $user->id)->get()->count() == 0) {
                if (UserCourse::where('course_id', $course->id)->where('user_id', $user->id)->get()->count() == 0) {
                    Invitation::create([
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                    ]);
                    return back()->with('success', 'Приглашение отправлено!');
                } else {
                    return back()->with('error', 'Данный пользователь является участником!');
                }
            } else {
                return back()->with('error', 'Данный пользователь уже приглашен!');
            }
        } else {
            return back()->with('error', 'Данного пользователя не существует!');
        }
    }
}
