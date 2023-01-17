<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Models\Course;
use App\Models\Invitation;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $course = $request->validated();
        $course_id = $request->course_id;
        $type = $request->type;
        $user = auth()->user();

        if ($type == 'code') {
            $code = $course['code'];
            $course = Course::where('uniqueCode', $code)->first();
            if ($course != null) {
                if (is_null($user->coursesUser->find($course->id))) {
                    UserCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $course->id
                    ]);

                    if (Invitation::where('user_id', $user->id)->where('course_id', $course->id)->get()->count() != 0) {
                        Invitation::where('user_id', $user->id)->where('course_id', $course->id)->delete();
                    }

                    return back()->with([
                        'type' => 'code',
                        'success' => 'Вы успешно вступили в курс!'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'code',
                        'value' => $code,
                        'error' => 'Вы уже состоите в данном курсе!'
                    ]);
                }
            } else {
                return back()->with([
                    'type' => 'code',
                    'value' => $code,
                    'error' => 'Данного курса не существует!'
                ]);
            }
        } elseif ($type == 'invitation') {
            if ($request->subtype == 'all') {
                if ($request->method == 'enter') {
                    foreach (Invitation::where('user_id', $user->id)->with('course')->get() as $invitation) {
                        UserCourse::create([
                            'user_id' => $user->id,
                            'course_id' => $invitation->course->id,
                        ]);
                        $invitation->delete();
                    }
                    return back();
                } elseif ($request->method == 'delete') {
                    foreach (Invitation::where('user_id', $user->id)->with('course')->get() as $invitation) {
                        $invitation->delete();
                    }
                    return back();
                } else {
                    abort(400);
                }
            } else {
                if ($request->method == 'enter') {
                    UserCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $course_id,
                    ]);

                    Invitation::where('user_id', $user->id)->where('course_id', $course_id)->delete();
                    return back();
                } elseif ($request->method == 'delete') {
                    Invitation::where('user_id', $user->id)->where('course_id', $course_id)->delete();
                    return back();
                } else {
                    abort(400);
                }
            }
            abort(400);
        } elseif ($type == 'create') {
            $this->service->store($course);
            return redirect()->route('course.index');
        }
    }
}
