<div class="box_bouton_pdf">
    <?php





    // Inclure la bibliothèque PHP QR Code
    require_once '../phpqrcode/qrlib.php';

    // Données que vous souhaitez inclure dans le code QR
    $data = site_url("/Agent/Visiteur/A_Valider/" . $presentation['id'] . "/" . $sonSiege[0]['place_id'] . "");

    $number = rand(65196191, 9461649491);
    // Nom du fichier image du code QR à générer
    $filename = '../img/' . $number . '.png';

    // Paramètres pour la génération du code QR
    $ecc = 'L'; // Niveau de correction d'erreur (L, M, Q, H)
    $size = 10; // Taille du module QR

    // Générer le code QR
    QRcode::png($data, $filename);
    echo img(img_data($filename), "QR Code")
    ?>

</div>