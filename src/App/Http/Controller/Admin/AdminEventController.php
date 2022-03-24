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

    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PAGE__);

        $events = Event::query()->get()->map->only(['title', 'id']);

        return $this->json($events);
    }

    /**
     * @throws Exception
     */
    public function show($id): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);

        $event = Event::find($id);

        return $this->render('partials.admin.partials.event', ["event" => $event]);
    }

    /**
     * @throws Exception
     */
    public function overview(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_EVENT_OVERVIEW_PAGE__);

        $data = $request->request->all();

        //@todo carbon doesnt look at second week now but gets correct query

        $parsedDate = Carbon::parse(strtotime($data["date"]));
        $startOfWeek = $parsedDate->format('Y-m-d H:i');
        $endOfWeek = $parsedDate->copy()->endOfWeek()->format('Y-m-d H:i');

        $event = Event::query()
            ->where("id", "=", $id)
            ->with("programs")
            ->with("programs.items")
            ->with("programs.items.location")
            ->with("programs.items.performer")
            ->first();

        if($event == null)
            $event = Event::query()
                ->where("id", "=", $id)->first();

        //@TOdo FIX THIS QUERY but running out of time so unluko!
        //->where("id", "=", $id)
        //->with(['programs' => function ($query) use ($endOfWeek, $startOfWeek) {
        //    $query->where('start_time', '>=', $startOfWeek);
        //    $query->where('end_time', '<=', $endOfWeek);
        //    $query->with("items");
        //    $query->with("items.location");
        //    $query->with("items.performer");
        //}])->first();

        return $this->json(["events" => $event, "start" => $startOfWeek, "end" => $endOfWeek, "date" =>$data["date"]]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_EVENT_PAGE__);

        $data = $request->request->all();

        $rules = [
            'token' => ['required', new TokenValidation("event_create_form_csrf_token")],
            'title' => ['required'],
            'description' => ['required'],
            'total_price_event' => ['required', 'integer'],
        ];

        $this->validate($data, $rules);

        $event = Event::create([
            'title' => $data["title"],
            'description' => $data["description"],
            'total_price_event' => $data["total_price_event"],
        ]);

        Image::uploadFile($_FILES["file"], $event);

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

        $event = Event::query()->where('id', '=', $id)->first();
        $event["images"] = $event->images;

        return $this->json(["event" => $event]);
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
            'title' => ['required'],
            'description' => ['required'],
            'total_price_event' => ['required', 'integer'],
        ];

        $this->validate($data, $rules);

        Event::findOrFail($id)->update([
            'title' => $data["title"],
            'description' => $data["description"],
            'total_price_event' => $data["total_price_event"],
        ]);

        Image::updateFiles($_FILES["file"], Event::find($id));

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
