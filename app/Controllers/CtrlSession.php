<?php

namespace App\Controllers;

class CtrlSession extends BaseController
{
    /**
     * Affichage de la page connexion
     * @param le head 
     */
    public function pageConnexion()
    {
        $data['title'] = "GSB | connexion";
        return view('vue_entete.php', $data) . view('vue_logo') . view('vue_formulaire');
    }

    public function pageAccueil()
    {
        $data['title'] = "GSB | Accueil";
        return view('vue_logo') . view('vue_entete', $data) . view('vue_navigation');
    }

    public function deconnexion()
    {
        // Détruire la session
        session()->destroy();

        // Rediriger vers la page d'accueil ou une autre page
        return redirect()->to(base_url());
    }

    public function verifConnexion()
    {
        helper('url');
        // Si l'utilisateur est déjà connecté
        if (isset($_SESSION)) {
            echo "déjà connecté";
        } else {
            if ($this->request->is('post')) {
                // Règles à respecter 
                $rules = [
                    'login' => 'required',
                    'mdp'   => 'required|min_length[1]|max_length[255]'
                ];
                // Si les règles ne sont pas respectés   
                if (!$this->validate($rules)) {
                    // Stocker les erreurs de validation
                    return redirect()->to(base_url())->withInput()->with('validation', $this->validator);
                }
                // Les règles ont bien étés respectés
                else {
                    // On vérifie si le login et le mot de passe correspondent bien à une personne dans la base de données
                    $modele = new \App\Models\MonModele(); // Initialisation de la classe Modele
                    // Si le login et le mot de passe correspondent bien à une personne
                    if ($modele->getverifConnexion($_POST)) {
                        $unePersonne = $modele->getUnVisiteur($_POST);
                        $newdata = [
                            'id'  => $unePersonne['id'],
                            'nom' => $unePersonne['nom'],
                            'prenom' => $unePersonne['prenom'],
                            'login' => $unePersonne['login'],
                            'adresse' => $unePersonne['adresse'],
                            'cp' => $unePersonne['cp'],
                            'ville' => $unePersonne['ville'],
                            'is_logged' => true,
                        ];
                        session()->set($newdata);
                        return redirect()->to('/');
                    }
                    // Le login et/ou le mot de passe est incorrect
                    else {
                        // Verification si c'est agent qui se connecte
                        if ($modele->getVerifAgent($_POST)) {
                            // Recuperation les données de l'agent
                            $unAgent = $modele->getUnAgent($_POST);
                            // Ajouter les données dans un tableau associatif
                            $newdata = [
                                'id'  => $unAgent['id'],
                                'nom' => $unAgent['nom'],
                                'prenom' => $unAgent['prenom'],
                                'matricule' => $unAgent['matricule'],
                                'is_logged' => true
                            ];
                            session()->set($newdata);
                            return redirect()->to('/');
                        } else {
                            return $this->pageConnexion('vue_connexion') . view('vue_logo') . view('errors/vue_connexion') . view('vue_formulaire');
                        }
                    }
                }
            }
        }
    }
}
