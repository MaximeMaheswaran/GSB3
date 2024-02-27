<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $modele = new \App\Models\ModelePresentation();
        session_start();
        // Automatiquement il historise les presentattion des visiteur;
        $modele->autoHistorique();
        $ctrlConnexion = new \App\Controllers\CtrlSession();
        // Verification si quelqu'un est connecter
        if (session()->get('is_logged') == true) {
            // Verification si c'est un visiteur qui est connecter
            if (!isset($_SESSION['matricule'])) {
                // Page d'accueil du visiteur
                return $ctrlConnexion->pageAccueil();
            } else {
                // Page d'accueil du agent
                return redirect()->to('/Agent/Home');
            }
        } else {
            // Page de connexion
            return $ctrlConnexion->pageConnexion();
        }
    }
}
