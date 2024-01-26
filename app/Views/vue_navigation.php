
<nav>
    <a href="<?= site_url('/') ?>">Accueil</a>
    <div class="menu-item">
        <a href="#">Inscription</a>
        <div class="sub-menu">
            <a href="<?= site_url('CtrlInscription/getLesPresentations') ?>">S'inscrire</a>
            <a href="#">Rechercher une conférence</a>
            <a href="#">Mes inscriptions</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="<?= site_url('information') ?>"><?= session()->get('prenom') ?></a>
        <div class="sub-menu">
            <a href="<?= site_url('information') ?>">Mon compte</a>
            <a href="<?= site_url('deconnexion') ?>">Déconnexion</a>
        </div>
    </div> 
</nav>