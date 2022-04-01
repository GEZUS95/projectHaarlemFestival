<?php

namespace App\Http\Controller;

use App\Model\Event;
use App\Model\Item;
use App\Model\Order;
use App\Model\Program;
use eftec\bladeone\BladeOne;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\AuthManager;
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
    public function sendEmailWithForm(Request $request)
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

        if(isset($data["pdf"]) && isset($data["pdf-name"])) {
            new EmailManager($data["email"], $data["subject"], "emails.ad", ["name" => "Floris"], $data["pdf"], $data["pdf-name"]);
        }
        else {
            new EmailManager($data["email"], $data["subject"], "emails.ad", ["name" => "Floris"]);
        }

//        return $this->json(["t"=>"t"]);
        return $this->Redirect(RouteManager::getUrlByRouteName('home'));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail($email, $subject, $bladeName, $vars, $pdf, $pdfName){
//        $vars = ["name" => "Floris"];
        new EmailManager($email, $subject, $bladeName, $vars, $pdf, $pdfName);
    }

    /**
     * @throws Exception
     */
    public function generatePDF($blade_name, $args = [])
    {
        $blade = new BladeOne(dirname(__DIR__, 4) . "/resources/views",dirname(__DIR__, 4) . "/public/views",BladeOne::MODE_DEBUG);
        $args['user'] = AuthManager::getCurrentUser();
        $args['order'] = $this->removeDupes(Order::query()
            ->where("user_id", "=", $args['user']->id)
            ->where('status', '=', "normal")
            ->with("items")
            ->with("programs")
            ->with("events")
            ->first());

        //generate some PDFs!
        $dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
        $dompdf->loadHtml(html_entity_decode($blade->run($blade_name, $args)));
        $dompdf->render();
        return $dompdf->output();
    }

    private function removeDupes($order): Collection
    {
        $alreadyQueriedItemIds = [];
        $newItems = Collection::make([]);
        foreach ($order->items as $item) {
            if (in_array($item->id, $alreadyQueriedItemIds))
                continue;

            array_push($alreadyQueriedItemIds, $item->id);
            $found = Item::query()
                ->where("id", "=", $item->id)
                ->with('performer')
                ->with('location')
                ->first();

            $found["count"] = $this->count($item->id, "App\Model\Item");
            $newItems->push($found);
        }

        $alreadyQueriedProgramIds = [];
        $newPrograms = Collection::make([]);
        foreach ($order->programs as $program) {
            if (in_array($program->id, $alreadyQueriedProgramIds))
                continue;

            array_push($alreadyQueriedProgramIds, $program->id);
            $found = Program::query()
                ->where("id", "=", $program->id)
                ->first();

            $found["count"] = $this->count($program->id, "App\Model\Program");
            $newPrograms->push($found);
        }

        $alreadyQueriedEventIds = [];
        $newEvent = Collection::make([]);
        foreach ($order->events as $event) {
            if (in_array($event->id, $alreadyQueriedEventIds))
                continue;

            array_push($alreadyQueriedEventIds, $event->id);
            $found = Event::query()
                ->where("id", "=", $event->id)
                ->first();

            $found["count"] = $this->count($event->id, "App\Model\Event");
            $newEvent->push($found);
        }

        return Collection::make(["events" => $newEvent, "programs" => $newPrograms, "items" => $newItems]);
    }
}
