<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModeleInformations extends Model
{
    public function getLesInformations($idPersonne) {
        $db = $this->db;
        $query = $db->table('visiteur')
                    ->select('id, nom, prenom, login, adresse, cp, ville')
                    ->where('id', $idPersonne)
                    ->get();
        $informations = $query->getRowArray();
    
        return $informations;
    }

    public function setLesInformations($post)
    {
        $db = $this->db;
    
        // Récupérer l'ID de la personne en session
        $idPersonne = session()->get('id');
    
        // Données à mettre à jour
        $data = [
            'nom' => $post['nom'],
            'prenom' => $post['prenom'],
            'adresse' => $post['adresse'],
            'cp' => $post['cp'],
            'ville' => $post['ville'],
        ];
    
        // Mettre à jour la table 'visiteur'
        $db->table('visiteur')
            ->where('id', $idPersonne)
            ->update($data);
    }
    
      
}
?>