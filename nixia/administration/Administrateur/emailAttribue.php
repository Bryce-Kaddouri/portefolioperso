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
    <title>Administrateur- Liste E-mails Affectés</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><a style="text-decoration: none; color:#009d63;" href="/AP4-28032022v1/MS2R 03032022/administration/dashboard.php"><i
                    class="fas fa-user-secret me-2"></i>OVERMAIL</a></div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboardAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                        class="fas fa-tachometer-alt me-2"></i>Liste des e-mails</a>
                <a href="emailAttribue.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>E-mails attribués</a>
                <a href="gestionEmploye.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Gestion des employés</a>
                <a href="gestionAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
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
                    <h2 class="fs-2 m-0 primary-text">Liste des e-mails attribués</h2>
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
                                <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- class membre avec boostrap 5 -->
            <section>
            <table method="GET"style='margin: 2em;font-family: Helvetica, Arial, sans-serif;background: #ffffff;border-radius: 10px;box-shadow: 2px 2px 2px #ccc;overflow: hidden;'>
                    <thead> 
                        <tr>

                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;height:40px;' class='bg-white'>Expéditeur</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Objet</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Date de réception</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Employé</th>
                            <th style='text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;'class='bg-white'>Statut</th>
                            <th style='text-align:center;border-bottom:1px solid #000;'class='bg-white'>Editer statut</th>



                            

                        </tr>
                    </thead>
                    <?php



require_once "../connexionBD.php";
$sql="SELECT tache.id as idTache, client, objet, dateReception , affecter.idUser as idEmploye, concat(user.nom, ' ', user.prenom) as employe , affecter.idStatut as idStatut, libelle  FROM `tache`INNER join affecter on tache.id = affecter.idTache inner join user on user.id=affecter.idUser inner join statut on statut.id = affecter.idStatut order by affecter.idTAche desc;";
$res = $bd->query($sql);

while ($ligne = $res->fetch()){
    // couleur et conversion en chaine de caractére de idStatut avec une boucle en fonction de l'idStatut

    if($ligne['idStatut'] == 4){
        $colorStatut='#E42525';
        $stringStatut='Annuler';
    }elseif ($ligne['idStatut'] == 3) {
        $colorStatut='#72D119';
        $stringStatut='Terminer';
       
    }elseif ($ligne['idStatut'] == 2) {
        $colorStatut='#F5D130';
        $stringStatut='En cours';
        
    }

    echo"
    <tr>
        <td name='idTache' hidden>".$ligne['idTache']."</td>
        <td name='expediteur'class='bg-white' style='height:40px;width:20%text-align:center; border-right:1px solid #000;border-top:1px solid #000; padding: 0 1rem 0 1rem'>". $ligne['client'] ."</td>
        <td name='objet' class='bg-white' style='width:30%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['objet']."</td>
        <td name='dateReception' class='bg-white' style='width:15%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['dateReception']."</td>
        <td name='employe' class='bg-white' style='width:15%;text-align:center;border-right:1px solid #000;border-top:1px solid #000;padding: 0 1rem 0 1rem'>".$ligne['employe']."</td>
        <td name='statut'  style='width:10%;background-color:#ffFFFF;font:bold;color:".$colorStatut.";font-weight:bold;text-align:center; border-right:1px solid #000;border-top:1px solid #000;'>".$stringStatut."</td>
        <td name='btn_edit' class='bg-white' style='width:10%;text-align:center; border-top:1px solid #000;'><a href='gestionTache/modifier/formUpdateStatut.php?idTache=" . $ligne['idTache'] ."&client=".$ligne['client']."&objet=".$ligne['objet']."&client=".$ligne['client']."&idEmploye=".$ligne['idEmploye']."&nomEmploye=".$ligne['employe']."&dateReception=".$ligne['dateReception']."'><img  class='img_bouton' style='cursor:pointer;'src='pen-solid.svg'></a></td>

    </tr>";
}
?>
    </table>
      
    </section>      
    </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

</body>

</html>