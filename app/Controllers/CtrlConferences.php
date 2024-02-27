<?php

namespace App\Controllers;

class CtrlConferences extends BaseController
{

    public function afficherPresentations()
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['presentations'] = $modele->getLesPresentations();
            $data['modele'] = $modele;
            $data['title'] = "GSB | Présentation";
            return view('vue_logo.php')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_presentations', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function afficherPresentationsReserver()
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['presentations'] = $modele->getLesPresentationsReserver(session()->get('id'));
            $data['modele'] = $modele;
            $data['title'] = "GSB | Présentation";
            return view('vue_logo.php')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_presentations', $data);
        } else {
            return redirect()->to('/');
        }
    }



    public function detailDeUnePresentation($presentation_id)
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['presentation'] = $modele->getUnePresentation($presentation_id);
            $data['modele'] = $modele;
            $data['title'] = "GSB | Inscription";
            return view('vue_logo.php')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_unePresentation', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function inscription($presentation_id, $siegeId)
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['presentation'] = $modele->getUnePresentation($presentation_id);
            $data['salle_id'] = $modele->getTousLesSiegesDeUneSalle($data['presentation']['salle_id']);
            $modele->inscriptionPresentationPourUnePersonne($presentation_id, session()->get('id'), $siegeId);
            $data['modele'] = $modele;
            $data['title'] = "GSB | Inscription";
            return view('vue_logo.php')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_unePresentation', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function desinscription($presentation_id, $siegeId)
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['presentation'] = $modele->getUnePresentation($presentation_id);
            $data['salle_id'] = $modele->getTousLesSiegesDeUneSalle($data['presentation']['salle_id']);
            $modele->desinscriptionPresentationPourUnePersonne($presentation_id, session()->get('id'), $siegeId);
            $data['modele'] = $modele;
            $data['title'] = "GSB | Inscription";
            return view('vue_logo.php')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_unePresentation', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function historiqueVisiteur()
    {
        $modele = new \App\Models\MonModele();
        if ($modele->estConnecte()) {
            $modele = new \App\Models\ModelePresentation();
            $data['historiques'] = $modele->getHistoriqueVisiteur(session()->get('id'));
            $data['title'] = "GSB | Historique";
            return view('vue_logo')
                . view('vue_entete', $data)
                . view('vue_navigation')
                . view('vue_historique');
        } else {
            return redirect()->to('/');
        }
    }
}
