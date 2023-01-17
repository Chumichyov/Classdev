<?php

namespace Database\Factories;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class UserRoleFactory extends Factory
{

    protected $model = UserRole::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}
