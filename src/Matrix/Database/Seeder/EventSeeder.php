<?php
namespace Matrix\Database\Seeder;

use App\Model\Event;
use App\Model\Item;
use App\Model\Location;
use App\Model\Performer;
use App\Model\Program;
use Carbon\Carbon;

class EventSeeder
{
    public function seed()
    {
        Event::create([
            'title' => "Jazz",
            'total_price_event' => 230,
            'description' => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
            'images' => json_encode(array()),
        ]);

        $event = Event::query()->where("id", '=', 1)->first();

        Program::create([
            'title' => "Friday program",
            'total_price_program' => 80,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
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
            'images' => json_encode(array()),
        ]);

        Performer::create([
            'name' => "floris",
            'type' => "jazz",
            'description' => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
            'images' => json_encode(array()),
            'socials' => json_encode(array()),
        ]);

        $program = Program::findOrFail(1);
        $location = Location::findOrFail(1);
        $performer = Performer::findOrFail(1);

        Item::create([
            'program_id' => $program->id,
            'location_id' => $location->id,
            'performer_id' => $performer->id,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'price' => 20,
        ]);
    }
}
