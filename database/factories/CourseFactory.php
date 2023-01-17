<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{

    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'topic' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(15),
            'uniqueLink' => $this->faker->bothify('?????##???###?????##'),
            'uniqueCode' => strtoupper($this->faker->bothify('??#?#?')),
            'leader_id' => User::get()->random()->id,
        ];
    }
}
