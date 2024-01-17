<br><br>
<link rel="stylesheet" href="../../../../css/style.css">
<?php
    $siegesIds = $modele->getTousLesSiegesDeUneSalle($presentation['salle_id']);
    helper('html');

    // Vérifier si le visiteur a déjà une réservation dans cette salle
    $idVisiteur = session()->get('id');
    $idSalle = $presentation['salle_id'];
    $aUneReservation = $modele->aReservationDansUneSalle($idVisiteur, $idSalle);

    // Afficher les images pour les sièges restants
    foreach ($siegesIds as $siegeId) {
        $urlInscription = base_url('CtrlInscription/inscription/' . $presentation['id'] . '/' . $siegeId);
        $urlDesinscription = base_url('CtrlInscription/desinscription/' . $presentation['id'] . '/' . $siegeId);

        // Vérifier si le siège est déjà réservé
        $estReserve = $modele->estSiegeReserve($presentation['salle_id'], $siegeId);

        // Si le siège est déjà réservé
        if ($estReserve > 0) {
            $estReserverParLaPersonne = $modele->aReserverCeSiege(session()->get('id'), $presentation['id'], $siegeId);

            if ($estReserverParLaPersonne) {
                // Si le siège est réservé par la personne, afficher une image pour annuler la réservation
                $urlAnnulation = base_url('CtrlInscription/desinscription/' . $presentation['id'] . '/' . $siegeId);
                echo '<a href="' . $urlAnnulation . '">';
                echo img(img_data('../img/chaiseReserver.png'), $siegeId);
                echo '</a>';
            } else {
                // Si le siège est réservé par quelqu'un d'autre, afficher une image indiquant qu'il est pris
                echo img(img_data('../img/chaisePrise.png'), $siegeId);
            }
        } else {
            // Si le siège n'est pas réservé
            if ($aUneReservation) {
                // Si le visiteur a déjà une réservation, afficher l'image du siège (sans lien)
                echo img(img_data('../img/chaiseVide.png'), $siegeId);
            } else {
                // Si le visiteur n'a pas encore de réservation, afficher le lien d'inscription
                echo '<a href="' . $urlInscription . '">';
                echo img(img_data('../img/chaiseVide.png'), $siegeId);
                echo '</a>';
            }
        }
    }

?>
