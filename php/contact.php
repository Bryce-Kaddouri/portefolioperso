<?php
// echo $_POST['email'];




$mailto = $_POST['email'];
$subject = $_POST['objet'];
// si l'ajoue du token a la bd reussi alors envoi mail sinon message erreur 
$message = '<html>
                        <head>
                        </head>
                        <body>
                            <p>Modification de votre mot de passe, cliquez sur le lien ci-dessous pour le modifier :</p>
                            <br>
                            <div style="width:100%;"><strong style="background-color:red;margin-left:auto;margin-right:auto;">' . $token . '</strong>
                            </div>
                                <br>
                                <button href="verifToken.php" id="btn-resetPassword" style="padding:3px;background-color:grey;cursor:pointer;">Envoyer</button>
                                <p> Ce n\'étais pas vous ? </p>
                                <span>Cliquer sur ce lien pour signaler une intrusion > </span> 
                        </body>
                    </html>';

// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Envoi


echo 'Your mail has been sent successfully.';
