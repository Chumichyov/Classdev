<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\CourseInfo;
use App\Models\UserCourse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;


class Service
{
    public function store($course)
    {
        try {
            DB::beginTransaction();

            $faker = Faker::create();
            $user = auth()->user()->id;

            do {
                $uniqueLink = $faker->bothify('?????##???###?????##');
            } while (Course::where('uniqueLink', $uniqueLink)->first() !== null);

            do {
                $uniqueCode = $faker->bothify('??#?#?');
            } while (Course::where('uniqueCode', $uniqueCode)->first() !== null);

            $course['leader_id'] = $user;
            $course['uniqueLink'] = $uniqueLink;
            $course['uniqueCode'] = $uniqueCode;

            $course = Course::create($course);
            $course->users()->attach($user);
            $course->info()->create();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function update($data, $course)
    {
        try {
            DB::beginTransaction();

            if (Arr::exists($data, 'title')) {
                $course->update(['title' => $data['title']]);
            }

            if (Arr::exists($data, 'topic')) {
                $course->update(['topic' => $data['topic']]);
            }

            if (Arr::exists($data, 'description')) {
                $course->update(['description' => $data['description']]);
            }

            if (Arr::exists($data, 'image')) {

                $imageName = time() . '.' . $data['image']->extension();

                if ($course->info->imagePath != 'http://dummyimage.com/500x237') {
                    Storage::disk('public')->delete(substr($course->info->imagePath, 9));
                }

                $path = 'courses/image/course-' . $course->id;
                $data['image']->storeAs('public/' . $path, $imageName);

                CourseInfo::where('course_id', $course->id)
                    ->update(['imagePath' => '/storage/' . $path . '/' . $imageName]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
