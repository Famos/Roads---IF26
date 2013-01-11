
<?php
	require('./functions.inc.php');

	if(!empty($_POST["login"])&&!empty($_POST["password"])){
	// if(!empty($_GET["login"])&&!empty($_GET["password"])){
		$login = $_POST["login"];
		$password = $_POST["password"];
		// $login = $_GET["login"];
		// $password = $_GET["password"];
		$token = "";
		$message = "";
		$passhashed = md5($password);
		$requete = $bdd->prepare("SELECT password, id, echecAuthentification, dateProchainEssai, now() as date_courante FROM Utilisateur WHERE login=:login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$donnees = $requete->fetchAll();
		if(count($donnees)>0){
			$nombreEchec = $donnees[0]['echecAuthentification'];
			if ($nombreEchec > 2 && ($donnees[0]['date_courante']) < ($donnees[0]['dateProchainEssai'])){
				$erreur = 3; //bannissement temporaire
				$difference = strtotime($donnees[0]['dateProchainEssai']) - strtotime($donnees[0]['date_courante']). "<br/>";
				$secondesRestantes = $difference % 60;
				$difference -= $secondesRestantes;
				$minutesRestantes = $difference / 60;
				$heuresRestantes = 0;
				if ($minutesRestantes > 59){
					$difference = $minutesRestantes;
					$minutesRestantes = $difference % 60;
					$difference -= $minutesRestantes;
					$heuresRestantes = $difference / 60;
				}
				$message = "Suite à un trop grand nombre d'erreurs d'authentification, vous êtes temporairement banni. Vous pourrez essayer à nouveau de vous identifier dans ".$heuresRestantes." heures ".$minutesRestantes." minutes et ".$secondesRestantes." secondes.";
			}
			else{
				$realpass = $donnees[0]['password'];
				$id = $donnees[0]['id'];
				$salt = substr($realpass, -5);
				if($passhashed.$salt == $realpass){
					$_SESSION['login'] = $login;
					$_SESSION['id'] = $id;
					$erreur = 0;	//pas d'erreur
					$token = random_str(10);
					$requete = $bdd->prepare("UPDATE Utilisateur SET token = :token, echecAuthentification = 0 WHERE id = :id");
					$requete->bindValue(':token', $token, PDO::PARAM_STR);
					$requete->bindValue(':id', $id, PDO::PARAM_INT);
					$requete->execute();
				}
				else{
					$erreur = 1;	//password incorrect
					$requete = $bdd->prepare("UPDATE Utilisateur SET echecAuthentification = echecAuthentification + 1 WHERE id = :id");
					$requete->bindValue(':id', $id, PDO::PARAM_INT);
					$requete->execute();
					$nombreEchec = $nombreEchec + 1;
					$delai = 0;
					switch($nombreEchec){
						case 1 :
							$delai = 0;
							break;
						case 2 :
							$delai = 0;
							break;
						case 3 :
							$delai = 1;
                            $erreur = 4;
							break;
						case 4 :
							$delai = 15;
                            $erreur = 4;
							break;
						case 5 :
							$delai = 60;
                            $erreur = 4;
							break;
						case 6 :
							$delai = 120;
                            $erreur = 4;
							break;
						default :
							$delai = 1440;
                            $erreur = 4;
					}
					$requete = $bdd->prepare("UPDATE Utilisateur SET dateProchainEssai = DATE_ADD(now(), INTERVAL ".$delai." MINUTE) WHERE id = :id");
					$requete->bindValue(':id', $id, PDO::PARAM_INT);
					$requete->execute();
                    $message = "Vous êtes temporairement banni, vous pourrez réessayer de vous connecter dans ".$delai." minutes.";
				}
			}
		}
		else{
			$erreur = 2;	//login incorrect
		}
		//$expiration = time() + (3600);
		// echo '{"ID":'.$CODE_AUTH.',"TOKEN":"'.$token.'", "EXPIRATION":"'.$expiration.'","ERREUR":'.$erreur.',"LOGIN":"'.$login.'"}';
		echo '{"ID":'.$CODE_AUTH.',"TOKEN":"'.$token.'", "MESSAGE":"'.$message.'","ERREUR":'.$erreur.',"LOGIN":"'.$login.'"}';
	}
?>