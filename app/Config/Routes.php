<?php

use App\Controllers\Ctrlconnexion;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/Login', 'CtrlSession::verifConnexion');
