<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\User;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUsersController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_USERS_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.users.overview', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_USER_PAGE__);

        $users = User::query()->where(function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["users" => $users]);
    }

    /**
     * @throws Exception
     */
    public function show(Request $request, $page, $amount): Response
    {
        GuardManager::guard(Permissions::__VIEW_USER_PAGE__);

        $skip = $page * $amount;
        $users = User::query()->skip($skip)->take($amount)->get();

        return $this->json(["users" => $users]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_USER_PAGE__);

        $data = $request->request->all();

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->json(json_encode(print_r($validator->errors())));
        }

        return $this->json(
            ["Success" => "Successfully added the location"]
        );
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_USER_PAGE__);

        $user = User::query()->where('id', '=', $id)->first();

        return $this->json(["location" => $user]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_USER_PAGE__);

        $data = $request->request->all();

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->json(json_encode(print_r($validator->errors())));
        }


        return $this->json(
            ["Success" => "Successfully updated the location"]
        );
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        User::findOrFail($id)->delete();

        return $this->json(
            ["Success" => "Successfully deleted the location"]
        );
    }

}
