<?php
namespace Matrix;

use eftec\bladeone\BladeOne;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Matrix\Managers\SessionManager;

class BaseController
{
    private BladeOne $blade;
    protected SessionManager $session;

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
}
