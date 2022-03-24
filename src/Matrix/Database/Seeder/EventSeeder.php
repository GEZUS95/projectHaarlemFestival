<?php
namespace Matrix\Database\Seeder;

use App\Model\Event;
use App\Model\Item;
use App\Model\Location;
use App\Model\Performer;
use App\Model\Program;
use Carbon\Carbon;
use Faker\Factory;

class EventSeeder
{
    public function seed()
    {
        if(1 + 1 == 2) return;

        $faker = Factory::create();

        Event::create([
            'title' => "Jazz",
            'total_price_event' => 230,
            'description' => $faker->paragraph(8),
        ]);

        $event = Event::query()->where("id", '=', 1)->first();

        Program::create([
            'title' => "First program",
            'total_price_program' => 80,
            'start_time' => Carbon::now()->startOfDay()->addHours(12),
            'end_time' => Carbon::now()->startOfDay()->addHours(22),
            'color' => "#FFFFFF",
            'event_id' => $event->id,
        ]);

        Program::create([
            'title' => "Second program",
            'total_price_program' => 80,
            'start_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(5),
            'end_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(16),
            'color' => "#FFFFFF",
            'event_id' => $event->id,
        ]);

        Location::create([
            'name' => "Patronaat",
            'city' => "Haarlem",
            'address' => "Straat 2108 AB",
            'stage' => "Hall 2",
            'color' => "#F39D92",
            'seats' => 200,
        ]);

        for ($i = 0; $i < 10; $i++) {
            Performer::create([
                'name' => $faker->name(),
                'type' => "jazz",
                'description' => $faker->paragraph(8),
                'socials' => json_encode(array()),
            ]);
        }

        $firstProgram = Program::findOrFail(1);
        $secondProgram = Program::findOrFail(2);
        $location = Location::findOrFail(1);

        Item::create([
            'program_id' => $firstProgram->id,
            'location_id' => $location->id,
            'performer_id' =>  Performer::all()->random(1)->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(13),
            'end_time' => Carbon::now()->startOfDay()->addHours(14),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $firstProgram->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(14),
            'end_time' => Carbon::now()->startOfDay()->addHours(15),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $firstProgram->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(18),
            'end_time' => Carbon::now()->startOfDay()->addHours(20),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $secondProgram->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(6),
            'end_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(8),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $secondProgram->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(9),
            'end_time' => Carbon::now()->addDays(3)->startOfDay()->addHours(15),
            'price' => 20,
        ]);
    }
}
