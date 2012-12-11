<?php
	$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
	
	if(!empty($_GET["login"])){
		$login = $_GET["login"];
		$requete = $bdd->prepare("UPDATE utilisateur SET localisation = 0 WHERE login = :login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		echo "OK";
	}
?>