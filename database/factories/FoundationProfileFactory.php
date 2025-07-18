<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoundationProfile>
 */
class FoundationProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'user_id' => User::factory(), // Crea usuario con role: foundation
        'name' => $this->faker->company,
        'description' => $this->faker->paragraph,
        'logo' => null, // Podés usar URLs si querés algo visual
        ];
    }
}
