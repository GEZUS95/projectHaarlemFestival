<?php
namespace Matrix;

use eftec\bladeone\BladeOne;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    private BladeOne $blade;

    function __construct() {
        $this->blade = new BladeOne($_ENV['VIEW_FILE_LOCATION'],$_ENV['COMPILED_FILE_LOCATION'],BladeOne::MODE_DEBUG);
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
}
