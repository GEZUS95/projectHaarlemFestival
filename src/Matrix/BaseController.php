<?php
namespace Matrix;

use eftec\bladeone\BladeOne;
use Exception;
use Symfony\Component\HttpFoundation\Response;


class BaseController
{
    private string $views = 'C:\Users\merli\PhpstormProjects\projectHaarlemFestival\src\Views';
    private string $cache = 'C:\Users\merli\PhpstormProjects\projectHaarlemFestival\cache';
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
}
