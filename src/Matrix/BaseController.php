<?php
namespace Matrix;

use eftec\bladeone\BladeOne;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class BaseController
{
    private string $views = '/home/merlijn/PhpstormProjects/Haarlem-festival/src/Views';
    private string $cache = '/home/merlijn/PhpstormProjects/Haarlem-festival/CompiledTemplates';
    private BladeOne $blade;

    function __construct() {
        $this->blade = new BladeOne($this->views,$this->cache,BladeOne::MODE_DEBUG);
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
