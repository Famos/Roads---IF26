<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas changé : erreur de paramètre
	if(!empty($_POST["login"])&!empty($_POST["token"])){
		$login = $_POST["login"];
        $id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $requete = $bdd->prepare("UPDATE utilisateur SET localisation = 1 WHERE login = :login");
            $requete->bindValue(':login', $login, PDO::PARAM_STR);
            $requete->execute();
            $erreur = 0;
            echo '{"ID":'.$CODE_AFFICHE_POS.',"ERREUR":'.$erreur.'}';
        } else {
            echo '{"ID":'.$CODE_AFFICHE_POS.',"ERREUR":-1}';
        }
	} else {
        $erreur = 1;
        echo '{"ID":'.$CODE_AFFICHE_POS.',"ERREUR":'.$erreur.'}';
    }
	

?>