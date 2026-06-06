<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('people', 'People::index');

service('auth')->routes($routes);

$routes->group('people', ['filter' => 'group:admin'], static function($routes){
    $routes->get('create', 'People::create');
    $routes->post('store', 'People::store');
    $routes->get('edit/(:num)', 'People::edit/$1');
    $routes->post('update/(:num)', 'People::update/$1');
    $routes->post('delete/(:num)', 'People::delete/$1');
});

$routes->get('passwords/create', 'Password::create');
$routes->get('passwords', 'Password::index');
$routes->post('passwords/store', 'Password::store');
$routes->get('passwords/filter/(:num)/(:num)', 'Password::filter/$1/$2');
$routes->post('passwords/process-filter', 'Password::processFilter');
$routes->get('passwords/statistics', 'Password::statistics');