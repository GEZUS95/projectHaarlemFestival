<?php

namespace App\Http\Controller\Admin;

use App\Model\Location;
use App\Model\Performer;
use App\Model\Permissions;
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
        ];

        $this->validate($data, $rules);

        return $this->json(
            ["Success" => $data]
        );
    }
}
