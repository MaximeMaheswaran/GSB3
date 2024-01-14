<?php

namespace App\Controllers;

class CtrlSession extends BaseController
{
    /**
     * Affichage de la page connexion
     * @param le head 
     */
    public function pageConnexion($head)
    {
        $data['title'] = "GSB | connexion"; // titre de l'onglet
        return view($head, $data) .
            view('view_logo').
            view('view_connexion');
    }

    /**
     * verification de la connexion
     */
    public function verifConnexion()
    {   
        helper('url');// activation de l'helper codeiniter
        $mesFonctions = new \App\Models\Mesfonctions(); // instancier la class Mes fonctions

        if (!$mesFonctions->estConnecte()) {// verification si deja connnecter
            if ($this->request->is('post')) { // verification si on recoit un methode post 
                // les relgle pour valider l'entrer dans le formulaire 
                $rules = [
                    'login' => 'required',
                    'pwd' => 'required|min_length[1]|max_length[12]'
                ];
                if (!$this->validate($rules)) { //verifier les entrer avec les regles
                    return $this->pageConnexion('view_head');
                } else {
                    $model = new \App\Models\Monmodele; // instancier la class mon modele
                    if ($model->getVerifConnexion($_POST)) { // authentifier si le visiteur existe dan la base de donnée 
                        // ajout des donnée dans session
                        $newdata = [
                            'username'  => $_POST['login'],
                            'is_logged' => true,
                        ];
                        session()->set($newdata);
                        $_SESSION['uc'] = "catalogue";
                        return redirect()->to('/');
                    } else {
                        return $this->pageConnexion('view_head');
                    }
                }
            } else {
                return $this->pageConnexion('view_head');
            }
        } else {
            $_SESSION['uc'] = "catalogue";
            return redirect()->to('/');
        }
    }
}
