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
$routes->get('/CtrlInscription/desinscription/(:num)', 'CtrlInscription::desinscription/$1');
$routes->get('/CtrlInscription/inscription/(:num)/(:num)', 'CtrlInscription::inscription/$1/$2');
$routes->get('/CtrlInscription/desinscription/(:num)/(:num)', 'CtrlInscription::desinscription/$1/$2');
$routes->get('information', 'CtrlInformation::index');
$routes->post('/CtrlInformation/activerModification', 'CtrlInformation::modification');
$routes->post('/CtrlInformation/mettreAJourInformations', 'CtrlInformation::mettreAJourInformations');

