<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\FoundationProfile;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
{
    $categories = Category::factory()->count(5)->create();

    User::factory(5)->create(['role' => 'foundation'])->each(function ($user) use ($categories) {
        $foundation = FoundationProfile::factory()->create(['user_id' => $user->id]);

        Campaign::factory(3)->create([
            'foundation_profile_id' => $foundation->id,
            'category_id' => $categories->random()->id,
        ]);
    });

    User::factory(10)->create(['role' => 'donor'])->each(function ($user) {
        Donation::factory(3)->create([
            'user_id' => $user->id,
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
        ]);
    });
}
}
