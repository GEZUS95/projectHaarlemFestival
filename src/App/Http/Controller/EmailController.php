<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\EmailManager;
use Matrix\Managers\RouteManager;
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

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
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

        new EmailManager($data["email"], "Oulleh", "emails.ad", ["name" => "Floris"]);

        return $this->json(["t"=>"t"]);
//        return $this->Redirect(RouteManager::getUrlByRouteName('home'));
    }

}
