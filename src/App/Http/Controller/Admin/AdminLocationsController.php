<?php


namespace App\Http\Controller\Admin;

use App\Model\Image;
use App\Model\Location;
use App\Model\Permissions;
use App\Rules\ColorValidation;
use App\Rules\TokenValidation;
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

        $this->session->set("locations_create_form_csrf_token",  bin2hex(random_bytes(24)));
        $this->session->set("locations_update_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('partials.admin.partials.locations', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_LOCATION_PAGE__);

        $location = Location::query()->where(function ($query) use($search) {
            $query->where('city', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["location" => $location]);
    }

    /**
     * @throws Exception
     */
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
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("locations_create_form_csrf_token")],
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'seats' => 'required',
            'color' => ['required','string', new ColorValidation],
        ];

        $this->validate($data, $rules);

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
        GuardManager::guard(Permissions::__VIEW_LOCATION_PAGE__);

        $location = Location::query()->where('id', '=', $id)->first();
        $location["images"] = $location->images;

        return $this->json(["location" => $location]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("locations_update_form_csrf_token")],
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'seats' => 'required',
            'color' => ['required','string', new ColorValidation],
        ];

        $this->validate($data, $rules);

        $model = Location::findOrFail($id)->update([
            'name' => $data["name"],
            'city' => $data["city"],
            'address' => $data["address"],
            'stage' => $data["stage"],
            'seats' => $data["seats"],
            'color' => $data["color"],
        ]);

        Image::updateFiles($_FILES["file"], $model);

        return $this->json(
            ["Success" => "Successfully updated the location"]
        );
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        $model = Location::findOrFail($id);

        Image::deleteFile($model->images[0]->file_location);

        $model->delete();

        return $this->json(
            ["Success" => "Successfully deleted the location"]
        );
    }
}
