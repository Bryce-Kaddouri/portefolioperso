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
    <link rel="stylesheet" href="styleDashbordNews.css" />
    <title>Employé - Gestion des Mails</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><a style="text-decoration: none; color:#000;" href="#"><i
                    class="fas fa-user-secret me-2"></i>OverMail</a></div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color:#00CEE0;"><i
                        class="fas fa-tachometer-alt me-2"></i>Employé</a>
                
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Déconnexion</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div style='background-color:#dbfcff;' id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Employé</h2>
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
                                <?php echo $_SESSION['nom'] ; ?>
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
            <table method="GET" style='margin: auto;font-family: Helvetica, Arial, sans-serif;background: #ffffff;border-radius: 10px;box-shadow: 2px 2px 2px #ccc;overflow: hidden;'>
                    <thead> 
                        <tr>

                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>Expéditeur</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Objet</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Date de Réception</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Statut</th>
                            <th style='text-align:center;border-bottom:1px solid #000;'class='bg-white'>Editer statut</th>



                            

                        </tr>
                    </thead>
                <?php
                            require_once "../connexionBD.php";
							$req = "SELECT tache.*, affecter.idStatut as statut, CONCAT(user.nom, ' ', user.prenom) as employe from tache inner join affecter on tache.id = affecter.idTache inner join user on user.id = affecter.idUser inner join statut on affecter.idStatut = statut.id where affecter.idUser = " . $_SESSION['prenom']." ;";
							$res = $bd->query($req);

							// Parcours du resultat de la requete sql ligne par ligne avec une boucle
							while ($ligne = $res->fetch())
							{
                                
                                

                                if($ligne['statut'] == 4){
                                    $colorStatut='#E42525';
                                    $statut='Annuler';
                                }elseif ($ligne['statut'] == 3) {
                                    $colorStatut='#72D119';
                                    $statut='Terminer';
                                   
                                }elseif ($ligne['statut'] == 2) {
                                    $colorStatut='#F5D130';
                                    $statut='En cours';
                                    
                                }
				
								

                                echo "
                                <tr>
                                    <td name='idTache' hidden>".$ligne['id']."</td>
                                    <td name='expediteur'class='bg-white' style='height:40px;width:20%;text-align:center; border-right:1px solid #000;border-top:1px solid #000; padding: 0 1rem 0 1rem'>". $ligne['client'] ."</td>
                                    <td name='objet' class='bg-white' style='width:30%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['objet']."</td>
                                    <td name='dateReception' class='bg-white' style='width:15%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['dateReception']."</td>
                                    <td name='statut'  style='width:10%;background-color:#ffFFFF;font:bold;color:".$colorStatut.";text-align:center; border-right:1px solid #000;border-top:1px solid #000;'>".$statut."</td>
                                    <td name='btn_edit' class='bg-white' style='width:10%;text-align:center; border-top:1px solid #000;'><a href='modifier/formUpdateStatut.php?idTache=".$ligne['id'] . "&objet=" . $ligne['objet']."&client=". $ligne['client']. "&dateReception=".$ligne['dateReception']."'><img  class='img_bouton' style='cursor:pointer;'src='pen-solid.svg'></a></td>

                                </tr>";
                                
							}
					?>	
            </section>
            

        
                
            </div>    


            

                
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>