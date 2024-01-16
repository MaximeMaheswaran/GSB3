<?php

use App\Controllers\Ctrlconnexion;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/CtrlSession/verifConnexion', 'CtrlSession::verifConnexion');
$routes->get('/CtrlInscription/getLesPresentations', 'CtrlInscription::afficherPresentations');
$routes->get('deconnexion', 'CtrlSession::deconnexion');
$routes->get('presentation/detail/(:num)', 'CtrlInscription::detailDeUnePresentation/$1');
$routes->get('/CtrlInscription/inscription/(:num)', 'CtrlInscription::inscription/$1');

