<?php

namespace App\Models;

use CodeIgniter\Model;

class MonModele extends Model
{   
    public function bdd() {
        return \config\Database::connect();
    }

        /** Teste si un quelconque visiteur est connecté
     * @return vrai ou faux 
     * */
    public function estConnecte()
    {
        return isset($_SESSION['is_logged']);
    }

    public function getVerifConnexion($post) {
        $boolean = false;
        $db =$this->bdd();
        $data = [
            'login' => $post['login'],
            'mdp' => hash('sha256', $post['mdp'])
        ];
        $builder = $db->table('visiteur');
        $count = $builder->like($data)->countAllResults();
        if ($count > 0) {
            $boolean = true;
        }
        return $boolean;
    }

    public function getUnVisiteur($post)
    {
        // Hache le mot de passe fourni avec SHA-256
        $hashedPassword = hash('sha256', $post['mdp']);

        // Utilisation de la classe Query Builder pour une requête préparée
        $query = $this->db->table('visiteur')
            ->select('id, nom, prenom, login, adresse, cp, ville')
            ->where('login', $post['login'])
            ->where('mdp', $hashedPassword) // Compare avec le mot de passe haché
            ->get();
        return $query->getRowArray();
    }

}

?>