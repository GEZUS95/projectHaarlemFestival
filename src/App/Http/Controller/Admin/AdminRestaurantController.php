<?php


namespace App\Http\Controller\Admin;

use App\Model\Permissions;
use App\Model\Restaurant;
use Exception;
use Matrix\BaseController;
use Matrix\Managers\GuardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRestaurantController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        GuardManager::guard(Permissions::__VIEW_CMS_RESTAURANT_OVERVIEW_PAGE__);
        return $this->render('partials.admin.partials.restaurants', []);
    }

    public function search(Request $request, $search): Response
    {
        GuardManager::guard(Permissions::__VIEW_RESTAURANT_PAGE__);

        $location = Restaurant::query()->where(function ($query) use($search) {
//            $query->where('city', 'like', '%' . $search . '%')
//                ->orWhere('name', 'like', '%' . $search . '%')
//                ->orWhere('address', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["location" => $location]);
    }

    /**
     * @throws Exception
     */
    public function show(Request $request, $page, $amount): Response
    {
        GuardManager::guard(Permissions::__VIEW_RESTAURANT_PAGE__);

        $skip = $page * $amount;
        $location = Restaurant::query()->skip($skip)->take($amount)->get();

        return $this->json(["restaurant" => $location]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        return $this->json(
            ["Success" => "Successfully added the restaurant"]
        );
    }

    /**
     * @throws Exception
     */
    public function single(Request $request, $id): Response
    {
        return $this->json(["restaurant" => []]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, $id): Response
    {
        return $this->json(
            ["Success" => "Successfully updated the restaurant"]
        );
    }

    public function delete(Request $request, $id): Response
    {
        return $this->json(
            ["Success" => "Successfully deleted the restaurant"]
        );
    }

}
