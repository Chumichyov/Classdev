<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{

    protected $model = Theme::class;


    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'course_id' => Course::get()->random()->id,
        ];
    }
}
