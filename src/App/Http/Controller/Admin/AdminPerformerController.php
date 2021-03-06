<?php


namespace App\Http\Controller\Admin;

use App\Model\Image;
use App\Model\Performer;
use App\Model\Permissions;
use App\Rules\TokenValidation;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPerformerController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PERFORMER_OVERVIEW_PAGE__);

        return $this->render('partials.admin.partials.performers', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_PERFORMER_OVERVIEW_PAGE__);

        $performers = Performer::query()->where(function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["performer" => $performers]);
    }

    public function show(Request $request, $page, $amount): Response
    {
        GuardManager::guard(Permissions::__VIEW_PERFORMER_PAGE__);

        $skip = $page * $amount;
        $performers = Performer::query()->skip($skip)->take($amount)->get();

        return $this->json(["performer" => $performers]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_PERFORMER_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("performer_create_form_csrf_token")],
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validate($data, $rules);

        $model = Performer::create([
            'name' => $data["name"],
            'description' => $data["description"],
        ]);

        Image::uploadFile($_FILES["file"], $model);

        return $this->json(
            ["Success" => "Successfully created the Performer"]
        );
    }

    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_PERFORMER_PAGE__);

        $performer = Performer::query()->where('id', '=', $id)->first();
        $performer["images"] = $performer->images;

        return $this->json(["performer" => $performer]);
    }

    public function update(Request $request, $id): Response
    {
        return $this->json(
            ["Success" => "Successfully updated the Performer"]
        );
    }

    public function delete(Request $request, $id): Response
    {

        GuardManager::guard(Permissions::__WRITE_PERFORMER_PAGE__);

        $model = Performer::findOrFail($id);

        Image::deleteFile($model->images[0]->file_location);

        $model->delete();

        return $this->json(
            ["Success" => "Successfully deleted the Performer"]
        );
    }

}
