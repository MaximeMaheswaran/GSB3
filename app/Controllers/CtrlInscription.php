<?php

namespace App\Controllers;

class CtrlInscription extends BaseController
{
    
    public function afficherPresentations()
    {
        $modele = new \App\Models\ModelePresentation();
        $data['presentations'] = $modele->getLesPresentations();
        $data['modele'] = $modele;
        return view('vue_navigation') . view('vue_presentations' , $data);
    }

    public function detailDeUnePresentation($presentation_id)
    {
        $modele = new \App\Models\ModelePresentation();
        $data['presentation'] = $modele->getUnePresentation($presentation_id);
        $data['modele'] = $modele;
        return view('vue_navigation') . view('vue_unePresentation' , $data);
    }

    public function inscription($presentation_id , $siegeId)
    {
        $modele = new \App\Models\ModelePresentation();
        $data['presentation'] = $modele->getUnePresentation($presentation_id);
        $data['salle_id'] = $modele->getTousLesSiegesDeUneSalle($data['presentation']['salle_id']);
        $modele->inscriptionPresentationPourUnePersonne($presentation_id , $data['salle_id'] , session()->get('id'), $siegeId);
        $data['modele'] = $modele;
        return view('vue_navigation') . view('vue_unePresentation' , $data);
    }

    public function desinscription($presentation_id , $siegeId)
    {
        $modele = new \App\Models\ModelePresentation();
        $data['presentation'] = $modele->getUnePresentation($presentation_id);
        $data['salle_id'] = $modele->getTousLesSiegesDeUneSalle($data['presentation']['salle_id']);
        $modele->desinscriptionPresentationPourUnePersonne($presentation_id , $data['salle_id'] , session()->get('id'), $siegeId);
        $data['modele'] = $modele;
        return view('vue_navigation'). view('vue_unePresentation' , $data);
        
    }
}
