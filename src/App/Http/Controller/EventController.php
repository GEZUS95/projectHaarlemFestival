<?php

namespace App\Http\Controller;

use App\Model\Event;
use App\Model\Location;
use App\Model\Performer;
use App\Model\Program;
use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class EventController extends BaseController
{

    /**
     * @param Request $request
     * @param $title
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, $title): Response
    {
        if(!Event::query()->where("title", "=", $title)->exists())
            throw new ResourceNotFoundException;

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

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function program(Request $request, $id): Response
    {
        $this->session->set("validate_form_token",  bin2hex(random_bytes(24)));

        $program = Program::query()
            ->where("id", "=", $id)
            ->with("event")
            ->with("items")
            ->with("items.location")
            ->with("items.performer")
            ->first();

        return $this->render("partials.event.program", ["program" => $program]);
    }
}
