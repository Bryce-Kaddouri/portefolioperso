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
    <title>Gestion des administrateurs</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><a style="text-decoration: none; color:#009d63;" href="/AP4-28032022v1/MS2R 03032022/administration/dashboard.php"><i
                    class="fas fa-user-secret me-2"></i>OVERMAIL</a></div>
            <div class="list-group list-group-flush my-3">
            <a href="dashboardAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text "><i
                        class="fas fa-tachometer-alt me-2"></i>Liste des e-mails</a>
                <a href="emailAttribue.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                        class="fas fa-tachometer-alt me-2"></i>E-mails attribués</a>
                <a href="gestionEmploye.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold "><i
                        class="fas fa-project-diagram me-2"></i>Gestion des employés</a>  
                <a href="gestionAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                        class="fas fa-chart-line me-2"></i>Gestion des administrateurs</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Déconnexion</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:#f0f0f2;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 primary-text">Gestion des administrateurs</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                                <?php echo $_SESSION['nom']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Paramètres</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- class membre avec boostrap 5 -->
            <section>
                <table method="GET" style='margin: 2em;font-family: Helvetica, Arial, sans-serif;background: #ffffff;border-radius: 10px;box-shadow: 2px 2px 2px #ccc;overflow: hidden;'>
                    <thead> 
                        <tr>

                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>Nom</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>Prenom</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>E-mail</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>Rôle</th>
                            <th style='text-align:center;border-bottom:1px solid #000;height:40px;' class='bg-white'>Ajouter</th>

                        </tr>
                    </thead>
                    
            
                    <?php
                    require "../connexionBD.php";
			        $sql = "SELECT nom, prenom, email, libelle FROM user INNER JOIN role  ON user.idRole=role.id where idRole='Adm';"; // requete Pour afficher tous les membres de la listes
			        $res = $bd->query($sql);  // j'execute ensuite cette requete 

			        while ($ligne = $res->fetch())  // on fait une boucle pour parcourir toutes les lignes de la table résultat obtenu avec $sql
			        {

                        echo 
                        "<tr>
                            <td style='height:40px;width:20%text-align:center; border-right:1px solid #000;border-top:1px solid #000; padding: 0 1rem 0 1rem'>".$ligne['nom']."</td>
                            <td style='width:30%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['prenom']."</td>
                            <td style='width:15%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['email']."</td>
                            <td style='width:15%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['libelle']."</td>
                            <td style='width:10%;text-align:center; border-top:1px solid #000;'><a href='gestionAdministrateur/ajouter/formAdministrateur.php'><img class='img_bouton'src='circle-plus-solid.svg'></a></td>
                        </tr>";
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