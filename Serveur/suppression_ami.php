<?php
	require('./functions.inc.php');
	$erreur = 1;	//Si pas changé : erreur de paramètre

	if(!empty($_POST["login"])&&!empty($_POST["ami"])){
		$login = $_POST["login"];
		$ami = $_POST["ami"];
		
		$id_utilisateur = getId($login); 
		$id_ami = getId($ami);
		$requete = $bdd->prepare("DELETE FROM ami WHERE (id_utilisateur_1 = :id_1 AND id_utilisateur_2 = :id_2) OR (id_utilisateur_1 = :id_2 AND id_utilisateur_2 = :id_1)");
		$requete->bindValue(':id_1', $id_utilisateur, PDO::PARAM_INT);
		$requete->bindValue(':id_2', $id_ami, PDO::PARAM_INT);
		$requete->execute();
		$erreur = 0;	//Pas d'erreur
	}
	echo '{"ID":'.$CODE_SUPPR_AMI.',"ERREUR":'.$erreur.'}';

?>