<?php

    $nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$password= $_POST['password'];
	$role = 'Adm';



	require "adminisitrateur.php";

    $nouvAdministrateur= NEW Administrateur(NULL, $nom, $prenom, $email, $password, $role);

    $nouvAdministrateur -> create();

	if ($nouvAdministrateur){
		
		header("Location: ../../gestionAdministrateur.php");
		echo "<script>alert('Ajout terminé');</script>";
	}
	
?>
    