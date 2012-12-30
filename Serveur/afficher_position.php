<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas changé : erreur de paramètre
	if(!empty($_POST["login"])){
		$login = $_POST["login"];
		$requete = $bdd->prepare("UPDATE utilisateur SET localisation = 1 WHERE login = :login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$erreur = 0;
	}
	echo '{"ID":'.$CODE_AFFICHE_POS.',"ERREUR":'.$erreur.'}';

?>