<?php
try {

	$bd = new PDO("mysql:host=brandonrecette.re;dbname=recettem_projetstagenixia", "recettem", "H&B191219#", array(
		// $db = new PDO ("mysql:host=localhost:5555;dbname=db_lamarjoline","root","",array(

		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	));

	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Erreur : " . $e->getMessage();
}
