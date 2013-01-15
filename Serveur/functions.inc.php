<?php
    $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
	//VARIABLES GLOBALES :
	
	//Codes d'identification serveur :
	$CODE_AUTH = 1;
	$CODE_AJOUT_AMI = 2;
	$CODE_SUPPR_AMI = 3;
	$CODE_GET_AMI = 4;
	$CODE_MAJ_POS = 5;
	$CODE_CACHE_POS = 6;
    $CODE_AFFICHE_POS = 7;
	$CODE_GET_AMIS = 8;
    $CODE_GET_LOC = 9;
    $CODE_GET_UTILISATEUR = 10;
    $CODE_MASQUE_POS = 11;
    $CODE_AFFICHE_POS = 12;
    $CODE_TEST_AMI = 13;
    $CODE_TEST_POS = 14;



	

	function getId($login){
        $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
		$requete = $bdd->prepare("SELECT id FROM utilisateur WHERE login=:login");
        $requete -> bindValue(':login', $login, PDO::PARAM_STR);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0]['id'];
	}
	
	function getAmi($id_utilisateur, $id_ami){
        $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
		$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_1 = :id AND a.id_utilisateur_2 = :id_ami AND u.id = a.id_utilisateur_2 AND u.localisation = 1 AND l.id_utilisateur = u.id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':id_ami', $id_ami, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0];
	}
    
    function getAmiVisibilite($id_utilisateur, $id_ami){
        $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
		$requete = $bdd->prepare("SELECT a.visibilite FROM ami as a WHERE a.id_utilisateur_1 = :id_ami AND a.id_utilisateur_2 = :id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':id_ami', $id_ami, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0];
	}

	function getAmis($id_utilisateur){
        $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
		$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_2 = :id AND u.id = a.id_utilisateur_1 AND u.localisation = 1 AND l.id_utilisateur = u.id AND a.visibilite = 1");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees;
	}

    function getToken($id_utilisateur){
        $bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', 'root');
		$requete = $bdd->prepare("SELECT token FROM utilisateur WHERE id = :id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0][0];
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