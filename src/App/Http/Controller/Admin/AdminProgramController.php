<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminProgramController extends BaseController
{

    /**
     * @throws Exception
     */
    public function create(Request $request): Response
    {
        GuardManager::guard(Permissions::__CREATE_NEW_PROGRAM__);

        $data = $request->request->all();

        return $this->json(["test"]);
    }

}
