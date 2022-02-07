<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Illuminate\Support\Facades\Validator;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
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

    public function login(Request $request)
    {

        $data = $request->request->all();

        $session = SessionManager::getSessionManager();

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


        return $this->json(['result' => "t"]);
    }

}