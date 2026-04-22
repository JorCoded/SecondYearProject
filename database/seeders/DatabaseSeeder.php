<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        //Hotel::factory(40)->create();

        for ($i = 1; $i <= 40; $i++) {
            // Floor 1 - Type 3
            Room::factory(50)->state(new Sequence(
                fn(Sequence $sequence) => ['roomNumber' => $sequence->index + 1],
            ))->create([
                'hotelid' => $i,
                'typeid' => 3,
                'floor' => 1
            ]);

            // Floor 1 - Type 4
            Room::factory(50)->state(new Sequence(
                fn(Sequence $sequence) => ['roomNumber' => $sequence->index + 51],
            ))
            ->create([
                'hotelid' => $i,
                'typeid' => 4,
                'floor' => 1
            ]);
            // Floor 2 - Type 1
            Room::factory(50)->state(new Sequence(
                fn(Sequence $sequence) => ['roomNumber' => $sequence->index + 101],
            ))->create([
                'hotelid' => $i,
                'typeid' => 1,
                'floor' => 2
            ]);

            // Floor 2 - Type 2
            Room::factory(50)->state(new Sequence(
                fn(Sequence $sequence) => ['roomNumber' => $sequence->index + 151],
            ))->create([
                'hotelid' => $i,
                'typeid' => 2,
                'floor' => 2
            ]);
        }
    }
}
