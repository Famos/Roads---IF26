<?php
	require('./functions.inc.php');
    
	if(!empty($_POST["login"])&!empty($_POST["ami"])&!empty($_POST["token"])){
        $login = $_POST["login"];
        $ami = $_POST["ami"];
        $id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $id_ami = getId($ami);
			$donnees = getAmiVisibilite($id_utilisateur, $id_ami);
			echo '{"ID":'.$CODE_GET_AMI.',"VISIBILITE":"'.$donnees[0].'","ERREUR":0}';
        } else {
            echo '{"ID":'.$CODE_GET_AMI.',"ERREUR":-1}';
        }
	}
	else{
		echo '{"ID":'.$CODE_GET_AMI.',"ERREUR":1}';
	}
    
?>


