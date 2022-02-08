<?php


namespace App\Http\Controller\Admin;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Response;

class AdminMainController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {

        return $this->render('partials.admin.index', []);
    }

}
