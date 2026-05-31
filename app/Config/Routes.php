<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'People::index');
$routes->get('create', 'People::create');
$routes->post('store', 'People::store');
//$routes->get('edit/(:num)', 'People::edit/$1');
//$routes->post('update/(:num)', 'People::update/$1');
$routes->post('delete/(:num)', 'People::delete/$1');



    
