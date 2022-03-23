<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends BaseController
{

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Get the order if it exist
     * @throws Exception
     */
    public function index()
    {
    }

    /**
     * Make a post request to the back end with (id, type) example (id:1, type)
     * Add the type to the order and create the order if it doenst exist -> call $this->create
     * call this->model
     * get the model and add the type to the order
     * @param Request $request
     */
    public function add(Request $request)
    {
    }

    /**
     * Same as the add function but instead remove the order
     * @param Request $request
     */
    public function remove(Request $request){

    }

    /**
     * Check if the user is logged in
     * Get the logged-in user
     * Delete the order of the user that is logged in
     * @param Request $request
     */
    public function delete(Request $request){

    }

    /**PROB what to do this with ajax so you can live update thi with the molly()
     * Get the order and all the total prices of the program, event, item, restaurant
     * Make molly api call and finalize the order
     * @param Request $request
     */
    public function invoice(Request $request){

    }

    /**
     * Wait for the response and finalize the order!
     * @param Request $request
     */
    public function molly(Request $request){

    }

    /**
     * Call this function when creating a program
     * if the order already exist for the current user just return the order
     * @param $user
     */
    private function create($user){

    }

    /**
     * https://stackoverflow.com/questions/32304475/how-to-get-model-object-using-its-name-from-a-variable-in-laravel-5 -> check this post
     * on how to make modular model post
     * @param $type
     * @return null
     */
    private function model($type){

        $model = null;

        return $model;
    }
}
