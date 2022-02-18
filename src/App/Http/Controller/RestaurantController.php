<?php

namespace App\Http\Controller;

use App\Model\Event;
use App\Model\Restaurant;
use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("login_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render("partials.restaurant.index", []);
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        $res = Restaurant::query()->where("id", "=", $id)->first();

        return $this->render("partials.restaurant.single", ["restaurant" => $res]);
    }

}
