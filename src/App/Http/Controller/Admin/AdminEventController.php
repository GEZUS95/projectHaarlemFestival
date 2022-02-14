<?php


namespace App\Http\Controller\Admin;

use App\Model\Event;
use App\Model\Permissions;
use Carbon\Carbon;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminEventController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index($title): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.events.overview', ["event_title" => $title]);
    }

    public function event(Request $request, $title): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);

        $data = $request->request->all();

        $parsedDate = Carbon::parse($data["date"]);
        $startOfWeek = $parsedDate->startOfWeek()->format('Y-m-d H:i');
        $endOfWeek = $parsedDate->endOfWeek()->format('Y-m-d H:i');

        $event = Event::query()
            ->where("title", "=", $title)
            ->whereRelation('programs', 'start_time', '>=', $startOfWeek)
            ->whereRelation('programs', 'end_time', '<=', $endOfWeek)
            ->with("programs.items")
            ->with("programs.items.locations")
            ->with("programs.items.performer")
            ->get()
            ->toJson();

        return $this->json(["events" => $event]);
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
