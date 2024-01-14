<div class="box_carte_connexion">
    <div class="carte_connexion">
        <?php
        // formulaire de connexion
        helper('form'); // pour utiliser le formulaire du code initer

        echo validation_list_errors(); // afficher les erreurs fait par l'utilisateur
        
        echo form_open("Login", 'id = "form_connexion" class="form_connexion"');
        echo form_label("Login : ", "Login",);
        echo form_input("login", "", "class=ipt_text_connexion");
        echo form_label("Password : ", "Password");
        echo form_password("pwd","","class=ipt_text_connexion");
        echo form_submit("submit", "Connection", "class=sbmt_connexion");
        echo form_close();
        ?>
    </div>
</div>