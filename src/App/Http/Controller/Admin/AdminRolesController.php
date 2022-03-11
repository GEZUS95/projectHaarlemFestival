<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\Role;
use App\Rules\PermissionExist;
use Exception;
use Matrix\BaseController;
use Matrix\Factory\ValidatorFactory;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRolesController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_ROLES_OVERVIEW_PAGE__);

        $this->session->set("roles_create_form_csrf_token",  bin2hex(random_bytes(24)));
        $this->session->set("roles_update_form_csrf_token",  bin2hex(random_bytes(24)));

        return $this->render('partials.admin.partials.roles.overview', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_ROLES_PAGE__);

        $roles = Role::query()->where(function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["roles" => $roles]);
    }

    /**
     * @throws Exception
     */
    public function show(Request $request, $page, $amount): Response
    {
        GuardManager::guard(Permissions::__VIEW_ROLES_PAGE__);

        $skip = $page * $amount;
        $roles = Role::query()->skip($skip)->take($amount)->get();

        return $this->json(["roles" => $roles]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        GuardManager::guard(Permissions::__WRITE_ROLES_PAGE__);
        $data = $request->request->all();

        $validator = (new ValidatorFactory())->make(
            $data,
            [
                'token' => 'required',
                'name' => 'required',
                'permissions' => [new PermissionExist],
            ]
        );

        if ($validator->fails())
            return $this->json(json_encode(print_r($validator->errors())));

        if($data["token"] != $this->session->get("roles_create_form_csrf_token"))
            return new Response('Unauthorized', 403);

        $perms = [];
        foreach (explode(",", $data["permissions"]) as $perm){
            array_push($perms, $perm);
        }

        Role::create([
            'name' => $data["name"],
            'permissions' => json_encode($perms)
        ]);

        return $this->json(
            ["Success" => "Successfully added the location"]
        );
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_ROLES_PAGE__);

        $role = Role::query()->where('id', '=', $id)->first();

        return $this->json(["roles" => $role]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_ROLES_PAGE__);

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

        Role::findOrFail($id)->delete();

        return $this->json(
            ["Success" => "Successfully deleted the location"]
        );
    }

}
