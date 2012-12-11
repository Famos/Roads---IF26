<?php
	$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');

	if(!empty($_GET["login"])){
		$login = $_GET["login"];
		
		$id_utilisateur = getId($login); 
		$donnees = getAmis($id_utilisateur);
		echo '["":';
		$first=true;
		for($i=0;$i<count($donnees) ; $i++){
			if($first){
				$first=false;
			}
			else{
				echo ",";
			}
			echo '{"LOGIN":"'.$donnees[$i][1].'","LATITUDE":"'.$donnees[$i][2].'","LONGITUDE":"'.$donnees[$i][3].'","DATE":"'.$donnees[$i][4].'"}';
		}
		echo "]";
		
	}
	
	function getId($login){
		$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
		$requete = $bdd->prepare("SELECT id FROM Utilisateur WHERE login=:login");
		$requete -> bindValue(':login', $login, PDO::PARAM_STR);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees[0]['id'];
	}
	
	function getAmis($id_utilisateur){
		$bdd = new PDO('mysql:host=localhost;dbname=Roads', 'root', '');
		$requete = $bdd->prepare("SELECT u.id, u.login, l.latitude, l.longitude, l.date FROM ami as a, utilisateur as u, localisation as l WHERE a.id_utilisateur_1 = :id AND u.id = a.id_utilisateur_2 AND u.localisation = 1 AND l.id_utilisateur = u.id");
		$requete -> bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
		$requete -> execute();
		$donnees = $requete->fetchAll();
		return $donnees;
	}
	
?>