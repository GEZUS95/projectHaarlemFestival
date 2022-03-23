<?php

namespace Matrix\Database\Seeder;

use App\Model\Location;
use App\Model\Restaurant;
use App\Model\RestaurantType;
use App\Model\Session;
use Carbon\Carbon;
use Faker\Factory;

class RestaurantSeeder
{
    public function seed()
    {
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
            'event_id' => 1,
            'name' => 'Ratatouille',
            'location_id' => $location->id,
            'description' => 'Ratatouille is The culinary Michelin restaurant in Haarlem. Chef Jozua Jaring is, just like ratatouille, a mixture of the French kitchen in the reality of today with an outstanding price-quality ratio in a low profile environment. We have started in 2013 at de lange veerstraat en we continued after we moved in 2015 at our unique monumental location at het Spaarne in Haarlem.',
            'stars' => 4,
            'seats' => 50,
            'price' => 44.00,
            'price_child' => 22.50,
            'accessibility' => 1,
        ]);

        $restaurant2 = Restaurant::create([
            'event_id' => 1,
            'name' => 'Specktakle',
            'location_id' => $location->id,
            'description' => 'Ratatouille is The culinary Michelin restaurant in Haarlem. Chef Jozua Jaring is, just like ratatouille, a mixture of the French kitchen in the reality of today with an outstanding price-quality ratio in a low profile environment. We have started in 2013 at de lange veerstraat en we continued after we moved in 2015 at our unique monumental location at het Spaarne in Haarlem.',
            'stars' => 3,
            'seats' => 150,
            'price' => 44.00,
            'price_child' => 22.50,
            'accessibility' => 0,
        ]);

        $restaurant->types()->attach([5,1,4]);
        $restaurant2->types()->attach([2,1,6]);

        Session::create([
           'id' => 1,
           'restaurant_id' => 1,
           'duration' =>  120,
            'start_time' => Carbon::now()->startOfDay()->addHours(12),
        ]);Session::create([
           'id' => 2,
           'restaurant_id' => 2,
           'duration' =>  120,
            'start_time' => Carbon::now()->startOfDay()->addHours(14),
        ]);
//        Session::create([
//           'id' => 3,
//           'restaurant_id' => 3,
//           'duration' =>  120,
//            'start_time' => Carbon::now()->startOfDay()->addHours(16),
//        ]);
    }
}
