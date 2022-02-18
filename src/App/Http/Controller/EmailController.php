<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\EmailManager;
use Matrix\Managers\SessionManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("email_test_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render("partials.tests.test_email", []);
    }

    public function sendEmail(Request $request)
    {
        $data = $request->request->all();

        if($data["token"] != $this->session->get("email_test_form_csrf_token"))
            return new Response('Unauthorized', 403);

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ]
        );

        if ($validator->fails()) {
            $referer = $request->headers->get('referer');
            return $this->Redirect($referer);
        }

        EmailManager::sendEmail($data["email"], $data["subject"], $data["message"]);

        return $this->json(["success" => "email successfully send"]);
    }

}
