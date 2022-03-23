<?php

namespace App\Http\Controller;

use App\Model\Event;
use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
//        $res = Restaurant::all();

        return $this->render("partials.cart.index", []);
    }
}
