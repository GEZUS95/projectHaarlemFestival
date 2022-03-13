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

        $this->initFormTokens();

        return $this->render('partials.admin.index', []);
    }

    public function getEventTitles(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PAGE__);

        $eventTitles = Event::query()->get()->map->only(['title']);

        return $this->json(["titles" => $eventTitles]);
    }

    /**
     * @throws Exception
     */
    private function initFormTokens(){

        $tokens = [
            'event_create_form_csrf_token',
            'event_update_form_csrf_token',
            'performer_create_form_csrf_token',
            'performer_update_form_csrf_token',
            'locations_create_form_csrf_token',
            'locations_update_form_csrf_token',
            'roles_create_form_csrf_token',
            'roles_update_form_csrf_token',
            'users_create_form_csrf_token',
            'users_update_form_csrf_token',
        ];

        foreach ($tokens as $token) {
            $this->session->set($token,  bin2hex(random_bytes(24)));
        }
    }
}
