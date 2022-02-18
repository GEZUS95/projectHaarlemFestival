<?php

namespace Matrix\Database\Seeder;

use App\Model\Location;
use App\Model\Restaurant;
use App\Model\RestaurantType;
use Faker\Factory;

class RestaurantSeeder
{
    public function seed()
    {
        $faker = Factory::create();

        // Create restaurant types
        for($i = 0; $i < 10; $i++){
        RestaurantType::create([
            'type' => $faker->word(),
        ]);
        }

        // Get location and type for creating a restaurant
        $location = Location::query()->where("id", "=", 2)->first();
        $type = RestaurantType::query()->where("id", "=", 1);


        // Creating a restaurant
        Restaurant::create([
            'name' => 'Ratatouille',
            'location_id' => $location->id,
            'type_id' => 1,
            'stars' => 4,
            'seats' => 50,
            'price' => 44.00,
            'accessibility' => 1,
        ]);
    }
}
