<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas changé : erreur de paramètre

	if(!empty($_POST["login"])&&!empty($_POST["latitude"])&&!empty($_POST["longitude"])){
		$login = $_POST["login"];
		$latitude = $_POST["latitude"];
		$longitude = $_POST["longitude"];
        $id_utilisateur = getId($login);
		$requete = $bdd->prepare("UPDATE localisation SET latitude = :latitude, longitude = :longitude, date = NOW() WHERE id_utilisateur = :id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':latitude', $latitude, PDO::PARAM_STR);
		$requete -> bindValue(':longitude', $longitude, PDO::PARAM_STR);
		$requete -> execute();
		$erreur = 0;
	}
	echo '{"ID":'.$CODE_MAJ_POS.',"ERREUR":'.$erreur.'}';

?>
