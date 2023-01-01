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
	

	
	//D�claration de la m�thode publique 'create' qui permet d'ajouter un nouvelle tache à la bd
	public function create()
	{
		require "../../../connexionBD.php";
		$req = "INSERT INTO affecter (idTache, idUser, idStatut) VALUES (".$this->_idTache." , " .$this->_idUser. ", ".$this->_idStatut.");";
		$res = $bd->exec($req) or die(print_r($bd->errorInfo(), true));
		
		
	}
	
	
}



?>