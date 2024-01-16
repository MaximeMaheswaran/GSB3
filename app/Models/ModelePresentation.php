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

    public function aReserverCettePresentation($idPersonne, $presentation_id) {
        $db = $this->db;
    
        $query = $db->table('reserver')
            ->select('id_visiteur, id_presentation')
            ->where('id_visiteur', $idPersonne)
            ->where('id_presentation', $presentation_id)
            ->get();
    
        // Récupérer le résultat
        $result = $query->getRow();
    
        // Vérifier si le résultat existe, indiquant que la personne a réservé cette présentation
        return !empty($result);
    }
    
    

    public function ajouterUnePresentationPourLaPersonne($presentation_id) {
        $db = $this->db;
    
        // Récupérer l'ID de la personne en session
        $idPersonne = session()->get('id');
    
        // Construire et exécuter la requête d'insertion
        $data = [
            'id_visiteur' => $idPersonne,
            'id_presentation' => $presentation_id,
        ];
    
        $db->table('reserver')->insert($data);
    
        // Vérifier si l'insertion a réussi
        $inserted = $db->affectedRows() > 0;
    
        // Si l'insertion a réussi, mettre à jour nbPersonneInscrite dans la table presentation
        if ($inserted) {
            $db->table('presentation')
                ->where('id', $presentation_id)
                ->set('nbPersonneInscrite', 'nbPersonneInscrite + 1', false)
                ->update();
        }
    
        return $inserted;
    }
    
}
?>