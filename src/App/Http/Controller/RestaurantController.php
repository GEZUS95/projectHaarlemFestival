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
        $res = Restaurant::all();

        return $this->render("partials.restaurant.index", ['restaurant' => $res]);
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
