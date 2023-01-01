<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styleDashbord.css" />
    <title>Administrateur - Liste des E-mails</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><a style="text-decoration: none; color:#009d63;" href="/AP4-28032022v1/MS2R 03032022/administration/dashboard.php"><i class="fas fa-user-secret me-2"></i>OVERMAIL</a></div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboardAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-tachometer-alt me-2"></i>Liste des e-mails</a>
                <a href="emailAttribue.php" class="list-group-item list-group-item-action bg-transparent second-text"><i class="fas fa-tachometer-alt me-2"></i>E-mails attribués</a>
                <a href="gestionEmploye.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Gestion des employés</a>
                <a href="gestionAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-chart-line me-2"></i>Gestion des administrateurs</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Déconnexion</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:#f0f0f2;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 primary-text">Liste des e-mails</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                                <?php echo $_SESSION['nom']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Paramètres</a></li>
                                <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- class membre avec boostrap 5 -->
            <section>
                <table method="GET" style='margin: 2em;font-family: Helvetica, Arial, sans-serif;background: #ffffff;border-radius: 10px;box-shadow: 2px 2px 2px #ccc;overflow: hidden; '>
                    <thead>
                        <tr>

                            <th style='text-align:center;width:20%;border-right:1px solid #000;' class='bg-white'>Expéditeur</th>
                            <th style='text-align:center; width:30%;border-right:1px solid #000;' class='bg-white'>Objet</th>
                            <th style='text-align:center;width:15%;border-right:1px solid #000;' class='bg-white'>Date de réception</th>
                            <th style='text-align:center;width:15%;border-right:1px solid #000;' class='bg-white'>Employé</th>
                            <th style='text-align:center;width:10%;border-right:1px solid #000;' class='bg-white'>Statut</th>
                            <th style='text-align:center;width:5%;' class='bg-white'>Ajouter / Editer</th>
                        </tr>
                    </thead>
                    <?php

                    // serveur de messagerie gmail 
                    $server = "{imap.gmail.com:993/debug/imap/ssl/novalidate-cert}INBOX";;

                    // adresse mail et mot de passe où on veut afficher les mails depuis celle-ci;
                    $username = 'nixiaprojet@gmail.com';
                    $password = 'btvjjqklccjdmoax';
                    // $username = 'projetnixia@gmail.com';
                    // $password = 'unojnkvqcixhrxjc'; 
                    // attention avec 2 facteursauthentification, vous devez generer un mot de passe d'application pour le gmail

                    // connexion au serveur de messagerie google
                    $mailbox = imap_open($server, $username, $password);

                    // $mailbox = imap_open($server, $username, $password);
                    $mails = FALSE;

                    //verification du mail
                    if (FALSE === $mailbox) {
                        $err = 'La connexion a échoué. Vérifiez vos paramètres!';
                    } else {
                        $info = imap_check($mailbox);
                        if (FALSE !== $info) {
                            // le nombre de messages affichés est entre 1 et 200
                            // libre à vous de modifier ce paramètre
                            $nbMessages = min(200, $info->Nmsgs);
                            $mails = imap_fetch_overview($mailbox, '1:' . $nbMessages, 0);
                        } else {
                            $err = 'Impossible de lire le contenu de la boite mail';
                        }
                    }

                    if (FALSE === $mails) {
                        echo $err;
                    } else {
                        $informationBoite = 'La boîte aux lettres contient ' . $info->Nmsgs . ' message(s) dont ' . $info->Recent . ' recent(s)';
                        echo "<div style='margin-left:1em;'><p>" . $informationBoite . "</p></div>";

                        foreach ($mails as $mail) {

                            // pour chaque mail on recupere le numero du mail, qui l'a envoyé, l'objet et la date de reception
                            $idTache = $mail->msgno;
                            $expediteur = (iconv_mime_decode($mail->from, 0, "UTF-8"));
                            $objet = (iconv_mime_decode($mail->subject, 0, "UTF-8"));
                            $dateReception = date('Y-m-d', strtotime($mail->date));

                            // je fait une requete pour sql qui me permet d'afficher si le numero de mail correspond à l'id de la table tache de ma BD
                            require_once "../connexionBD.php";
                            $sql = "SELECT count(affecter.idTache) as total, tache.* , affecter.idUser as idEmploye, concat(user.nom, ' ', user.prenom) as employe , affecter.idStatut as idStatut, libelle  FROM `tache`INNER join affecter on tache.id = affecter.idTache inner join user on user.id=affecter.idUser inner join statut on statut.id = affecter.idStatut where tache.id= " . $idTache . ";";
                            $res = $bd->query($sql);
                            $ligne = $res->fetch();

                            // si la requette renvoi 1 pour total alors le mail est deja enregistré dans la BD donc je l'affiche depuis la BD

                            if ($ligne['total'] > 0) {
                                $query = "select libelle, affecter.idStatut as idStatut, affecter.idUser as idEmploye, concat(user.nom, ' ', user.prenom) as employe,tache.* from tache inner join affecter on idTache = tache.id inner join user on idUser = user.id inner join statut on idStatut = statut.id where idTache =" . $ligne['id'] . ";";
                                $res = $bd->query($query);

                                while ($ligne = $res->fetch()) {
                                    if ($ligne['idStatut'] == 4) {
                                        $colorStatut = '#E42525';
                                        $stringStatut = 'Annuler';
                                    } elseif ($ligne['idStatut'] == 3) {
                                        $colorStatut = '#72D119';
                                        $stringStatut = 'Terminer';
                                    } elseif ($ligne['idStatut'] == 2) {
                                        $colorStatut = '#F5D130';
                                        $stringStatut = 'En cours';
                                    }

                                    echo "
                                <tr style='background-color:#E1E8F2;'>
                                    <td name='idTache' hidden>" . $ligne['id'] . " </td>
                                    <td name='expediteur' style='border-right:1px solid #000;text-align:center; border-top:1px solid #000; padding: 0 1rem 0 1rem;'>" . $ligne['client'] . "</td>
                                    <td name='objet' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>" . $ligne['objet'] . "</td>
                                    <td name='dateReception' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>" . $ligne['dateReception'] . "</td>
                                    <td value='" . $ligne['idEmploye'] . "' name='employe' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>" . $stringStatut . "</td>
                                    <td name='statut' value='" . $ligne['idStatut'] . "' style='color:" . $colorStatut . ";font-weight:bold;border-right:1px solid #000;color=#d6d6d6;text-align:center; border-top:1px solid #000;'>" . $ligne['libelle'] . "</td>
                                    <td name='btn_ajout' style='text-align:center; border-top:1px solid #000;'><a href='gestionTache/ajouter/formAffectOtherEmp.php?idTache=" . $idTache . "&objet=" . $objet . "&expediteur=" . $expediteur . "&dateReception=" . $dateReception . "'><img  class='img_bouton'src='pen-solid.svg'></a></td>

                                </tr>";
                                }
                            }
                            // sinon je l'affiche grace aux informations recuperer avec IMAP
                            else {
                                echo "
                            <tr>
                                <td name='idTache' hidden>" . $idTache . "</td>
                                <td name='expediteur' style='border-right:1px solid #000;text-align:center; border-top:1px solid #000; padding: 0 1rem 0 1rem'>" . $expediteur . "</td>
                                <td name='objet' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>" . $objet . "</td>
                                <td name='dateReception' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>" . $dateReception . "</td>
                                <td name='employe' style='border-right:1px solid #000;text-align:center;border-top:1px solid #000;padding: 0 1rem 0 1rem'>Aucun</td>
                                <td name='statut' style='border-right:1px solid #000;text-align:center; border-top:1px solid #000;'>Aucun</td>
                                <td name='btn_ajout' style='text-align:center; border-top:1px solid #000;'><a href='gestionTache/ajouter/formAjoutMail.php?idTache=" . $idTache . "&objet=" . $objet . "&expediteur=" . $expediteur . "&dateReception=" . $dateReception . "'><img  class='img_bouton' style='cursor:pointer;'src='circle-plus-solid.svg'></a></td>

                            </tr>";
                            }
                        }
                    }
                    ?>
                </table>
            </section>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>