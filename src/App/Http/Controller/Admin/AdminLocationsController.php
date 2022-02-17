<?php


namespace App\Http\Controller\Admin;

use App\Model\Location;
use App\Model\Permissions;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLocationsController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_LOCATION_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.locations.overview', []);
    }

    public function show(Request $request, $page, $amount): Response
    {
        GuardManager::guard(Permissions::__VIEW_LOCATION_PAGE__);

        $skip = $page * $amount;
        $location = Location::query()->skip($skip)->take($amount)->get();

        return $this->json(["location" => $location]);
    }

}
