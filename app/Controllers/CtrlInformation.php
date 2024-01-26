<?php

namespace App\Controllers;

class CtrlInformation extends BaseController
{
    public function index()
    {
        $modele = new \App\Models\ModeleInformations();
        $data['informations'] = $modele->getLesInformations(session()->get('id'));
        $data['modificationEnCours'] = false;
        $data['modele'] = $modele;
        $data['title'] = "GSB | Mon compte";
        return view('vue_entete', $data) . view('vue_navigation') . view('vue_informationsPersonnelles', $data);
    }

    public function modification()
    {
        $modele = new \App\Models\ModeleInformations();
        $data['informations'] = $modele->getLesInformations(session()->get('id'));
        $data['modificationEnCours'] = true;
        $data['modele'] = $modele;
        $data['title'] = "GSB | Mon compte";
        return view('vue_entete', $data) . view('vue_navigation') . view('vue_informationsPersonnelles', $data);
    }

    public function mettreAJourInformations()
    {
        $modele = new \App\Models\ModeleInformations();
        $modele->setLesInformations($_POST);
        $data['informations'] = $modele->getLesInformations(session()->get('id'));
        $data['modificationEnCours'] = false;
        $data['modele'] = $modele;
        $data['title'] = "GSB | Mon compte";
        return view('vue_entete', $data) . view('vue_navigation') . view('vue_informationsPersonnelles', $data);
    }
}
