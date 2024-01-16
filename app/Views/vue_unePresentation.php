<br><br>
<?php
    $nombreRestant = $modele->getCapaciteMaxDeUneSalle($presentation['salle_id']) - $presentation['nbPersonneInscrite'];
    helper('html'); 
    if($modele->aReserverCettePresentation(session()->get('id') ,$presentation['id']) > 0){
        echo img(img_data('../img/chaiseReserver.png'), "");
        for ($i = 0; $i < $nombreRestant-1; $i++) {
            $url = base_url('CtrlInscription/inscription/' . $presentation['id']);
            echo '<a href="' . $url . '">' . img(img_data('../img/chaiseVide.png'), "") . '</a>';
        }
    }
    else{
        for ($i = 0; $i < $nombreRestant; $i++) {
            $url = base_url('CtrlInscription/inscription/' . $presentation['id']);
            echo '<a href="' . $url . '">' . img(img_data('../img/chaiseVide.png'), "") . '</a>';
        }
    }
?>
