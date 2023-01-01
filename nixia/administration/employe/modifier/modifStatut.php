<?php
	$idTache=$_POST['idTache'];
	$idStatut=$_POST['idStatut'];
	$idUser=$_POST['employe'];

	
	require_once "Mail.php";
	
	$modifierStatut= NEW Affecter($idTache,$idUser, $idStatut);

    $modifierStatut -> update();

	if ($modifierStatut){
		header("Location: ../dashboardEmploye.php");
		echo "<script>alert('Modification terminée');</script>";		

	}
	
	

?>