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

        $cuisines = ['European', 'Dutch', 'Modern', 'Fish and seafood', 'French', 'Asian', 'International', 'Steakhouse', 'Argentinian'];
        // Create restaurant types
        foreach($cuisines as $c){
            RestaurantType::create([
                'type' => $c,
            ]);
        }

        // Get location and type for creating a restaurant
        $location = Location::query()->where("id", "=", 2)->first();
//        $type = RestaurantType::query()->where("id", "=", 1);


        // Creating a restaurant
        $restaurant = Restaurant::create([
            'name' => 'Ratatouille',
            'location_id' => $location->id,
            'stars' => 4,
            'seats' => 50,
            'price' => 44.00,
            'accessibility' => 1,
        ]);

        $restaurant->types()->attach([5,6,7]);
    }
}
