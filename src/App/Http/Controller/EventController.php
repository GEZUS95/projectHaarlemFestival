<?php

namespace App\Http\Controller;

use App\Model\Event;
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
            ->with("programs.items.locations")
            ->with("programs.items.performer")
            ->get();

        return $this->render("partials.event.index", ["event" => $event]);
    }

}
