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
            'description' => 'Ratatouille is The culinary Michelin restaurant in Haarlem. Chef Jozua Jaring is, just like ratatouille, a mixture of the French kitchen in the reality of today with an outstanding price-quality ratio in a low profile environment. We have started in 2013 at de lange veerstraat en we continued after we moved in 2015 at our unique monumental location at het Spaarne in Haarlem.',
            'stars' => 4,
            'seats' => 50,
            'price' => 44.00,
            'price_child' => 22.50,
            'accessibility' => 1,
        ]);

        $restaurant->types()->attach([5,1,4]);
    }
}
