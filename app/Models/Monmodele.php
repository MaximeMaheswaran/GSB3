<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class MonModele extends Model
{
    public function bdd()
    {
        return \config\Database::connect();
    }

    /** Teste si un quelconque visiteur est connecté
     * @return vrai ou faux 
     * */
    public function estConnecte()
    {
        return session()->get('is_logged');
    }

    /**
     * Recherche s'il existe un visteur avec ce login et mdp
     * @param $post 
     * @return $bool retourne un vraie s'il existe un visiteur sinon faux
     */
    public function getVerifConnexion($post)
    {
        $bool = false;
        // Connexion a la bdd
        $db = $this->bdd();
        // Les donnée pour la condition where
        $data = [
            'login' => $post['login'],
            'mdp' => hash('sha256', $post['mdp'])
        ];
        // Choix de la table
        $builder = $db->table('visiteur');
        // Utilise la condition where puis compte et renvoie le nombre d'enregistrement
        $count = $builder->where($data)->countAllResults();
        // Savoir si on reçoit 1 ou 0 
        if ($count > 0) {
            $bool = true;
        }
        return $bool;
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

    /**
     * Recherche s'il existe un agent avec ce login et mdp
     * @param post 
     * @return bool retourne un vraie s'il existe un agent sinon faux
     */
    public function getVerifAgent($post)
    {
        $bool = false;
        // Connexion a la bdd
        $db = $this->bdd();
        // Les donnée pour la condition where
        $data = [
            'login' => $post['login'],
            'mdp' => hash('sha256', $post['mdp'])
        ];
        // Choix de la table
        $builder = $db->table('personne');
        // Selection d'un champ de la agent
        $builder->select('matricule');
        // Jointure de la table personne et agent
        $builder->join('agent', 'agent.id = personne.id');
        // Utilise la condition where puis compte et renvoie le nombre d'enregistrement
        $count = $builder->where($data)->countAllResults();
        // Savoir si on reçoit 1 ou 0 
        if ($count > 0) {
            $bool = true;
        }
        return $bool;
    }

    /**
     * Recupere les donnée d'un agent depuis la bdd via le login et mdp
     * @param $post 
     * @return le nom, prenom, matricule et l'id de l'agent
     */
    public function getUnAgent($post)
    {
        // Connexion a la bdd
        $db = $this->bdd();
        // Les donnée pour la condition where
        $data = [
            'login' => $post['login'],
            'mdp' => hash('sha256', $post['mdp'])
        ];
        // Choix de la table
        $builder = $db->table('personne');
        // Selection des champs besoins
        $builder->select('personne.id, matricule, nom, prenom');
        // Jointure de la table personne et agent
        $builder->join('agent', 'agent.id = personne.id');
        // Utilise la condition where
        $builder->where($data);
        return $builder->get()->getRowArray();
    }

    /**
     * Recupere les donnée d'un agent depuis la bdd via l'id de l'agent
     * @param $post 
     * @return le nom, prenom, matricule et l'id de l'agent
     */
    public function getUnAgentId($id)
    {
        // Connexion a la bdd
        $db = $this->bdd();
        // Les donnée pour la condition where
        $data = [
            'personne.id' => $id,
        ];
        // Choix de la table
        $builder = $db->table('personne');
        // Selection des champs besoins
        $builder->select('personne.id, matricule, nom, prenom');
        // Jointure de la table personne et agent
        $builder->join('agent', 'agent.id = personne.id');
        // Utilise la condition where
        $builder->where($data);
        return $builder->get()->getRowArray();
    }

    /**
     * Recupere tout les visiteurs qui ont reserver une présentation mais ne se sont pas présenté
     * @return le nom, prenom, id des visiteurs, le nom de la salle et l'horaire
     */
    public function getLesVisiteurAValider()
    {
        // Activer la fonctionnalité de codeigniter date
        //helper('date');
        // Connexion a la bdd
        $db = $this->bdd();
        // Choix de la table
        $builder = $db->table('reserver');
        // Selection des champs besoins
        $builder->select('visiteur.id,presentation.id as idPresentation, visiteur.nom, prenom, salle.nom as salle, horaire');
        // Jointure de la table visiteur et reserver
        $builder->join('visiteur', 'visiteur.id = reserver.id_visiteur');
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Jointure de la table salle et presentation
        $builder->join('salle', 'salle.id = presentation.salle_id');
        // Utilise la condition where si dans la champ 'est_present' est égal a 0
        $builder->where('est_present', 0);
        //  Utilise la condition where si date de la presentation est égal a la date d'aujourd'hui
        //$builder->where('datee', now());
        return $builder->get()->getResultArray();
    }

    /**
     * Recupere tout les visiteurs qui ont reserver une présentation mais ne se sont pas présenté
     * @return le nom, prenom, id des visiteurs, le nom de la salle et l'horaire
     */
    public function getLesVisiteurDejaPresent()
    {
        // Activer la fonctionnalité de codeigniter date
        //helper('date');
        // Connexion a la bdd
        $db = $this->bdd();
        // Choix de la table
        $builder = $db->table('reserver');
        // Selection des champs besoins
        $builder->select('visiteur.id, visiteur.nom, prenom, salle.nom as salle, horaire');
        // Jointure de la table visiteur et reserver
        $builder->join('visiteur', 'visiteur.id = reserver.id_visiteur');
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Jointure de la table salle et presentation
        $builder->join('salle', 'salle.id = presentation.salle_id');
        // Utilise la condition where si dans la champ 'est_present' est égal a 0
        $builder->where('est_present', 1);
        //  Utilise la condition where si date de la presentation est égal a la date d'aujourd'hui
        //$builder->where('datee', now());
        return $builder->get()->getResultArray();
    }

    /**
     * Modification du champ est présent pour dire le visiteur est présent
     * @param post
     */
    public function setVisiteurEstPresent($post)
    {
        // Connexion a la bdd
        $db = $this->bdd();
        // Choix de la table
        $builder = $db->table('reserver');
        // Modification du champ est_présent
        $builder->set('est_present', 1, false);
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Utilise la condition where si le visiteur existe déjà
        $builder->where('id_visiteur', $post['idVisiteurAValider']);
        // Utilise la condition where si la presentation existe dans cette table
        $builder->where('id_Presentation', $post['idPresentationAValider']);
        //Envoyer la modification a la base de données
        $builder->update();
    }
    /**
     * Modification du champ est présent pour dire le visiteur est présent
     * @param idVisiteur
     * @param idPresentation
     */
    public function setVisiteurEstPresentParam($idVisiteur, $idPresentation)
    {
        // Connexion a la bdd
        $db = $this->bdd();
        // Choix de la table
        $builder = $db->table('reserver');
        // Modification du champ est_présent
        $builder->set('est_present', 1, false);
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Utilise la condition where si le visiteur existe déjà
        $builder->where('id_visiteur', $idVisiteur);
        // Utilise la condition where si la presentation existe dans cette table
        $builder->where('id_Presentation', $idPresentation);
        //Envoyer la modification a la base de données
        $builder->update();
    }
}
