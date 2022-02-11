<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Response;

class AdminPerformerController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PERFORMER_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.performers.overview', []);
    }

}
