<?php
	require('./functions.inc.php');
	$erreur = 1; // Si pas chang� : erreur de param�tre
	if(!empty($_POST["login"])&!empty($_POST["token"])){
		$login = $_POST["login"];
        $id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $requete = $bdd->prepare("UPDATE utilisateur SET localisation = 0 WHERE login = :login");
            $requete->bindValue(':login', $login, PDO::PARAM_STR);
            $requete->execute();
            $erreur = 0;
        } else {
            $erreur = -1;
        }
	}
	echo '{"ID":'.$CODE_CACHE_POS.',"ERREUR":'.$erreur.'}';

?>