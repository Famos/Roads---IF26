<?php
	require('./functions.inc.php');
	if(!empty($_POST["login"])){
		$login = $_POST["login"];
		$requete = $bdd->prepare("SELECT localisation FROM utilisateur WHERE login = :login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
        $donnees = $requete->fetchAll();
        echo '{"ID":'.$CODE_GET_LOC.',"LOC":'.$donnees[0][0].',"ERREUR":0}';
	}
    else{
        echo '{"ID":'.$CODE_GET_LOC.',"ERREUR":1}';
    }
	

?>