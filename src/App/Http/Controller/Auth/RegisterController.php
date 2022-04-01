<?php

namespace  App\Http\Controller\Auth;

use App\Rules\TokenValidation;
use App\Rules\UserEmailAlreadyExistValidation;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\AuthManager;
use Matrix\Managers\EmailManager;
use Matrix\Managers\RouteManager;
use Matrix\Managers\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\User;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class RegisterController extends BaseController {

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {

        $this->session->set("register_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('auth.register', []);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function register(Request $request) {
        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("register_form_csrf_token")],
            'name' => 'required',
            'email' => ['required','confirmed', new UserEmailAlreadyExistValidation, 'email'],
            'password' => 'required|confirmed|min:8',
        ];

        $this->validate($data, $rules);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role_id' => 1,
        ]);

        new EmailManager($data["email"], "Welcome to the Haarlem Festival", "emails.signup");

        if(!AuthManager::login($user->email, $user->password)){
            $referer = RouteManager::getUrlByRouteName("login");
            return $this->Redirect($referer);
        }


        return $this->json(['result' => $user]);
    }
}
