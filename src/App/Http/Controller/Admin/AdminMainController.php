<?php


namespace App\Http\Controller\Admin;

use App\Model\Event;
use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Response;

class AdminMainController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PAGE__);

        return $this->render('partials.admin.index', []);
    }

    public function getEventTitles(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PAGE__);

        $eventTitles = Event::query()->get()->map->only(['title']);

        return $this->json(["titles" => $eventTitles]);
    }

}
