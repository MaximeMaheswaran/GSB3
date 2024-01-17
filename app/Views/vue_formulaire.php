<div class="box_carte_connexion">
    <div class="carte_connexion">
        <?php
        // formulaire de connexion
        helper('form'); // pour utiliser le formulaire du code initer

        echo validation_list_errors(); // afficher les erreurs fait par l'utilisateur
        echo form_open("CtrlSession/verifConnexion");
        echo form_label("Nom d'utilisateur : ", "Login",);
        echo form_input("login", "", "class=ipt_text_connexion");
        echo form_label("Mot de passe : ", "Password");
        echo form_password("mdp","","class=ipt_text_connexion");
        echo form_submit("submit", "Se connecter", "class=sbmt_connexion");
        echo form_close();
        ?>
    </div>
</div>