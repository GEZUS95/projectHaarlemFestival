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
//        GuardManager::guard(Permissions::__VIEW_LOCATION_PAGE__);

        $skip = $page * $amount;
        $location = Location::query()->skip($skip)->take($amount)->get();

        return $this->json(["location" => $location]);
    }


    /**
     * @throws Exception
     */
    public function create(Request $request): Response
    {
        $this->session->set("locations_create_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('partials.admin.partials.locations.create', []);
    }

    public function save(Request $request){

    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        var_dump($id);
        $this->session->set("locations_update_form_csrf_token",  bin2hex(random_bytes(24)));
        return $this->render('partials.admin.partials.locations.single', []);
    }

    public function update(Request $request, $id){

    }

    public function delete(Request $request, $id){

    }

}