<?php
	require_once "Mail.php";
	require_once "affecter.php";
	// Tache
    $objet = $_POST['objet'];
	$client = $_POST['expediteur']; // client
	$dateReception = $_POST['dateReception'];
	$idTache = $_POST['idTache'];

	// Affecter
	//$idTache
	$idUser = $_POST['employe'];
	$idStatut = $_POST['statut'];

	//echo "<p>objet: ". $objet."</p>";
	//echo "<p>cleint:". $client."</p>";
//echo "<p>date:". $dateReception."</p>";
//	echo "<p>tache:". $idTache."</p>";
//	echo "<p>user:". $idUser."</p>";
	//echo "<p>statut:". $idStatut."</p>";



	

	$nouvMail= NEW Mail($idTache, $objet, $client, $dateReception);
    $nouvMail -> create();

	$affectMail = NEW Affecter($idTache, $idUser, $idStatut);
	$affectMail -> create();

	if ($affectMail)
		{
			header("Location: ../../dashboardAdministrateur.php");
			echo "<script> 
					alert('Ajout des données avec succès'); 
				</script>";
			
		}
	


	

	
	


	
?>
    