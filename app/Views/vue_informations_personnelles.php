<br>
<?php if (!isset($_SESSION['matricule'])) { ?>
    <?php if ($modificationEnCours) : ?>
        <!-- Formulaire de modification -->
        <form action="<?= site_url('Visiteur/Compte/Modif/Maj') ?>" method="post" id="form_info_personnelle">
            <div class="info_personnelle info_personnelle_modif">
                <div class="info_items">
                    <div class="info_1">Nom :</div>
                    <div class="info_2"><input type="text" name="nom" value="<?= $informations['nom'] ?>" required></div>
                </div>
                <div class="info_items">
                    <div class="info_1">Prénom :</div>
                    <div class="info_2"><input type="text" name="prenom" value="<?= $informations['prenom'] ?>" required></div>
                </div>
                <div class="info_items">
                    <div class="info_1">Adresse :</div>
                    <div class="info_2"><input type="text" name="adresse" value="<?= $informations['adresse'] ?>" required></div>
                </div>
                <div class="info_items">
                    <div class="info_1">Ville :</div>
                    <div class="info_2"> <input type="text" name="ville" value="<?= $informations['ville'] ?>" required></div>
                </div>
                <div class="info_items">
                    <div class="info_1">Code postal :</div>
                    <div class="info_2"><input type="text" name="cp" value="<?= $informations['cp'] ?>" required></div>
                </div>
                <!-- Bouton de Validation -->
                <input type="submit" value="Valider" id="info_btn_modif">
            </div>
        </form>
    <?php else : ?>
        <!-- Affichage des informations -->
        <form action="<?= site_url('Visiteur/Compte/Modif') ?>" method="post" id="form_info_personnelle">
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
                <input type="submit" value="Modifier" id="info_btn_modif">
            </div>
        </form>
    <?php endif; ?>
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