<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\EmailManager;
use Matrix\Managers\RouteManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("help_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render("partials.contact", []);
    }
}