<?php

namespace  App\Http\Middleware;

use Exception;

class VerifyCsrfToken {

    /**
     * @throws Exception
     */
    public function __construct()
    {
        var_dump("This middle ware got called");
    }

}