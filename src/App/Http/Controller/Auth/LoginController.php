<?php

namespace  App\Http\Controller\Auth;

use App\Rules\EventExistValidation;
use App\Rules\TokenValidation;
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
        $rules = [
            'token' => ['required', new TokenValidation("login_form_csrf_token")],
            'email' => ['required', 'email'],
            'password' => 'required',
        ];

        $this->validate($data, $rules);

        if(!AuthManager::login($data["email"], $data["password"])){
            $referer = $request->headers->get('referer');
            return $this->Redirect($referer);
        }

        return $this->json(['result' => AuthManager::getCurrentUser()]);
    }

}