<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Response;

class Permissions extends Model {

    public function getAllPermissions() {
        try {
            $reflectionClass = new ReflectionClass($this);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            return new Response('An error occurred', 500);
        }
    }

    public const __ADMIN__ = 'Admin';

}
