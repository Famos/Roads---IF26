<?php
	require('./functions.inc.php');
	if(!empty($_POST["utilisateur"])){
        $utilisateur = $_POST["utilisateur"];
        $id_utilisateur = getId($utilisateur);
        $requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM utilisateur as u, localisation as l WHERE u.id = :id AND l.id_utilisateur = :id");
        $requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
        $requete -> execute();
        $donnees = $requete->fetchAll();
        echo '{"ID":'.$CODE_GET_UTILISATEUR.',"LOGIN":"'.$donnees[0][1].'","LATITUDE":"'.$donnees[0][2].'","LONGITUDE":"'.$donnees[0][3].'","DATE":"'.$donnees[0][4].'""ERREUR":0}';
	}
	else{
		echo '{"ID":'.$CODE_GET_UTILISATEUR.',"ERREUR":1}';
	}
		
?>
