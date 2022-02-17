<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\AuthManager;
use Matrix\Managers\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("login_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('auth.login', []);
    }

    public function login(Request $request)
    {
        $data = $request->request->all();
        $this->session = SessionManager::getSessionManager();

        if($data["token"] != $session->get("login_form_csrf_token"))
            return new Response('Unauthorized', 403);

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            $referer = $request->headers->get('referer');
            return $this->Redirect($referer);
        }

        if(!AuthManager::login($data["email"], $data["password"])){
            $referer = $request->headers->get('referer');
            return $this->Redirect($referer);
        }

        return $this->json(['result' => AuthManager::getCurrentUser()]);
    }

}