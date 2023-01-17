<?php

namespace App\Http\Controllers\Course\Setting\Connection;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Faker\Factory as Faker;


class UpdateController extends Controller
{
    public function __invoke(Request $request, Course $course, ...$type)
    {
        $type = $request->type;
        $faker = Faker::create();
        if ($type == 'code') {
            do {
                $uniqueCode = strtoupper($faker->bothify('??#?#?'));
            } while (Course::where('uniqueCode', $uniqueCode)->first() !== null);

            $course->update([
                'uniqueCode' => $uniqueCode,
            ]);
        } elseif ($type == 'link') {
            do {
                $uniqueLink = $faker->bothify('?????##???###?????##');
            } while (Course::where('uniqueLink', $uniqueLink)->first() !== null);

            $course->update([
                'uniqueLink' => $uniqueLink,
            ]);
        }
        return back();
    }
}
