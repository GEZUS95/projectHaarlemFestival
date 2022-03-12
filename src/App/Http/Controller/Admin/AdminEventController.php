<?php


namespace App\Http\Controller\Admin;

use App\Model\Event;
use App\Model\Image;
use App\Model\Permissions;
use App\Rules\TokenValidation;
use Carbon\Carbon;
use Exception;
use Matrix\BaseController;
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

        $this->session->set("event_create_form_csrf_token",  bin2hex(random_bytes(24)));
        $this->session->set("event_update_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('partials.admin.partials.events.overview', ["event_title" => $title]);
    }

    /**
     * @throws Exception
     */
    public function overview(Request $request, $title): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);

        $data = $request->request->all();

        $parsedDate = Carbon::parse(strtotime($data["date"]));
        $startOfWeek = $parsedDate->format('Y-m-d H:i');
        $endOfWeek = $parsedDate->copy()->endOfWeek()->format('Y-m-d H:i');

        $event = Event::query()
            ->where("title", "=", $title)
            ->whereRelation('programs', 'start_time', '>=', $startOfWeek)
            ->whereRelation('programs', 'end_time', '<=', $endOfWeek)
            ->with("programs.items")
            ->with("programs.items.location")
            ->with("programs.items.performer")
            ->first();

        return $this->json(["events" => json_encode($event)]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_EVENT_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("locations_create_form_csrf_token")],
        ];

        $this->validate($data, $rules);


        return $this->json(
            ["Success" => "Successfully added the location"]
        );
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_EVENT_PAGE__);


        return $this->json(["location" => "test"]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_EVENT_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("locations_update_form_csrf_token")],
        ];

        $this->validate($data, $rules);

//        Image::updateFiles($_FILES["file"], $model);

        return $this->json(
            ["Success" => "Successfully updated the location"]
        );
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_EVENT_PAGE__);

        $model = Event::findOrFail($id);

        Image::deleteFile($model->images[0]->file_location);

        $model->delete();

        return $this->json(
            ["Success" => "Successfully deleted the location"]
        );
    }

}
