<?php
namespace Matrix\Factory;

use Illuminate\Validation;
use Illuminate\Translation;
use Illuminate\Filesystem\Filesystem;

class ValidatorFactory
{
    private $factory;

    public function __construct()
    {
        $this->factory = new Validation\Factory(
            $this->loadTranslator()
        );
    }

    protected function loadTranslator(): Translation\Translator
    {
        $filesystem = new Filesystem();
        $loader = new Translation\FileLoader(
            $filesystem, dirname(__FILE__, 2) . '/lang');
        $loader->addNamespace(
            'lang',
            dirname(__FILE__, 2) . '/lang'
        );
        $loader->load('en', 'validation', 'lang');
        return new Translation\Translator($loader, 'en');
    }
    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->factory, $method],
            $args
        );
    }
}
