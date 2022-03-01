<?php


namespace App\Http\Controller\Admin;

use App\Model\Performer;
use App\Model\Permissions;
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
        return $this->render('partials.admin.partials.performers.overview', []);
    }

    public function search(Request $request, $search): Response
    {
        $performers = Performer::query()->where(function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        })->get();

        return $this->json(["performer" => $performers]);
    }

    public function show(Request $request, $page, $amount): Response
    {
        $skip = $page * $amount;
        $performers = Performer::query()->skip($skip)->take($amount)->get();

        return $this->json(["performer" => $performers]);
    }

    public function save(Request $request): Response
    {
        return $this->json(
            ["Success" => "Successfully created the Performer"]
        );
    }

    public function single(Request $request, $id): Response
    {
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
        return $this->json(
            ["Success" => "Successfully deleted the Performer"]
        );
    }

}
