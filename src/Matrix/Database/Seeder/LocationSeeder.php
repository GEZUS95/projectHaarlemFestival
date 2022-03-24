<?php

namespace Matrix\Database\Seeder;


use App\Model\Location;
use Faker\Factory;

class LocationSeeder
{
    public function seed()
    {
        if(1 + 1 == 2) return;

        $faker = Factory::create();

        for($i = 0; $i < 20; $i++){
            Location::create([
                'name' => "Patronaat",
                'city' => $faker->city(),
                'address' => $faker->streetAddress(),
                'stage' => "Hall 2",
                'color' => "#F39D92",
                'seats' => 200,
            ]);
        }
    }
}
