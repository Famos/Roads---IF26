<?php
	require('./functions.inc.php');

	if(!empty($_POST["login"])&!empty($_POST["ami"])){
			$login = $_POST["login"];
			$ami = $_POST["ami"];
			$id_utilisateur = getId($login); 
			$id_ami = getId($ami); 
			$donnees = getAmi($id_utilisateur, $id_ami);
			echo '{"ID":'.$CODE_GET_AMI.',"LOGIN":"'.$donnees[1].'","LATITUDE":"'.$donnees[2].'","LONGITUDE":"'.$donnees[3].'","DATE":"'.$donnees[4].'","ERREUR":0}';
	}
	else{
		echo '{"ID":'.$CODE_GET_AMI.',"ERREUR":1}';
	}
		
?>




