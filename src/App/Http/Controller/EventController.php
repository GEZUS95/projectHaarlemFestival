<?php

namespace App\Http\Controller;

use App\Model\Event;
use App\Model\Location;
use App\Model\Performer;
use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(Request $request, $title): Response
    {
        $event = Event::query()
            ->where("title", "=", $title)
            ->with("programs")
            ->with("programs.items")
            ->with("programs.items.location")
            ->with("programs.items.performer")
            ->first();

        $locationsId = [];
        foreach ($event->programs as $program) {
            foreach ($program->items as $item) {
                if(!in_array($item->location->id, $locationsId))
                    array_push($locationsId, $item->location->id);
            }
        }
        $locations = Location::findMany($locationsId);

        $performersId = [];
        foreach ($event->programs as $program) {
            foreach ($program->items as $item) {
                if(!in_array($item->performer->id, $performersId))
                    array_push($performersId, $item->performer->id);
            }
        }
        $performers = Performer::findMany($performersId);

        return $this->render("partials.event.index", ["event" => $event, "locations" => $locations, "performers" => $performers]);
    }

}
