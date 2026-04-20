<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Players::index');
$routes->get('/players', 'Players::index');
$routes->get('/players/(:num)', 'Players::show/$1');
$routes->post('/players/delete/(:num)', 'Players::delete/$1');
