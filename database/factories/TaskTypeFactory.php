<?php

namespace Database\Factories;

use App\Models\TaskType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskType>
 */
class TaskTypeFactory extends Factory
{

    protected $model = TaskType::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}
