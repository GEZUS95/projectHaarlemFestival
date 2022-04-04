<?php

namespace App\Http\Controller;

use App\Model\Event;
use App\Model\Item;
use App\Model\Order;
use App\Model\Program;
use App\Rules\TokenValidation;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Matrix\BaseController;
use Matrix\Managers\AuthManager;
use Matrix\Managers\RouteManager;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class OrderController extends BaseController
{

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Get the order if it exist
     * @throws Exception
     */
    public function index(): Response
    {
        AuthManager::isLoggedIn();

        $event = Event::all()
            ->random()
            ->first();

        $image_link = $event->images[0]->file_location;

        $order = $this->getOrderWithoutDupes();

        $orderIds = [];
        foreach ($order["items"] as $item) {
            if (in_array($item->id, $orderIds))
                array_push($orderIds, $item->id);
        }

        $extraSales = [];
        if (!empty($orderIds)) {
            $extraSales = Item::query()
                ->whereNotIn('id', $orderIds)
                ->get()
                ->random()
                ->limit(2);
        }

        return $this->render("partials.order.index", ['order' => $order, 'image_link' => $image_link, "sales_items" => $extraSales]);
    }

    public function getOrderWithoutDupes(): Collection
    {
        return $this->removeDupes(Order::query()
            ->where("user_id", "=", AuthManager::getCurrentUser()->id)
            ->where('status', '=', "unpaid")
            ->with("items")
            ->with("programs")
            ->with("events")
            ->first());
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

    private function count($id, $type): int
    {
        return Capsule::table('order_able')
            ->where("order_able_id", "=", $id)
            ->where("order_able_type", "=", $type)
            ->count();
    }

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Get the receipt if it exist
     * @throws Exception
     */
    public function receipt(): Response
    {
        AuthManager::isLoggedIn();
        $user = AuthManager::getCurrentUser();
        return $this->render("partials.order.receipt", ['order' => $this->getReceipt($user)]);
    }

    /**
     * Make a post request to the back end with (id, type) example (id:1, type)
     * Add the type to the order and create the order if it doesn't exist -> call $this->create
     * call this->model
     * get the model and add the type to the order
     * @param Request $request
     * validate request
     * @throws Exception
     */
    public function set(Request $request): Response
    {
        AuthManager::isLoggedIn();

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("validate_form_token")],
            'amount' => ['required', 'integer'],
            'id' => ['required', 'integer'],
            'type' => 'required',
        ];
        $this->validate($data, $rules);

        $model = $this->model($data['type'], $data['id']);
        $order = $this->getOrder(AuthManager::getCurrentUser());

        $model->orders($order)->detach();

        for ($x = 0; $x < (int)$data['amount']; $x++) {
            $model->orders()->attach($order);
        }

        return $this->json(["Success" => "Added the type to the cart"]);
    }

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Delete the order of the user that is logged in
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function delete(Request $request): Response
    {
        AuthManager::isLoggedIn();

        $order = $this->getOrder(AuthManager::getCurrentUser());

        $order->delete();

        return $this->render("partials.order.index", ['order' => $this->getOrder(AuthManager::getCurrentUser())]);
    }

    /**
     * Wait for the response and finalize the order!
     * @param Request $request
     * @return Response
     * @throws ApiException
     * @throws Exception
     */
    public function webhook(Request $request): Response
    {
        $mollie = new MollieApiClient();
        $mollie->setApiKey($_ENV['MOLLIE_API_KEY']);
        $mailController = new EmailController();

        try {
            $payment = $mollie->payments->get($_POST["id"]);

            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                Order::find($payment->metadata["order_id"])->update(["status" => "paid"]);
                $pdf = $mailController->generatePDF('emails.receipt.blade', ['status' => 'paid']);
                $mailController->sendEmail("Order is successful!", 'emails.payment_success.blade', '', $pdf, 'receipt_' . $payment->metadata["order_id"]);
                return $this->json(["Error" => "Payment Success"]);
            } else {
                Order::find($payment->metadata["order_id"])->update(["status" => "unpaid"]);
                return $this->json(["Error" => "Payment Failed"]);
            }
        } catch (ApiException|TransportExceptionInterface $e) {
            return $this->json(["Error" => "Some error Occurred!"]);
        }
    }

    /**
     * Get the order and all the total prices of the program, event, item, restaurant
     * Make mollie api call and finalize the order
     * @param Request $request
     * @throws ApiException
     */
    public function mollie(Request $request)
    {
        AuthManager::isLoggedIn();
        $user = AuthManager::getCurrentUser();
        $total = 0;
        $order = $this->getOrder($user);
        $mollie = new MollieApiClient();
        $mollie->setApiKey($_ENV['MOLLIE_API_KEY']);

        foreach ($order->events as $event) {
            $total += $event->total_price_event;
        }
        foreach ($order->programs as $program) {
            $total += $program->total_price_program;
        }
        foreach ($order->items as $item) {
            $total += $item->price;
        }

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format((float)$total, 2, '.', '')
            ],
            "description" => $user->name . ' ordered ',
            "redirectUrl" => RouteManager::getUrlByRouteName("receipt"),
            "webhookUrl" => RouteManager::getUrlByRouteName("webhook"),
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);
        header("Location: " . $payment->getCheckoutUrl(), true, 303);

    }

    /**
     * if the order already exist for the current user just return the order
     * @param $user
     * @return Builder|Model|object
     */
    private function getOrder($user)
    {
        $order = $this->removeDupes(Order::query()
            ->where("user_id", "=", $user->id)
            ->where('status', '=', "unpaid")
            ->first());

        if ($order != null)
            return $order;

        return Order::create([
            'status' => "unpaid",
            'uuid' => Uuid::uuid4(),
            'user_id' => $user->id,
        ]);
    }

    /**
     * if the order already exist for the current user just return the order
     * @param $user
     * @return Builder|Model|object
     */
    private function getReceipt($user)
    {
        return $this->removeDupes(Order::query()
            ->where("user_id", "=", $user->id)
            ->where('status', '=', "paid")
            ->first());
    }

    /**
     * https://stackoverflow.com/questions/32304475/how-to-get-model-object-using-its-name-from-a-variable-in-laravel-5 -> check this post
     * on how to make modular model post
     * @param $type
     * @param $id
     * @return null
     */
    private function model($type, $id)
    {
        $modelPrefix = 'App\Model';
        $model = $modelPrefix . '\\' . $type;

        return $model::find($id);
    }
}
