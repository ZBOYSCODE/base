<?php
	/*
	 * Define custom routes. File gets included in the router service definition.
	 */
	$router = new Phalcon\Mvc\Router();

	$router->add('/', array(
	    'controller'    =>  'index',
	    'action'        =>  'index'
	));

    $router->add('/login', array(
        'controller'    =>  'session',
        'action'        =>  'login'
    ));

    $router->add('/logout', array(
        'controller'    =>  'session',
        'action'        =>  'logout'
    ));

    $router->add('/maestros/:controller/:action/:params', [
        'namespace'  => 'App\Controllers\Maestros',
        'controller' => 1,
        'action'     => 2,
        'params'     => 3,
    ]);

    $router->add('/maestros/:controller', [
        'namespace'  => 'App\Controllers\Maestros',
        'controller' => 1
    ]);

    $router->add('/maestros/:controller/', [
        'namespace'  => 'App\Controllers\Maestros',
        'controller' => 1
    ]);
	return $router;