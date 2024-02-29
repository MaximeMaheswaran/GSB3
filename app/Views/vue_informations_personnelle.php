<?php if (!isset($_SESSION['matricule'])) { ?>
    <div class="info_personnelle">
        <div class="info_items">
            <div class="info_1">Nom :</div>
            <div class="info_2"><?= $informations['nom'] ?></div>
        </div>
        <div class="info_items">
            <div class="info_1">Prénom :</div>
            <div class="info_2"><?= $informations['prenom'] ?></div>
        </div>
        <div class="info_items">
            <div class="info_1">Adresse :</div>
            <div class="info_2"><?= $informations['adresse'] ?></div>
        </div>
        <div class="info_items">
            <div class="info_1">Ville :</div>
            <div class="info_2"><?= $informations['ville'] ?></div>
        </div>
        <div class="info_items">
            <div class="info_1">Code postal :</div>
            <div class="info_2"><?= $informations['cp'] ?></div>
        </div>
        <!-- Bouton de modification -->
        <form action="<?= site_url('CtrlInformation/activerModification') ?>" method="post">
            <input type="submit" value="Modifier">
        </form>
    </div>
<?php } else { ?>
    <form id="form_info_personnelle">
        <div class="info_personnelle">
            <div class="info_items">
                <div class="info_1">Nom :</div>
                <div class="info_2"><?= $informations['nom'] ?></div>
            </div>
            <div class="info_items">
                <div class="info_1">Prénom :</div>
                <div class="info_2"><?= $informations['prenom'] ?></div>
            </div>
            <div class="info_items">
                <div class="info_1">N° Agent :</div>
                <div class="info_2"><?= $informations['matricule'] ?></div>
            </div>
        </div>
    </form>
<?php } ?>