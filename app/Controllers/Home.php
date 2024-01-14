<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        session_start();
        $mesFonctions = new \App\Models\Mesfonctions();
        $estConnecte = $mesFonctions->estConnecte();
        if (!isset($_SESSION['uc']) || !$estConnecte) {
            $_SESSION['uc'] = 'connexion';
        }
        $uc = $_SESSION['uc'];
        switch ($uc) {
            case 'connexion': {
                    $ctrlConnexion = new \App\Controllers\Ctrlsession();
                    return $ctrlConnexion->pageConnexion('view_head_.php');break;
                }
            case 'catalogue': {
                    echo "reussi catalogue";break;
                }
            case 'etatFrais': {
                    echo "knksnlkj";break;
                }
        }
    }
}
