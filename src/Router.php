<?php

namespace Regitec;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router
{
    public function getRoutes()
    {
        $routes = new RouteCollection();

        $route = new Route('/', array('controller' => 'Regitec\Controller\HomeController', 'action' => 'indexAction'));
        $routes->add('index', $route);

        $route = new Route('/registration', array('controller' => 'Regitec\Controller\HomeController', 'action' => 'registrationAction'));
        $routes->add('registration', $route);

        $route = new Route('/profile/{id}', array('controller' => 'Regitec\Controller\HomeController', 'action' => 'profileAction'));
        $routes->add('profile', $route);

        $route = new Route('/signup', array('controller' => 'Regitec\Controller\HomeController', 'action' => 'signUpAction'));
        $routes->add('signup', $route);

        return $routes;
    }

}