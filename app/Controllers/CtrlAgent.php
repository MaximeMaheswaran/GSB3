<?php

namespace App\Controllers;

class CtrlAgent extends BaseController
{
    /**
     * Renvoie vers la page d'accueil pour agent
     * @return des vue
     */
    public function accueilAgent()
    {
        $session = \Config\Services::session();
        session_start();
        // Verification si c'est un agent
        if (isset($_SESSION['matricule'])) {
            // Le titre dans l'onglet
            $data['title'] = "GSB3 | Accueil";
            return view('vue_entete', $data)
                . view('vue_nav_agent');
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Renvoie vers la page où sont les informations de l'agent
     * @return des vue
     */
    public function monCompteAgent()
    {
        $session = \Config\Services::session();
        $modele = new \App\Models\MonModele();
        session_start();
        // Verification si c'est un agent
        if (isset($_SESSION['matricule'])) {
            // Le titre dans l'onglet
            $data['title'] = "GSB3 | Mon Compte";
            // Recuperation des donées de l'agent depuis la bdd
            $data['informations'] = $modele->getUnAgentId(session()->get('id'));
            return view('vue_entete', $data)
                . view('vue_nav_agent')
                . view('vue_informations_personnelle');
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Renvoie vers la page de validation des présence des visiteurs aux presentations
     */
    public function aValiderAgent()
    {
        $session = \Config\Services::session();
        $modele = new \App\Models\MonModele();
        session_start();
        // Verification si c'est un agent
        if (isset($_SESSION['matricule'])) {
            // Le titre dans l'onglet
            $data['title'] = "GSB3 | A Valier";
            // Recuperation les données des visiteur qui ont reserver une presentation
            $data['visiteursAValider'] = $modele->getLesVisiteurAReserver();
            return view('vue_entete', $data)
                . view('vue_nav_agent')
                . view('vue_table_a_valider');
        } else {
            return redirect()->to('/');
        }
    }
}