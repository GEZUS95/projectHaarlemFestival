<?php

namespace App\Http\Controller;

use App\Model\Event;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Matrix\BaseController;

class HomeController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $events = Event::query()
            ->with("programs")
            ->with("programs.items")
            ->with("programs.items.location")
            ->with("programs.items.performer")
            ->get();

        return $this->render('partials.home', ["events" => $events]);
    }
}