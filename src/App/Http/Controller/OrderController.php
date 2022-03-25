<?php

namespace App\Http\Controller;

use App\Model\Order;
use App\Rules\TokenValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Matrix\BaseController;
use Matrix\Managers\AuthManager;
use Matrix\Managers\RouteManager;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $user = AuthManager::getCurrentUser();
        return $this->render("partials.order.index", ['order' => $this->getOrder($user)]);
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
        return $this->render("partials.tests.receipt", ['receipt' => $this->getReceipt($user)]);
    }

    /**
     * Make a post request to the back end with (id, type) example (id:1, type)
     * Add the type to the order and create the order if it doenst exist -> call $this->create
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

        return $this->render("partials.tests.order", ['order' => $this->getOrder(AuthManager::getCurrentUser())]);
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

        try {
            $payment = $mollie->payments->get($_POST["id"]);

            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                Order::find($payment->metadata["order_id"])->update(["status" => "paid"]);
                return $this->json(["Error" => "Payment Success"]);
            }

            Order::find($payment->metadata["order_id"])->update(["status" => "normal"]);
            return $this->json(["Error" => "Payment Failed"]);
        } catch (ApiException $e) {
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
            "redirectUrl" => RouteManager::getUrlByRouteName("order"),
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
        $order = Order::query()
            ->where("user_id", "=", $user->id)
            ->where('status', '=', "normal")
            ->first();

        if ($order != null)
            return $order;

        return Order::create([
            'status' => "normal",
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
        return Order::query()
            ->where("user_id", "=", $user->id)
            ->where('status', '=', "paid")
            ->first();
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
