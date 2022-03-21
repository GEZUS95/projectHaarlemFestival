<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QRController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $this->session->set("qr_test_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render("partials.tests.test_qr", []);
    }
    public function makeQR(Request $request)
    {
        $data = $request->request->all();

        if($data["token"] != $this->session->get("qr_test_form_csrf_token"))
            return new Response('Unauthorized', 403);

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'qrData' => 'required',
            ]
        );

        if ($validator->fails()) {
            $referer = $request->headers->get('referer');
            return $this->Redirect($referer);
        }

        //code for qr

        return $this->json(["t"=>"t"]);
//        return $this->Redirect(RouteManager::getUrlByRouteName('home'));
    }

}
