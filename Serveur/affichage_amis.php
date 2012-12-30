<?php
	require('./functions.inc.php');

	if(!empty($_POST["login"])){
		$login = $_POST["login"];
		
		$id_utilisateur = getId($login); 
		$donnees = getAmis($id_utilisateur);
		echo '[';
		$first=true;
		for($i=0;$i<count($donnees) ; $i++){
			if($first){
				$first=false;
			}
			else{
				echo ",";
			}
			echo '{"ID":'.$CODE_GET_AMIS.',"LOGIN":"'.$donnees[$i][1].'","LATITUDE":"'.$donnees[$i][2].'","LONGITUDE":"'.$donnees[$i][3].'","DATE":"'.$donnees[$i][4].'","ERREUR":0}';
		}
		echo "]";
	}
	else{
		echo '{"ID":'.$CODE_GET_AMIS.',"ERREUR":1}';
	}
	
?>