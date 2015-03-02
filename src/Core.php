<?php

namespace Regitec;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Core implements HttpKernelInterface
{
    protected $routes = array();

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            $action = $attributes['action'];
            unset($attributes['controller']);
            unset($attributes['action']);
            unset($attributes['_route']);

            $class = new $controller();

            $response = call_user_func_array(array($class, $action), $attributes);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        }
                                                                                                                                            
        return $response;
    }

    public function map($path, $controller) {
        $this->routes->add($path, new Route(
            $path,
            array('controller' => $controller)
        ));
    }
}
