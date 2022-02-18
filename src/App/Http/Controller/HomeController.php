<?php

namespace App\Http\Controller;

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
        $this->session->set("login_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('partials.home', []);
    }
}