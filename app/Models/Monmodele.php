<?php

namespace App\Models;

use CodeIgniter\Model;

class Monmodele extends Model
{   
    public function bdd() {
        return \config\Database::connect();
    }

    public function getVerifConnexion($post) {
        $boolean = false;
        $db =$this->bdd();
        $data = [
            'login' => $post['login'],
            'mdp' => hash('sha256', $post['pwd'])
        ];
        $builder = $db->table('visiteur');
        $count = $builder->like($data)->countAllResults();
        if ($count > 0) {
            $boolean = true;
        }
        return $boolean;
    }
}

?>