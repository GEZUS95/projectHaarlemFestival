<?php

namespace  App\Http\Controller\Auth;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\AuthManager;
use Matrix\Managers\RouteManager;
use Matrix\Managers\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\User;

class RegisterController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        
        $this->session->set("register_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('auth.register', []);
    }

    public function register(Request $request) {
        $data = $request->request->all();

        if($data["token"] != $this->session->get("register_form_csrf_token"))
            return new Response('Unauthorized', 403);

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'email' => 'required|confirmed',
                'password' => 'required|confirmed|min:8',
            ]
        );

        if ($validator->fails()) {
            return $this->json(['result' => $validator->errors()]);
        }

        $userExist = (User::query()
            ->where('email','=',$data["email"])
            ->first());

        if($userExist){
            return $this->json(['error' => "user already exist"]);
        }
            
        $user = User::create([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role_id' => 1,
        ]);

        if(!AuthManager::login($user->email, $user->password)){
            $referer = RouteManager::getUrlByRouteName("login");
            return $this->Redirect($referer);
        }


        return $this->json(['result' => $user]);
    }
}