<?php

namespace App\Http\Controller\Admin;

use App\Model\Item;
use App\Model\Location;
use App\Model\Performer;
use App\Model\Permissions;
use App\Rules\ItemIsBetweenProgramTimes;
use App\Rules\LocationExistValidation;
use App\Rules\PerformerExistValidation;
use App\Rules\ProgramExistValidation;
use App\Rules\TokenValidation;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminItemController extends BaseController
{
    public function performers(): Response
    {
        GuardManager::guard(Permissions::__VIEW_ITEM_PAGE__);

        $performers = Performer::query()->get()->map->only(['name', 'id']);

        return $this->json($performers);
    }

    public function locations(): Response
    {
        GuardManager::guard(Permissions::__VIEW_ITEM_PAGE__);

        $locations = Location::query()->get()->map->only(['name', 'id']);

        return $this->json($locations);
    }

    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_ITEM_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("validate_form_token")],
            'program_id' => ['required', new ProgramExistValidation()],
            'start_time' => ['required', new ItemIsBetweenProgramTimes($data["program_id"])],
            'end_time' => ['required', new ItemIsBetweenProgramTimes($data["program_id"])],
            'price' => ['required', 'integer'],
            'location_id' => ['required', new LocationExistValidation()],
            'performer_id' => ['required', new PerformerExistValidation()],
            'special_guest_id' => [new PerformerExistValidation()]
        ];

        $this->validate($data, $rules);

        Item::create([
            'program_id' => $data["program_id"],
            'location_id' => $data["location_id"],
            'performer_id' => $data["performer_id"],
            'special_guest_id' => $data["special_guest_id"],
            'start_time' => $data["start_time"],
            'end_time' => $data["end_time"],
            'price' => $data["price"],
        ]);

        return $this->json(
            ["Success" => $data]
        );
    }
}
