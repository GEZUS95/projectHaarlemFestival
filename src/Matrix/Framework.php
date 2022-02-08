<?php

namespace Matrix;

use Matrix\Exception\NotLoggedInException;
use Matrix\Exception\UnauthorizedAccessException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{
    private UrlMatcher $matcher;
    private ControllerResolver $controllerResolver;
    private ArgumentResolver $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            highlight_string("<?php\n\$exception =\n" . var_export($exception, true) . ";\n?>");
            return new Response('Not Found', 404);
        } catch (UnauthorizedAccessException $exception) {
            highlight_string("<?php\n\$exception =\n" . var_export($exception, true) . ";\n?>");
            return new Response('Unauthorized', 403);
        }catch (NotLoggedInException $exception) {
            highlight_string("<?php\n\$exception =\n" . var_export($exception, true) . ";\n?>");
            return new RedirectResponse('/login', 303);
        } catch (\Exception $exception) {
            highlight_string("<?php\n\$exception =\n" . var_export($exception, true) . ";\n?>");
            return new Response('An error occurred', 500);
        }
    }
}
