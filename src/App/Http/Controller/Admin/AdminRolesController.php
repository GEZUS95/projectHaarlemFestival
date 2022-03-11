<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\Role;
use App\Rules\EventExistValidation;
use App\Rules\PermissionExistValidation;
use App\Rules\TokenValidation;
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

        $this->session->set("roles_create_form_csrf_token", bin2hex(random_bytes(24)));
        $this->session->set("roles_update_form_csrf_token", bin2hex(random_bytes(24)));

        return $this->render('partials.admin.partials.roles.overview', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_ROLES_PAGE__);

        $roles = Role::query()->where(function ($query) use ($search) {
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
        $rules = [
            'token' => ['required', new TokenValidation("roles_create_form_csrf_token")],
            'name' => 'required',
            'permissions' => [new PermissionExistValidation],
        ];

        $this->validate($data, $rules);

        $perms = [];
        foreach (explode(",", $data["permissions"]) as $perm) {
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
        $rules = [
            'token' => ['required', new TokenValidation("roles_update_form_csrf_token")],
            'name' => 'required',
            'permissions' => [new PermissionExistValidation],
        ];

        $this->validate($data, $rules);

        $perms = [];
        foreach (explode(",", $data["permissions"]) as $perm) {
            array_push($perms, $perm);
        }

        Role::findOrFail($id)->update([
            'name' => $data["name"],
            'permissions' => json_encode($perms)
        ]);

        return $this->json(["Success" => "Successfully updated the role"]);
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        //@todo check current user role and if a role get deleted make sure there is a fallback role for those users!
        Role::findOrFail($id)->delete();

        return $this->json(
            ["Success" => "Successfully deleted the location"]
        );
    }
}
