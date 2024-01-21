<?php if (!isset($_SESSION['matricule'])) { ?>
    <fieldset>
        <legend>Informations personnelles</legend>
        <table>
            <tr>
                <td>Nom : </td>
                <td><?= $informations['nom'] ?></td>
            </tr>
            <tr>
                <td>Prénom : </td>
                <td><?= $informations['prenom'] ?></td>
            </tr>
            <tr>
                <td>Adresse : </td>
                <td><?= $informations['adresse'] ?></td>
            </tr>
            <tr>
                <td>Code postal : </td>
                <td><?= $informations['cp'] ?></td>
            </tr>
            <tr>
                <td>Ville : </td>
                <td><?= $informations['ville'] ?></td>
            </tr>
        </table>
        <br>
        <!-- Bouton de modification -->
        <form action="<?= base_url('CtrlInformation/activerModification') ?>" method="post">
            <input type="submit" value="Modifier">
        </form>
    </fieldset>

<?php } else { ?>

    <fieldset>
        <legend>Informations personnelles</legend>
        <table>
            <tr>
                <td>Nom : </td>
                <td><?= $informations['nom'] ?></td>
            </tr>
            <tr>
                <td>Prénom : </td>
                <td><?= $informations['prenom'] ?></td>
            </tr>
            <tr>
                <td>N° Agent : </td>
                <td><?= $informations['matricule'] ?></td>
            </tr>
        </table>
    </fieldset>

<?php } ?>