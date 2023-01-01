<?php


class Administrateur
{
	//D�claration des attributs de la classe
	private $_id;					//l'identifiant du de l'employe
	// ... A compl�ter
	private $_nom;					//le nom de l'employe
	private $_prenom;			//le prenom de l'employe
	private $_email;				//l'e-mail de l'employe
	private $_password;					//le mot de passe de l'employe
	private $_idRole;				// role de l'employe
	

	

	//D�claration du constructeur
	public function __construct($id, $nom, $prenom, $email, $password, $idRole)
	{
		$this->_id = $id;	
		$this->_nom = $nom;
		$this->_prenom = $prenom;
		$this->_email = $email;
		$this->_password = $password;
		$this->_idRole = $idRole;
	
		// Initialisation de l'identifiant de cet objet
	}
	
	//Declaration de la methode publique 'create' qui permet d'ajouter un nouveau  employé à la BD
	public function create()
	{
		require "../../../connexionBD.php";
		$res = "INSERT INTO user (id, nom, prenom, email, password, idRole) VALUES (NULL, '".$this->_nom ."', '".$this->_prenom ."', '".$this->_email ."', SHA1('".$this->_password ."') , '".$this->_idRole ."');"; 
		$res = $bd->exec($res) or die(print_r($bd->errorInfo(), true));
	}
}