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
     */
    public function invoice(Request $request)
    {

    }

    /**
     * Get the order and all the total prices of the program, event, item, restaurant
     * Make molly api call and finalize the order
     * @param Request $request
     * @throws ApiException
     */
    public function molly(Request $request)
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
                "value" => $total
            ],
            "description" => $user->name . ' ordered ',
            "redirectUrl" => RouteManager::getUrlByRouteName("order"),
            "webhookUrl" => RouteManager::getUrlByRouteName("invoice"),
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
