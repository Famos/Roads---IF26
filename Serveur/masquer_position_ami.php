<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas chang� : erreur de param�tre
	if(!empty($_POST["login"])&&!empty($_POST["ami"])){
		$login = $_POST["login"];
        $ami = $_POST["ami"];
        $id_utilisateur = getId($login);
        $id_ami = getId($ami);
		$requete = $bdd->prepare("UPDATE ami SET visibilite = 0 WHERE id_utilisateur_1 = :id_1 AND id_utilisateur_2 = :id_2");
		$requete->bindValue(':id_1', $id_utilisateur, PDO::PARAM_INT);
        $requete->bindValue(':id_2', $id_ami, PDO::PARAM_INT);
		$requete->execute();
		$erreur = 0;
	}
	echo '{"ID":'.$CODE_MASQUE_POS.',"ERREUR":'.$erreur.'}';

?>