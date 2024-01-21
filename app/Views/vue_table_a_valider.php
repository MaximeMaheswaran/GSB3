<?= helper('form'); ?>
<table border="1px solid black" align="center">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Salle</th>
        <th>Horaire</th>
        <th>A valider</th>
    </tr>
    <?php var_dump($visiteursAValider);
    foreach ($visiteursAValider as $unVisiteur) { ?>
        <tr valign="middle">
            <td><?= $unVisiteur['nom'] ?></td>
            <td><?= $unVisiteur['prenom'] ?></td>
            <td><?= $unVisiteur['salle'] ?></td>
            <td><?= $unVisiteur['horaire'] ?></td>
            <td valign='middle'>
                <?= form_open('/Agent/Visiteur/A_valider'); ?>
                <?= form_hidden('idVisiteur', $unVisiteur['id']) ?>
                <?= form_submit('', 'Est présent') ?>
                <?= form_close(); ?>
            </td>
        </tr>
    <?php } ?>
</table>