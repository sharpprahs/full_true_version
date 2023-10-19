<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => 'Александр Бутко',
            'email' => 'sharp@example.com',
            'accesses' => '123456',
            'password' => bcrypt('sharp'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
