<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

class FrontendController extends BaseController
{

    /**
     * @throws Exception
     */
    public function javascript(Request $request): BinaryFileResponse
    {
        $file = dirname(__DIR__, 4).'/public/main.js';
        $response = new BinaryFileResponse($file);
        $response->setPublic();
        $response->setMaxAge(1);
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;
    }

    public function style(Request $request): BinaryFileResponse
    {
        $file = dirname(__DIR__, 4).'/public/main.css';
        $response = new BinaryFileResponse($file);
        $response->setPublic();
        $response->setMaxAge(1);
        $response->headers->set('Content-Type', 'text/css');
        return $response;
    }

    public function images(Request $request, $slug): BinaryFileResponse
    {
        $file = dirname(__DIR__, 4).'/resources/uploads/'.$slug;
        $response = new BinaryFileResponse($file);
        $response->setPublic();
        $response->setMaxAge(1);
        return $response;
    }

}
