<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas changé : erreur de paramètre
	if(!empty($_POST["login"])&&!empty($_POST["ami"])&!empty($_POST["token"])){
		$login = $_POST["login"];
        $ami = $_POST["ami"];
        $id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $id_ami = getId($ami);
            $requete = $bdd->prepare("SELECT visibilite FROM AMI WHERE id_utilisateur_1 = :id_1 AND id_utilisateur_2 = :id_2");
            $requete->bindValue(':id_1', $id_utilisateur, PDO::PARAM_INT);
            $requete->bindValue(':id_2', $id_ami, PDO::PARAM_INT);
            $requete->execute();
            $donnees = $requete->fetchAll();
            $visibilite = $donnees[0][0];
            $erreur = 0;
        } else {
            $visibilite = -1;
            $erreur = -1;
        }
	}
	echo '{"ID":'.$CODE_TEST_POS.',"ERREUR":'.$erreur.',"VISIBILITE":'.$visibilite.'}';

?>