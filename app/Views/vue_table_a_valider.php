<?= helper('form'); ?>
<div class="contenaire_search">
    <div class="contenaire_input">
        <label for="search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </label>
        <input type="text" name="search" id="search" placeholder="Rechercher un visiteur">
    </div>
</div>
<div class="contenaire_resultat">
    <div class="table">
        <h3>Nom / Prenom</h3>
        <h3>Salle</h3>
        <h3>Horaire</h3>
        <?php
        // Verification dans quelle je suis ? si la page A Valider alors
        if ($page == "AValider") {
        ?>
            <h3 class="th_bouton_est_present"></h3>
        <?php
        }
        ?>

    </div>
    <div class="table_resultat" id="table_resultat">

        <!-- <?php /*var_dump($visiteursAValider);*/
                /*foreach ($visiteursAValider as $unVisiteur) { ?>
            <div class="table_items">
                <h4><?= $unVisiteur['nom'] . " " . $unVisiteur['prenom'] ?></h4>
                <h4><?= $unVisiteur['salle'] ?></h4>
                <h4><?= $unVisiteur['horaire'] ?></h4>
                <h4>
                    <?= form_open('/Agent/Visiteur/A_valider'); ?>
                    <?= form_hidden('idVisiteur', $unVisiteur['id']) ?>
                    <?= form_submit('', 'Est présent') ?>
                    <?= form_close(); ?>
                </h4>

            </div>
        <?php } */ ?> -->
    </div>

</div>

<?php include_once('../js/script_search.php') ?>