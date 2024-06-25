<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstagramSource>
 */
class InstagramSourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'feed_id' => Feed::factory(),
            'name' => $this->faker->name,
            'fan_count' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
