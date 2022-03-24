<?php

namespace App\Http\Controller;

use App\Model\Order;
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
        $user = AuthManager::getCurrentUser();
        return $this->render("partials.tests.order", ['order' => $this->getOrder($user)]);
    }

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Get the receipt if it exist
     * @throws Exception
     */
    public function receipt(): Response
    {
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
    public function add(Request $request): Response
    {
        $data = $request->request->all();
        $rules = [
            'id' => 'required',
            'type' => 'required',
        ];
        $this->validate($data, $rules);

        $model = $this->model($data['type'], $data['id']);
        $order = $this->getOrder(AuthManager::getCurrentUser());

        $model->orders()->attach($order);
        return $this->render("partials.tests.order", ['order' => $this->getOrder(AuthManager::getCurrentUser())]);
    }

    /**
     * Same as the add function but instead remove the order
     * @param Request $request
     * validate request
     * @throws Exception
     */
    public function remove(Request $request): Response
    {
        $data = $request->request->all();
        $rules = [
            'id' => 'required',
            'type' => 'required',
        ];
        $this->validate($data, $rules);

        $model = $this->model($data['type'], $data['id']);
        $order = $this->getOrder(AuthManager::getCurrentUser());

        $model->orders($order)->detach();
        return $this->render("partials.tests.order", ['order' => $this->getOrder(AuthManager::getCurrentUser())]);
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
        $order = $this->getOrder(AuthManager::getCurrentUser());

        $order->delete();

        return $this->render("partials.tests.order", ['order' => $this->getOrder(AuthManager::getCurrentUser())]);
    }

    /**
     * Wait for the response and finalize the order!
     * @param Request $request
     * @return Response|void
     * @throws ApiException
     * @throws Exception
     */
    public function webhook(Request $request)
    {
        $mollie = new MollieApiClient();
        $mollie->setApiKey($_ENV['MOLLIE_API_KEY']);

        try {
            /*
             * Retrieve the payment's.
             */
            $payment = $mollie->payments->get($_POST["id"]);


            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
                $order = $this::find($payment->metadata["order_id"])->update(["paid" => true]);
                return $this->render("partials.tests.invoice", ['order' => $order]);


            } elseif ($payment->isOpen()) {
                /*
                 * The payment is open.
                 */
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
            } elseif ($payment->isFailed()) {
                /*
                 * The payment has failed.
                 */
            } elseif ($payment->isExpired()) {
                /*
                 * The payment is expired.
                 */
            } elseif ($payment->isCanceled()) {
                /*
                 * The payment has been canceled.
                 */
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
            }
        } catch (ApiException $e) {
            //echo "API call failed: " . htmlspecialchars($e->getMessage());
            echo "Someting went wong!";
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
            ->where('paid', '=', false)
            ->first();

        if ($order != null)
            return $order;

        return Order::create([
            'paid' => false,
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
            ->where('paid', '=', true)
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
