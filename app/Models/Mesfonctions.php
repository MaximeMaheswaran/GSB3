<?php

namespace App\Models;

class Mesfonctions
{

    /** Teste si un quelconque visiteur est connecté
     * @return vrai ou faux 
     * */
    public function estConnecte()
    {
        return isset($_SESSION['is_logged']);
    }
}
