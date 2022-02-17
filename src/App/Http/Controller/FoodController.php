<?php

namespace App\Http\Controller;

use App\Model\Event;
use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("login_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render("partials.food.index", []);
    }

    public function restaurant(Request $request, $title): Response
    {
        $restaurant = Event::query()
            ->where("name", "=", $title)
            ->with("programs")
            ->with("programs.items")
            ->with("programs.items.locations")
            ->with("programs.items.performer")
            ->get();

        return $this->render("partials.food.restaurant", ["restaurant" => $restaurant]);
    }

}
