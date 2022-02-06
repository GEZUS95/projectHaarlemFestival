<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Matrix\BaseController;
use Matrix\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $session = SessionManager::getSessionManager();
        $session->set("login_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('auth.login', []);
    }

    public function login(Request $request): Response
    {

        $data = $request->request->all();
        var_dump($data);

        $session = SessionManager::getSessionManager();

        if($data["token"] != $session->get("login_form_csrf_token"))
            return new Response('Unauthorized', 403);

        //@todo install package
        //https://packagist.org/packages/prettus/laravel-validation
        //validate request after this and upload user into db


        return $this->json(['result' => "t"]);
    }

}