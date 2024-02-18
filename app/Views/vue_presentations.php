<?php
$presentationsChunked = array_chunk($presentations, 3);
foreach ($presentationsChunked as $group) : ?>
    <div class="presentation-group">
        <?php foreach ($group as $presentation) : ?>
            <a href="<?= site_url('Conferences/Presentation/Detail/' . $presentation['id']) ?>" class="presentation-link">
                <div class="card_c">
                    <div class="first-content">
                        <span><?= $modele->getNomConference($presentation['conference_id']) ?></span>
                    </div>
                    <div class="second-content">
                        <span><strong>Date :</strong> <?= $presentation['datee'] ?></span>
                        <span><strong>Horaire :</strong> <?= $presentation['horaire'] ?></span>
                        <span><strong>Durée prévue :</strong> <?= $presentation['dureePrevue'] ?></span>
                        <span><strong>Salle :</strong> <?= $modele->getNomSalle($presentation['salle_id']) ?></span>
                        <span><strong>Places restant :</strong> <?= $modele->getCapaciteMaxDeUneSalle($presentation['salle_id']) - $presentation['nbPersonneInscrite'] ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>