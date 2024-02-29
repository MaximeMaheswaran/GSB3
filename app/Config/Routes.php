<?php

use App\Controllers\Ctrlconnexion;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/CtrlSession/verifConnexion', 'CtrlSession::verifConnexion');
$routes->get('deconnexion', 'CtrlSession::deconnexion');


/*----------------- Conferences -------------------- */
$routes->get('/Conferences/Presentations/', 'CtrlConferences::afficherPresentations');
$routes->get('/Conferences/MesReservation/', 'CtrlConferences::afficherPresentationsReserver');
$routes->get('/Conferences/Presentation/Detail/(:num)', 'CtrlConferences::detailDeUnePresentation/$1');
$routes->get('/Conferences/inscription/(:num)', 'CtrlConferences::inscription/$1');
$routes->get('/Conferences/Presentation/Detail/Reserver/(:num)/(:num)', 'CtrlConferences::inscription/$1/$2');
$routes->get('/Conferences/desinscription/(:num)', 'CtrlConferences::desinscription/$1');
$routes->get('/Conferences/Presentation/Detail/Dereserver/(:num)/(:num)', 'CtrlConferences::desinscription/$1/$2');
$routes->get('/Conferences/Historiques/', 'CtrlConferences::historiqueVisiteur');


/*-----------------               -----------------------*/
$routes->get('/Visiteur/Compte/', 'CtrlInformation::index');
$routes->post('/Visiteur/Compte/Modif', 'CtrlInformation::modification');
$routes->post('/Visiteur/Compte/Modif/Maj', 'CtrlInformation::mettreAJourInformations');

/*-------------- Agent -----------------*/
$routes->get('/Agent/Home', 'CtrlAgent::accueilAgent');
$routes->get('/Agent/Moncompte', 'CtrlAgent::monCompteAgent');
$routes->get('/Agent/Visiteur/A_valider/(:num)/(:any)', 'CtrlAgent::aValiderParam/$1/$2');
$routes->get('/Agent/Visiteur/A_valider', 'CtrlAgent::aValiderAgent');
$routes->post('/Agent/Visiteur/A_valider', 'CtrlAgent::aValiderAgent');
$routes->get('/Agent/Visiteur/Present', 'CtrlAgent::dejaValiderAgent');
