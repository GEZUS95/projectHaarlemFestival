<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\Role;
use App\Model\User;
use App\Rules\RoleExistValidation;
use App\Rules\TokenValidation;
use App\Rules\UserEmailAlreadyExistValidation;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\AuthManager;
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

        return $this->render('partials.admin.partials.users', []);
    }

    public function roles(): Response
    {
        GuardManager::guard(Permissions::__VIEW_USER_PAGE__);

        $roles = Role::query()->select('name','id')->get();

        return $this->json($roles);
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
        $rules = [
            'token' => ['required', new TokenValidation("users_create_form_csrf_token")],
            'name' => 'required',
            'email' => ['required','email'],
            'password' => 'required|min:8',
            'role_id' => ['required', new RoleExistValidation],
        ];

        $this->validate($data, $rules);

        //@todo send email and make sure the user has to activate account!
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role_id' => $data['role_id'],
        ]);

        return $this->json(["Success" => "Successfully added the user"]);
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__VIEW_USER_PAGE__);

        $user = User::query()->where('id', '=', $id)->first();

        return $this->json(["user" => $user]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_USER_PAGE__);

        $data = $request->request->all();
        $rules = [
            'token' => ['required', new TokenValidation("users_create_form_csrf_token")],
            'name' => 'required',
            'email' => ['required','email'],
            'role_id' => ['required', new RoleExistValidation],
        ];

        $this->validate($data, $rules);

        User::query()->find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ]);

        return $this->json(["Success" => "Successfully updated the user"]);
    }

    public function delete(Request $request, $id): Response
    {
        GuardManager::guard(Permissions::__WRITE_LOCATION_PAGE__);

        $user = User::findOrFail($id);

        if($user->id === AuthManager::getCurrentUser()->id)
            return $this->json(["Error" => "cant delete your self"]);

        $user->delete();
        return $this->json(["Success" => "Successfully deleted the user"]);
    }

}
