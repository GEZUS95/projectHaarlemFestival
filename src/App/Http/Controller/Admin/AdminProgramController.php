<?php /** @noinspection DuplicatedCode */


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\Program;
use App\Rules\ColorValidation;
use App\Rules\EventExistValidation;
use App\Rules\TokenValidation;
use Carbon\Carbon;
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
        $rules = [
            'color' => ['required','string', new ColorValidation],
            'end_time' => 'required',
            'start_time' => 'required',
            'event_id' => ['required', 'integer', new EventExistValidation],
            'title' => 'required|string',
            'total_price_program' => 'required|integer',
        ];

        $this->validate($data, $rules);

        $startTime = Carbon::parse($data["start_time"])->addHour();
        $endTime = Carbon::parse($data["end_time"])->addHour();

        Program::create([
            'title' => $data["title"],
            'total_price_program' => $data["total_price_program"],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'color' => $data["color"],
            'event_id' => $data["event_id"],
        ]);

        return $this->json(["success" => "successfully created program!"]);
    }

    public function show($id): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PROGRAM_OVERVIEW_PAGE__);

        $program = Program::query()
            ->where("id", "=", $id)
            ->with("items")
            ->with("items.location")
            ->with("items.performer")
            ->first();

        return $this->json($program);
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_PROGRAM_PAGE__);

        $program = Program::query()->where('id', '=', $id)->first();

        return $this->json(["program" => $program]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_PROGRAM_PAGE__);

        $data = $request->request->all();
        var_dump($data);
        $rules = [
            'token' => ['required', new TokenValidation("validate_form_token")],
            'color' => ['required','string', new ColorValidation],
            'end_time' => 'required',
            'start_time' => 'required',
            'event_id' => ['required', 'integer', new EventExistValidation],
            'title' => 'required|string',
            'total_price_program' => 'required|integer',
        ];

        $this->validate($data, $rules);

        $startTime = Carbon::parse($data["start_time"])->addHour();
        $endTime = Carbon::parse($data["end_time"])->addHour();

        Program::findOrFail($id)->update([
            'title' => $data["title"],
            'total_price_program' => $data["total_price_program"],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'color' => $data["color"],
            'event_id' => $data["event_id"],
        ]);

        return $this->json(["Success" => "Successfully updated the program"]);
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_PROGRAM_PAGE__);

        Program::findOrFail($id)->delete();

        return $this->json(
            ["Success" => "Successfully deleted the program"]
        );
    }
}
