<?php
// echo $_POST['email'];




if (isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['objet']) && isset($_POST['message'])) {
    $from = "contact@portefolio-brycekaddouri.re.brandonrecette.re";
    $mailto = $_POST['email'];




    $subject = $_POST['objet'];
    // si l'ajoue du token a la bd reussi alors envoi mail sinon message erreur 
    $message = '<html>
                            <head>
                            </head>
                            <body>
                            <h1>Confirmation de l\' envoi du mail de prise de contact avec Bryce Kaddouri ! </h1><hr>
                            <p>Ce message est un message automatique, je me chargerais personnelement de vous réprondre à chacune de vos demandes dés que possible. </p>

                            <hr><hr>
                            <p>Cordialement, <hr> Kaddouri Bryce.</p>


                            </body>
                        </html>';

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $header[] = 'De :' . $from;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Envoi
    if (mail($mailto, $subject, $message, implode("\r\n", $headers))) {
        echo " success";
    } else {
        echo 'false test';
    }
}

echo $_POST['nom'] . " " . $_POST['prenom'] . " " . $_POST['email'] . " " . $_POST['objet'] . " " . $_POST['message'];
