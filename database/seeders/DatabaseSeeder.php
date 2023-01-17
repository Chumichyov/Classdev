<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\Course;
use App\Models\UserRole;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(6)->create();
        $courses = Course::factory(10)->create();
        Theme::factory(30)->create();
        Task::factory(30)->create();

        foreach ($users as $user) {
            $user->about()->create();
        }

        foreach ($courses as $course) {
            $course->info()->create();
            $course->users()->attach($course->leader_id);

            $usersIds = $users->unique()->random(3)->pluck('id')->toArray();

            foreach (array_keys($usersIds, $course->leader_id, true) as $key) {
                unset($usersIds[$key]);
            }

            $course->users()->attach($usersIds);
        }
    }
}
