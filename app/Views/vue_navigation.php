<nav>
    <a href="<?= site_url('/') ?>">Accueil</a>
    <div class="menu-item">
        <a href="#">Les conférences</a>
        <div class="sub-menu">
            <?= anchor('Conferences/Presentations', "Reserver") ?>
            <?= anchor('Conferences/MesReservation', "Mes Reservation") ?>
            <?= anchor('Conferences/Historiques', "Historiques") ?>
        </div>
    </div>
    <div class="menu-item">
        <a href="<?= site_url('information') ?>"><?= session()->get('prenom') ?></a>
        <div class="sub-menu">
            <a href="<?= site_url('/Visiteur/Compte/') ?>">Mon compte</a>
            <a href="<?= site_url('deconnexion') ?>">Déconnexion</a>
        </div>
    </div>
</nav>