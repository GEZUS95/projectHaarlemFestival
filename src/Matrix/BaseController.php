<?php
namespace Matrix;

use eftec\bladeone\BladeOne;
use Exception;
use Matrix\Exception\DataIsNotCorrectlyValidated;
use Matrix\Factory\ValidatorFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Matrix\Managers\SessionManager;

class BaseController
{
    private BladeOne $blade;
    protected SessionManager $session;
    protected array $rules;

    function __construct() {
        $this->blade = new BladeOne(dirname(__DIR__, 2) . "/resources/views",dirname(__DIR__, 2) . "/public/views",BladeOne::MODE_DEBUG);
        $this->session = SessionManager::getSessionManager();
    }

    /**
     * @throws Exception
     */
    protected function render($bladeName, $args): Response
    {
        return new Response(
            $this->blade->run($bladeName,$args)
        );
    }

    protected function json($args): Response
    {
        return new JsonResponse($args);
    }

    protected function Redirect($url): RedirectResponse
    {
        return new RedirectResponse($url);
    }

    protected function validate($data, $rules): void
    {
        $validator = (new ValidatorFactory())->make(
            $data,
            $rules,
        );

        if ($validator->fails()) {
            throw new DataIsNotCorrectlyValidated($validator->errors());
        }
    }
}
