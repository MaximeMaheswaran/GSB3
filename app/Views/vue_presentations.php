<?php
$presentationsChunked = array_chunk($presentations, 3);
foreach ($presentationsChunked as $group) : ?>
    <div class="presentation-group">
        <?php foreach ($group as $presentation) : ?>
            <a href="<?= site_url('Conferences/Presentation/Detail/' . $presentation['id']) ?>" class="presentation-link">
                <div class="presentation-item">
                    <strong>Conférence :</strong> <?= $modele->getNomConference($presentation['conference_id']) ?><br>
                    <strong>Date :</strong> <?= $presentation['datee'] ?><br>
                    <strong>Nombre de places disponibles :</strong>
                    <?= $modele->getCapaciteMaxDeUneSalle($presentation['salle_id']) - $presentation['nbPersonneInscrite'] ?><br>
                    <strong>Horaire :</strong> <?= $presentation['horaire'] ?><br>
                    <strong>Durée prévue :</strong> <?= $presentation['dureePrevue'] ?><br>
                    <strong>Salle :</strong> <?= $modele->getNomSalle($presentation['salle_id']) ?><br>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>