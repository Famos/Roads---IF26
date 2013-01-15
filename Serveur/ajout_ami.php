<?php
	require('./functions.inc.php');
	$erreur = 1;	//Si pas changé : erreur de paramètre
	if(!empty($_POST["login"])&&!empty($_POST["ami"])&!empty($_POST["token"])){
		$login = $_POST["login"];
		$ami = $_POST["ami"];
		$id_utilisateur = getId($login);
        $token = getToken($id_utilisateur);
        if(strcmp($token, $_POST["token"])==0) {
            $id_ami = getId($ami);
            if($id_ami != null && $id_ami != ""){
                $requete = $bdd->prepare("SELECT id FROM ami WHERE id_utilisateur_1 = :id_1 AND id_utilisateur_2 = :id_2;");
                $requete->bindValue(':id_1', $id_utilisateur, PDO::PARAM_INT);
                $requete->bindValue(':id_2', $id_ami, PDO::PARAM_INT);
                $requete->execute();
                $donnees = $requete->fetchAll();
                if($donnees[0][0]!= null && $donnees[0][0] != ""){
                    $erreur = 3; //erreur dŽjˆ amis
                }else{
                    $requete = $bdd->prepare("INSERT INTO ami(id_utilisateur_1, id_utilisateur_2, visibilite) VALUES(:id_1, :id_2, 1),(:id_2, :id_1, 1);");
                    $requete->bindValue(':id_1', $id_utilisateur, PDO::PARAM_INT);
                    $requete->bindValue(':id_2', $id_ami, PDO::PARAM_INT);
                    $requete->execute();
                    $erreur = 0;	//Pas d'erreur
                }
            } else{
                $erreur = 2;    //erreur ami inexistant
            }
        } else {
            $erreur = -1;
        }
	}
	echo '{"ID":'.$CODE_AJOUT_AMI.',"ERREUR":'.$erreur.'}';
	
?>