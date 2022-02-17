<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\AuthManager;
use Matrix\Managers\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends BaseController {

    public function index(Request $request): Response
    {
        $session = SessionManager::getSessionManager();
        $session->set("register_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('auth.register', []);
    }

    public function register(Request $request) {
        $data = $request->request->all();

        if($data['email'] === $data['email_confirmation']){
            if($data['password'] === $data['password_confirmation']){

            }
        }


        return $this->json(['result' => $data]);
    }
}