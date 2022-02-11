<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Response;

class AdminRolesController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_ROLES_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.roles.overview', []);
    }

}