<?php

    $nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$password= $_POST['password'];
	$role = 'Emp';



	require "employe.php";

    $nouvEmploye= NEW Employe(NULL, $nom, $prenom, $email, $password, $role);

    $nouvEmploye -> create();

	if ($nouvEmploye){
		
		header("Location: ../../gestionEmploye.php");
		echo "<script>alert('Ajout terminé');</script>";
	}
	
?>
    