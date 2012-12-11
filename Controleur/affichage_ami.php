<?php
	$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');

	if(!empty($_GET["login"])&!empty($_GET["ami"])){
			$login = $_GET["login"];
			$ami = $_GET["ami"];
			$id_utilisateur = getId($login); 
			$id_ami = getId($ami); 
			$donnees = getAmi($id_utilisateur, $id_ami);
			echo '{"LOGIN":"'.$donnees[1].'","LATITUDE":"'.$donnees[2].'","LONGITUDE":"'.$donnees[3].'","DATE":"'.$donnees[4].'"}';
	}
	
	function getId($login){
		$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
		$requete = $bdd->prepare("SELECT id FROM Utilisateur WHERE login=:login");
		$requete -> bindValue(':login', $login, PDO::PARAM_STR);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0]['id'];
	}
	
	function getAmi($id_utilisateur, $id_ami){
		$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
			$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_1 = :id AND a.id_utilisateur_2 = :id_ami AND u.id = a.id_utilisateur_2 AND u.localisation = 1 AND l.id_utilisateur = u.id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> bindValue(':id_ami', $id_ami, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0];
	}
	
?>




