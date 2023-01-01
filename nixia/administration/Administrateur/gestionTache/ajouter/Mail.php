<?php


class Mail
{
	//D�claration des attributs de la classe
	private $_id;					//l'identifiant du club
	private $_objet;					//le nom du club
	private $_client;			//l'adresse du club
	private $_dateReception;			//le codePostal du club

	//D�claration du constructeur
	public function __construct($id, $objet, $client, $dateReception)
	{
		$this->_id = $id;	
		$this->_objet = $objet;
		$this->_client = $client;
		$this->_dateReception = $dateReception;

	}
	
	//D�claration de la m�thode publique 'create' qui permet d'ajouter un nouveau club � la BD
	public function create()
	{
		require "../../../connexionBD.php";
		$req="INSERT INTO tache (id, objet, client, dateReception) SELECT ". $this->_id . " , '".$this->_objet ."' , '". $this->_client."' , '". $this->_dateReception ."' FROM DUAL WHERE NOT EXISTS (SELECT id FROM tache WHERE id = ". $this->_id . " ) LIMIT 1;";
		$res = $bd->exec($req) or die(print_r($bd->errorInfo(), true));

	}
	
	
	
}



?>