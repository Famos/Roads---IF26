<?php
	include('functions.inc.php');
	$erreur = 1; // Si pas changé : erreur de paramètre
	if(!empty($_GET["login"])){
		$login = $_GET["login"];
		$requete = $bdd->prepare("UPDATE utilisateur SET localisation = 0 WHERE login = :login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$erreur = 0;
	}
	echo '{"ID":'.$CODE_CACHE_POS.',"ERREUR":'.$erreur.'}';

?>