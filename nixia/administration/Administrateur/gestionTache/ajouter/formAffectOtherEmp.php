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
    <link rel="stylesheet" href="../../styleDashbord.css" />
    <title>Ajouter employé à un e-mail</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><a style="text-decoration: none; color:#009d63;" href="/AP4-28032022v1/MS2R 03032022/administration/dashboard.php"><i
                    class="fas fa-user-secret me-2"></i>OVERMAIL</a></div>
            <div class="list-group list-group-flush my-3">
            <a href="../../dashboardAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Liste des e-mails</a>
                <a href="../../emailAttribue.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                        class="fas fa-tachometer-alt me-2"></i>E-mails attribués</a>
                <a href="../../gestionEmploye.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Gestion des employés</a>
                <a href="../../gestionAdministrateur.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Gestion des administrateurs</a>
                <a href="../../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Déconnexion</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:#f0f0f2;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0 primary-text">Attribuer un autre employé</h2>
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
            <form action="ajoutOtherEmp.php" method="POST" style="width:50%;margin:auto;margin-top:5%;border:1px solid #000;border-radius:25px; padding:25px;">
                <input name="idTache" type="text" value="<?php echo $_GET['idTache']?>" hidden>
                <div class="mb-3">
                    <label for="objet" class="form-label">Objet : </label>
                    <input type="text" class="form-control" name='objet' value="<?php echo $_GET['objet'] ?>">
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Employé : </label>
                    <select name="employe" class="form-select">
                        <option value="">-- Choisissez un employé --</option>
                        <?php
                            require_once "../../../connexionBD.php";
							$req = "select idRole, id, concat(nom,' ', prenom) as employe from user where id not in (select idUser from affecter where idTache = ".$_GET['idTache'].") and idRole='Emp';";
							$res = $bd->query($req);

							// Parcours du resultat de la requete sql ligne par ligne avec une boucle
							while ($ligne = $res->fetch())
							{
				
								echo "<option value='" .$ligne['id']."'>". $ligne['employe']."</option>";
							}
						?>						

                    </select>
                </div>
                <div class="mb-3">
                    <label for="client" class="form-label">Client : </label>
                    <input type="text" class="form-control" name="expediteur" value="<?php echo $_GET['expediteur'];?>">
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut : </label>
                    <select name="statut" class="form-select">
                        <option>-- Choisissez un statut --</option>
                        <?php
                            require_once "../../../connexionBD.php";
							$req = "SELECT * from statut where id=2;";
							$res = $bd->query($req);

							// Parcours du resultat de la requete sql ligne par ligne avec une boucle
							while ($ligne = $res->fetch())
							{
				
								echo "<option value='" .$ligne['id']."'>". $ligne['libelle']."</option>";
							}
			
						?>		
                    </select>
                </div>
                <div class="mb-3">
                    <label for="expediteur" class="form-label">Date de réception :</label>
                    <input type="date" class="form-control" name="dateReception" value=<?php echo $_GET['dateReception']?>>
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            </section>      

                
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