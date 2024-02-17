<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

helper('date');

class ModelePresentation extends Model
{
    protected $table = 'presentation';
    protected $primaryKey = 'id';

    public function getLesPresentations()
    {
        return $this->findAll();
    }

    /**
     * Recupere les presentation reserver par le visiteur
     * @param $idPersonne
     * @return un tableau de presentation avec les champ suivant (le thème de la conférences, l'id de la presentation, 
     * date, horiare, duree prevue, nb de personne inscrite, l'id de la salle, l'id de la conférence)
     */
    public function getLesPresentationsReserver($idPersonne)
    {

        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('reserver');
        // Selection des champs besoins
        $builder->select('theme, id_presentation as id, datee, nbPersonneInscrite, horaire, dureePrevue, salle_id, conference_id');
        // Jointure de la table visiteur et reserver
        $builder->join('visiteur', 'visiteur.id = reserver.id_visiteur');
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Jointure de la table conference et presentation
        $builder->join('conference', 'conference.id = presentation.conference_id');
        // Utilise la condition where pour avoir que cette visiteur
        $builder->where('id_visiteur', $idPersonne);
        // Utilise la condition where si pour enlever les presentation ou il a ete deja présent
        $builder->where('est_present', 0);
        return $builder->get()->getResultArray();
    }

    public function getUnePresentation($presentation_id)
    {
        return $this->find($presentation_id);
    }

    public function getNomSalle($salle_id)
    {
        $db = $this->db;

        $query = $db->table('salle')->select('nom')->where('id', $salle_id)->get();

        $result = $query->getRow();

        return ($result) ? $result->nom : null;
    }

    public function getNomConference($conference_id)
    {
        $db = $this->db;

        $query = $db->table('conference')->select('theme')->where('id', $conference_id)->get();

        $result = $query->getRow();

        return ($result) ? $result->theme : null;
    }

    public function getCapaciteMaxDeUneSalle($salle_id)
    {
        $db = $this->db;

        $query = $db->table('salle')->select('capaciteMax')->where('id', $salle_id)->get();

        $result = $query->getRow();

        return ($result) ? $result->capaciteMax : null;
    }

    public function aReserverCeSiege($idPersonne, $presentation_id, $siege_id)
    {
        $db = $this->db;

        $result = $db->table('reserver')
            ->where('id_visiteur', $idPersonne)
            ->where('id_presentation', $presentation_id)
            ->where('id_siege', $siege_id)
            ->countAllResults() > 0;

        return $result;
    }

    public function inscriptionPresentationPourUnePersonne($presentation_id, $salle_id, $idPersonne, $siegeId)
    {
        $db = $this->db;

        // Insérer une nouvelle réservation
        $data = [
            'id_visiteur' => $idPersonne,
            'id_presentation' => $presentation_id,
            'id_siege' => $siegeId
        ];
        $db->table('reserver')->insert($data);

        // Mettre à jour la table siege pour indiquer que le siège est occupé par le visiteur
        $db->table('siege')
            ->where('id', $siegeId)  // Utiliser l'ID du siège pour la condition where
            ->update(['visiteur_id' => $idPersonne]);

        // Mettre à jour la colonne nbPersonneInscrite dans la table presentation
        $db->table('presentation')
            ->where('id', $presentation_id)
            ->set('nbPersonneInscrite', 'nbPersonneInscrite + 1', false)
            ->update();
    }

    public function desinscriptionPresentationPourUnePersonne($presentation_id, $salle_id, $idPersonne, $siegeId)
    {
        $db = $this->db;

        // Supprimer la réservation
        $db->table('reserver')
            ->where('id_presentation', $presentation_id)
            ->where('id_visiteur', $idPersonne)
            ->where('id_siege', $siegeId)
            ->delete();

        // Mettre à jour la table siege pour indiquer que le siège est maintenant disponible
        $db->table('siege')
            ->where('id', $siegeId)
            ->update(['visiteur_id' => null]);

        // Mettre à jour la colonne nbPersonneInscrite dans la table presentation
        $db->table('presentation')
            ->where('id', $presentation_id)
            ->set('nbPersonneInscrite', 'nbPersonneInscrite - 1', false)
            ->update();
    }

    public function aReservationDansUneSalle($idVisiteur, $idSalle)
    {
        $db = $this->db;

        $query = $db->table('reserver')
            ->join('presentation', 'presentation.id = reserver.id_presentation')
            ->where('reserver.id_visiteur', $idVisiteur)
            ->where('presentation.salle_id', $idSalle)
            ->get();

        // Vérifier si une réservation existe
        return $query->getNumRows() > 0;
    }



    public function getTousLesSiegesDeUneSalle($salle_id)
    {
        $db = $this->db;

        // Récupérer tous les sièges pour une salle donnée
        $sieges = $db->table('siege')
            ->where('salle_id', $salle_id)
            ->select('id')
            ->get()
            ->getResultArray();

        // Extraire les IDs de la résultat sous forme de tableau simple
        $siegesIds = array_column($sieges, 'id');

        return $siegesIds;
    }

    public function estSiegeReserve($salle_id, $siege_id)
    {
        $db = $this->db;

        // Vérifier si le siège est réservé pour une salle donnée
        $siegeReserve = $db->table('siege')
            ->where('salle_id', $salle_id)
            ->where('id', $siege_id)
            ->where('visiteur_id IS NOT NULL') // Assurez-vous que le champ visiteur_id n'est pas NULL
            ->countAllResults();

        return $siegeReserve > 0;
    }
    /**
     * Recupere l'historique d'un visiteur
     * @param $idVisiteur
     * @return le theme, date, horaire, dureePrevue, salle
     */
    public function getHistoriqueVisiteur($id)
    {
        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('historique');
        // Selection des champs besoins
        $builder->select('theme_conference, datee_presentation, horaire_presentation, dureePrevue_presentation, salle.nom');
        // Jointure de la table visiteur et reserver
        $builder->join('salle', 'salle.id = historique.id_salle');
        // Utilise la condition where pour avoir que cette visiteur
        $builder->where('id_visiteur', $id);
        // Ordonee dans l'ordre le plus recente au plus acienne
        $builder->orderBy('datee_presentation', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function getLesPresentationsTerminer()
    {
        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('presentation');
        // Selection des champs besoins
        $builder->select('id');
        // Utilise la condition where pour voir si la date est passe
        $builder->where('datee <', now());
        return $builder->get()->getResultArray();
    }

    public function getLesReserverTerminer($idPresentation)
    {
        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('reserver');
        // Selection des champs besoins
        $builder->select('id_visiteur');
        // Utilise la condition where pour recupere que les presentation terminer
        $builder->where('id_presentation', $idPresentation);
        return $builder->get()->getResultArray();
    }

    public function setHistorique($infos)
    {
        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('historique');
        $data = [
            'id_visiteur' => $infos[0]['id_visiteur'],
            'id_presentation' => $infos[0]['id_presentation'],
            'theme_conference' => $infos[0]['theme'],
            'datee_presentation' => $infos[0]['datee'],
            'horaire_presentation' => $infos[0]['horaire'],
            'dureePrevue_presentation' => $infos[0]['dureePrevue'],
            'id_salle' => $infos[0]['salle_id']
        ];
        // Inseret une nouvelle enregistrement
        $builder->insert($data);
    }

    public function getInfosToHistorique($idVisiteur, $idPresentation)
    {
        // Connexion a la bdd
        $db = $this->db;
        // Choix du table
        $builder = $db->table('reserver');
        // Selection des champs besoins
        $builder->select('id_visiteur, id_presentation, datee, horaire, dureePrevue, salle_id, theme');
        // Jointure de la table presentation et reserver
        $builder->join('presentation', 'presentation.id = reserver.id_presentation');
        // Jointure de la table conference et presentation
        $builder->join('conference', 'conference.id = presentation.conference_id');
        // Utilise la condition where pour avoir que cet eregistrement reserver
        $builder->where('reserver.id_visiteur', $idVisiteur);
        // Utilise la condition where pour avoir que cet eregistrement reserver
        $builder->where('reserver.id_presentation', $idPresentation);
        return $builder->get()->getResultArray();
    }

    public function autoHistorique()
    {
        $idsPresentation = $this->getLesPresentationsTerminer();
        foreach ($idsPresentation as $uneIdPresentation) {
            $idsVisiteurs = $this->getLesReserverTerminer($uneIdPresentation);
            foreach ($idsVisiteurs as $uneIdVisiteur) {
                $info = $this->getInfosToHistorique($uneIdVisiteur, $uneIdPresentation);
                $this->setHistorique($info);
            }
        }
    }
}
