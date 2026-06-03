<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'People::index');

service('auth')->routes($routes);

$routes->group('', ['filter' => 'group:admin'], static function($routes){
    $routes->get('create', 'People::create');
    $routes->post('store', 'People::store');
    $routes->get('edit/(:num)', 'People::edit/$1');
    $routes->post('update/(:num)', 'People::update/$1');
    $routes->post('delete/(:num)', 'People::delete/$1');
});




    
