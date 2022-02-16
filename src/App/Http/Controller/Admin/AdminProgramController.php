<?php


namespace App\Http\Controller\Admin;

use App\Model\Event;
use App\Model\Permissions;
use App\Model\Program;
use Carbon\Carbon;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
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

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'color' => 'required|string',
                'end_time' => 'required',
                'start_time' => 'required',
                'event_id' => 'required|integer',
                'title' => 'required|string',
                'total_price_program' => 'required|integer',
            ]
        );

        if ($validator->fails())
            return $this->json(['Error' => $validator->errors()]);

        $event = Event::find($data["event_id"]);
        if($event == null)
            return $this->json(['error' => "Event not found"]);

        $startTime = Carbon::parse($data["start_time"])->addHour();
        $endTime = Carbon::parse($data["end_time"])->addHour();

        Program::create([
            'title' => $data["title"],
            'total_price_program' => $data["total_price_program"],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'color' => $data["color"],
            'event_id' => $event->id,
        ]);

        return $this->json(json_encode(["success" => "successfully created item!"]));
    }

}
