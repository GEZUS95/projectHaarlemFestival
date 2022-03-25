<?php

namespace App\Http\Controller;

use eftec\bladeone\BladeOne;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\EmailManager;
use Matrix\Managers\RouteManager;
use phpDocumentor\Reflection\Types\Mixed_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
     * @throws TransportExceptionInterface
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

        if($data["pdf"] && $data["pdf-name"] != null) {
            new EmailManager($data["email"], $data["subject"], "emails.ad", ["name" => "Floris"], $data["pdf"], $data["pdf-name"]);
        }
        else {
            new EmailManager($data["email"], $data["subject"], "emails.ad", ["name" => "Floris"]);
        }

        return $this->json(["t"=>"t"]);
//        return $this->Redirect(RouteManager::getUrlByRouteName('home'));
    }

    /**
     * @throws Exception
     */
    private function generatePDF($blade_name, $args = [])
    {
        $blade = new BladeOne(dirname(__DIR__, 4) . "/resources/views",dirname(__DIR__, 4) . "/public/views",BladeOne::MODE_DEBUG);

        //generate some PDFs!
        $dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
        $dompdf->loadHtml(html_entity_decode($blade->run($blade_name, $args)));
        $dompdf->render();
        return $dompdf->output();
    }
}
