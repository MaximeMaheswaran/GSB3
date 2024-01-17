<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModelePresentation extends Model
{
    protected $table = 'presentation';
    protected $primaryKey = 'id';

    public function getLesPresentations()
    {
        return $this->findAll();
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

    public function aReserverCeSiege($idPersonne, $presentation_id, $siege_id) {
        $db = $this->db;
    
        $result = $db->table('reserver')
            ->where('id_visiteur', $idPersonne)
            ->where('id_presentation', $presentation_id)
            ->where('id_siege', $siege_id)
            ->countAllResults() > 0;
    
        return $result;
    }
    
    public function inscriptionPresentationPourUnePersonne($presentation_id, $salle_id, $idPersonne, $siegeId) {
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
    
    public function desinscriptionPresentationPourUnePersonne($presentation_id, $salle_id, $idPersonne, $siegeId) {
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
    


    public function getTousLesSiegesDeUneSalle($salle_id) {
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

    public function estSiegeReserve($salle_id, $siege_id) {
        $db = $this->db;

        // Vérifier si le siège est réservé pour une salle donnée
        $siegeReserve = $db->table('siege')
                        ->where('salle_id', $salle_id)
                        ->where('id', $siege_id)
                        ->where('visiteur_id IS NOT NULL') // Assurez-vous que le champ visiteur_id n'est pas NULL
                        ->countAllResults();

        return $siegeReserve > 0;
    }

}
?>