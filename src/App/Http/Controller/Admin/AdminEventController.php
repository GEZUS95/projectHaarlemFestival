<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Response;

class AdminEventController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index($title): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.events.overview', []);
    }

    /**
     * @throws Exception
     */
    public function edit($title): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_VIEW_EVENT_PAGE__);
        return $this->render('partials.admin.partials.events.single', []);
    }
}
