<link rel="stylesheet" href="../../../css/style.css">
<nav>
    <a href="#">Accueil</a>
    <div class="menu-item">
        <a href="#">Inscription</a>
        <div class="sub-menu">
            <a href="<?= site_url('CtrlInscription/getLesPresentations') ?>">S'inscrire</a>
            <a href="#">Rechercher une inscription</a>
            <a href="#">Mes inscriptions</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#"><?= session()->get('prenom') ?></a>
        <div class="sub-menu">
            <a href="#">Mon compte</a>
            <a href="<?= site_url('deconnexion') ?>">Déconnexion</a>
        </div>
    </div> 
</nav>