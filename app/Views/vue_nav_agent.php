<nav>
    <?=anchor('/', 'Acceuil')?>
    <div class="menu-item">
        <a href="#">Visiteur</a>
        <div class="sub-menu">
            <?=anchor('/Agent/Visiteur/A_valider', 'A valider')?>
        </div>
    </div>
    <div class="menu-item">
        <a href=""><?= session()->get('prenom')." ".session()->get('matricule')?></a>
        <div class="sub-menu">
            <?=anchor('/Agent/Moncompte', 'Mon compte')?>
            <?=anchor('deconnexion', 'Déconnexion') ?>
        </div>
    </div> 
</nav>