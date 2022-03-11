<?php

namespace App\Http\Controller\Admin;

use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Response;

class AdminRestaurantTypesController extends BaseController
{
    public function index(): Response
    {
//        GuardManager::guard(Permissions::__VIEW_CMS_RESTAURANT_OVERVIEW_PAGE__);

        return $this->json(["test"]);
    }

}
