<?php


class Affecter
{
	//D�claration des attributs de la classe
	private $_idTache;					//le nom du club
	private $_idUser;			//l'adresse du club
	private $_idStatut;			//l'adresse du club


	//D�claration du constructeur
	public function __construct($idTache, $idUser, $idStatut)
	{
		$this->_idTache = $idTache;
		$this->_idUser = $idUser;
		$this->_idStatut = $idStatut;

	}

	// Déclaration de la méthode publique 'retrieve' qui permet d'afficher les informations d'un membre de la BD

	public function update()
	{
		require "../../../connexionBD.php";
		$sql = "UPDATE affecter SET idStatut=" . $this->_idStatut ." WHERE idTache =" . $this->_idTache . " AND idUser=".$this->_idUser." ;";
		echo $sql;
		$res = $bd->exec($sql) or die(print_r($bd->errorInfo(), true));
		echo $sql;

		if ($res)
		{
			echo "<script> window.location.href='../../../Administrateur/emailAttribue.php';
							alert('Ajout des données avec succès');</script>";
		}
		else{
			echo "<script> alert('cet E-mail est déja enregistré dans la base de donnée');";

		}
		
		
				
	}
	
	
}



?>