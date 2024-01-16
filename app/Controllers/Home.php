<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        session_start();
        $ctrlConnexion = new \App\Controllers\Ctrlsession();
        if(session()->get('is_logged') == true){
            return $ctrlConnexion->pageAccueil('vue_navigation');
        } 
        else{
            return $ctrlConnexion->pageConnexion('vue_connexion.php') . view('vue_logo') . view('vue_formulaire');
        }
    }
}
