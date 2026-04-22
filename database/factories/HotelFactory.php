<?php

namespace Database\Factories;

use App\Faker\HotelProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new HotelProvider($this->faker));

        return [
            'hotel_name' => $this->faker->coolHotel(),
            'location' => $this->faker->coolLocation(),
            'address' => fake()->address(),
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'picture' => $this->faker->coolPicture(),
            'description' => fake()->paragraph(),
        ];
    }
}
