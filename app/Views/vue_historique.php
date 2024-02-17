<div class="contenaire_resultat contenaire_historique">
    <div class="table tbl_historique">
        <h3>Date</h3>
        <h3>Théme</h3>
        <h3>Horaire</h3>
        <h3>Durée</h3>
        <h3>Salle</h3>
    </div>
    <div class="table_resultat" id="table_resultat">
        <?php foreach ($historiques as $unHistorique) { ?>
            <div class="table_items tbl_items_historique">
                <h4><?= $unHistorique['datee_presentation'] ?></h4>
                <h4><?= $unHistorique['theme_conference'] ?></h4>
                <h4><?= $unHistorique['horaire_presentation'] ?></h4>
                <h4><?= $unHistorique['dureePrevue_presentation'] ?></h4>
                <h4><?= $unHistorique['nom'] ?></h4>
            </div>
        <?php } ?>
    </div>

</div>