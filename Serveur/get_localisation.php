<?php
	require('./functions.inc.php');
	if(!empty($_POST["login"])&!empty($_POST["token"])){
		$login = $_POST["login"];
        $id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $requete = $bdd->prepare("SELECT localisation FROM utilisateur WHERE login = :login");
            $requete->bindValue(':login', $login, PDO::PARAM_STR);
            $requete->execute();
            $donnees = $requete->fetchAll();
            echo '{"ID":'.$CODE_GET_LOC.',"LOC":'.$donnees[0][0].',"ERREUR":0}';
        } else {
            echo '{"ID":'.$CODE_GET_LOC.',"ERREUR":-1}';
        }
	}
    else{
        echo '{"ID":'.$CODE_GET_LOC.',"ERREUR":1}';
    }
	

?>