<br>
<?php if ($modificationEnCours) : ?>
    <!-- Formulaire de modification -->
    <form action="<?= site_url('Visiteur/Compte/Modif/Maj') ?>" method="post">
        <fieldset>
            <legend>Modifier les informations</legend>
            <label for="nom">Nom:</label>
            <input type="text" name="nom" value="<?= $informations['nom'] ?>" required><br>

            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" value="<?= $informations['prenom'] ?>" required><br>

            <label for="adresse">Adresse:</label>
            <textarea name="adresse" rows="4" cols="50"><?= $informations['adresse'] ?></textarea><br>

            <label for="cp">Code postal:</label>
            <input type="text" name="cp" value="<?= $informations['cp'] ?>" required><br>

            <label for="ville">Ville:</label>
            <input type="text" name="ville" value="<?= $informations['ville'] ?>" required><br>

            <input type="submit" value="Valider">
        </fieldset>
    </form>
<?php else : ?>
    <!-- Affichage des informations -->
    <fieldset>
        <legend>Informations personnelles</legend>
        <table>
            <tr>
                <td>Nom:</td>
                <td><?= $informations['nom'] ?></td>
            </tr>
            <tr>
                <td>Prénom:</td>
                <td><?= $informations['prenom'] ?></td>
            </tr>
            <tr>
                <td>Adresse:</td>
                <td><?= $informations['adresse'] ?></td>
            </tr>
            <tr>
                <td>Code postal:</td>
                <td><?= $informations['cp'] ?></td>
            </tr>
            <tr>
                <td>Ville:</td>
                <td><?= $informations['ville'] ?></td>
            </tr>
        </table>
        <br>
        <!-- Bouton de modification -->
        <form action="<?= site_url('/Visiteur/Compte/Modif') ?>" method="post">
            <input type="submit" value="Modifier">
        </form>
    </fieldset>
<?php endif; ?>