<?php

namespace Database\Factories;
use App\Models\FoundationProfile;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'foundation_profile_id' => FoundationProfile::factory(),
                'category_id' => Category::factory(),
                'title' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
                'goal_amount' => $this->faker->randomFloat(2, 1000, 10000),
                'collected_amount' => 0,
                'deadline' => now()->addDays(rand(10, 60)),
 ];
    }
}
