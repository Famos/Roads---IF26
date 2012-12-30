
<?php
	require('./functions.inc.php');

	if(!empty($_POST["login"])&&!empty($_POST["password"])){
	// if(!empty($_GET["login"])&&!empty($_GET["password"])){
		$login = $_POST["login"];
		$password = $_POST["password"];
		// $login = $_GET["login"];
		// $password = $_GET["password"];
		$token = "";
		$passhashed = md5($password);
		$requete = $bdd->prepare("SELECT password, id FROM Utilisateur WHERE login=:login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$donnees = $requete->fetchAll();
		if(count($donnees)>0){
			$realpass = $donnees[0]['password'];
			$id = $donnees[0]['id'];
			$salt = substr($realpass, -5);
			if($passhashed.$salt == $realpass){
				$_SESSION['login'] = $login;
				$_SESSION['id'] = $id;
				$erreur = 0;	//pas d'erreur
				$token = random_str(10);
				$requete = $bdd->prepare("UPDATE Utilisateur SET token = :token WHERE id = :id");
				$requete->bindValue(':token', $token, PDO::PARAM_STR);
				$requete->bindValue(':id', $id, PDO::PARAM_INT);
				$requete->execute();
			}
			else{
				$erreur = 1;	//password incorrect
			}
		}
		else{
			$erreur = 2;	//login incorrect
		}
		$expiration = time() + (3600);
		echo '{"ID":'.$CODE_AUTH.',"TOKEN":"'.$token.'", "EXPIRATION":"'.$expiration.'","ERREUR":'.$erreur.',"LOGIN":"'.$login.'"}';
	}
	
	

?>