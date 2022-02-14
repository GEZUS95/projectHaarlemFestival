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
        $faker = Factory::create();

        Event::create([
            'title' => "Jazz",
            'total_price_event' => 230,
            'description' => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        ]);

        $event = Event::query()->where("id", '=', 1)->first();

        Program::create([
            'title' => "Friday program",
            'total_price_program' => 80,
            'start_time' => Carbon::now()->startOfDay()->addHours(12),
            'end_time' => Carbon::now()->startOfDay()->addHours(22),
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


        $program = Program::findOrFail(1);
        $location = Location::findOrFail(1);

        Item::create([
            'program_id' => $program->id,
            'location_id' => $location->id,
            'performer_id' =>  Performer::all()->random(1)->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(13),
            'end_time' => Carbon::now()->startOfDay()->addHours(14),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $program->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(15),
            'end_time' => Carbon::now()->startOfDay()->addHours(16),
            'price' => 20,
        ]);

        Item::create([
            'program_id' => $program->id,
            'location_id' => $location->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => Carbon::now()->startOfDay()->addHours(18),
            'end_time' => Carbon::now()->startOfDay()->addHours(20),
            'price' => 20,
        ]);
    }
}
