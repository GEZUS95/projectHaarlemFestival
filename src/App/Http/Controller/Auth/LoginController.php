<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->render('auth.login', []);
    }

}