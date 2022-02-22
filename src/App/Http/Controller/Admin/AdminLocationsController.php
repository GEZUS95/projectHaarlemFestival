<?php


namespace App\Http\Controller\Admin;

use App\Model\Image;
use App\Model\Location;
use App\Model\Permissions;
use Carbon\Carbon;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
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

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        $data = $request->request->all();

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'seats' => 'required',
                'color' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->json(json_encode(print_r($validator->errors())));
        }

        $location = Location::create([
            'name' => $data["name"],
            'city' => $data["city"],
            'address' => $data["address"],
            'stage' => $data["stage"],
            'color' => $data["color"],
            'seats' => $data["seats"],
        ]);

        Image::uploadFile($_FILES["file"], $location);

        return $this->json(
            ["Success" => "Successfully added the location"]
        );
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        $this->session->set("locations_update_form_csrf_token",  bin2hex(random_bytes(24)));

        $location = Location::findOrFail($id);
        $location["file"] = Image::getImagePath($location);

        return $this->render('partials.admin.partials.locations.single', ["loc" => json_encode($location)]);
    }

    public function update(Request $request, $id){

    }

    public function delete(Request $request, $id){

    }

}
