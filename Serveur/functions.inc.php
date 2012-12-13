<?php
	$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
	// $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'antoine', 'a7rd8F');

	//VARIABLES GLOBALES :
	
	//Codes d'identification serveur :
	$CODE_AUTH = 1;
	$CODE_AJOUT_AMI = 2;
	$CODE_SUPPR_AMI = 3;
	$CODE_GET_AMI = 4;
	$CODE_MAJ_POS = 5;
	$CODE_CACHE_POS = 6;
	$CODE_GET_AMIS = 7;
	

	function getId($login){
		$requete = $bdd->prepare("SELECT id FROM Utilisateur WHERE login=:login");
		$requete -> bindValue(':login', $login, PDO::PARAM_STR);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0]['id'];
	}
	
	function getAmi($id_utilisateur, $id_ami){
		$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_1 = :id AND a.id_utilisateur_2 = :id_ami AND u.id = a.id_utilisateur_2 AND u.localisation = 1 AND l.id_utilisateur = u.id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':id_ami', $id_ami, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0];
	}

	function getAmis($id_utilisateur){
		$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_1 = :id AND u.id = a.id_utilisateur_2 AND u.localisation = 1 AND l.id_utilisateur = u.id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees;
	}

	function random_str($nbr){
		$str = "";
		$chaine = "abcdefghijklmnpqrstuvwxyz0123456789";
		srand((double)microtime()*1000);

		for($i=0; $i<$nbr; $i++) {
			$str .= $chaine[rand()%strlen($chaine)];
		}

		return $str;
	}
?>