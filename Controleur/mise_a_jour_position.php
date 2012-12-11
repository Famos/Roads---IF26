<?php
	$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');

	if(!empty($_GET["login"])&&!empty($_GET["latitude"])&&!empty($_GET["longitude"])){
		$login = $_GET["login"];
		$latitude = $_GET["latitude"];
		$longitude = $_GET["longitude"];
		$id_utilisateur = getId($login); 
		echo $id_utilisateur . " | ". $latitude. " | ". $longitude;
		$requete = $bdd->prepare("UPDATE localisation SET latitude = :latitude, longitude = :longitude, date = NOW() WHERE id_utilisateur = :id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':latitude', $latitude, PDO::PARAM_STR);
		$requete -> bindValue(':longitude', $longitude, PDO::PARAM_STR);
		$requete -> execute();
	}
	
	function getId($login){
		$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
		$requete = $bdd->prepare("SELECT id FROM Utilisateur WHERE login=:login");
		$requete -> bindValue(':login', $login, PDO::PARAM_STR);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0]['id'];
	}
	
?>
