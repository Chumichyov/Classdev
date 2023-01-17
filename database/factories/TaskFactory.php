<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Task;
use App\Models\Type;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(12),
            'course_id' => $courseID = Course::get()->random()->id,
            'theme_id' => Theme::where('course_id', $courseID)->get()->toArray() !== [] ? Theme::where('course_id', $courseID)->get()->random()->id : null,
            'type_id' => Type::get()->random()->id,
            'deadline' => '2022-10-15',
        ];
    }
}
