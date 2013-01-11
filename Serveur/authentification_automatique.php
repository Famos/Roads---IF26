<?php
    require('./functions.inc.php');
    $key = 'abcdefghijklmnopqrstuvwxyz123456';
    //$var = "UEmkq143%2Bk8R61nf5yrEVQ%3D%3D";
    //echo AES_Decode(urldecode($var));
    
    
    
    if(!empty($_POST["login"])){
       $loginCrypte = $_POST["login"];
        //echo $loginCrypte;
       $login = AES_Decode($loginCrypte);
       $token = random_str(10);
       $id = getId($login);
       $requete = $bdd->prepare("UPDATE Utilisateur SET token = :token WHERE id = :id");
       $requete->bindValue(':token', $token, PDO::PARAM_STR);
       $requete->bindValue(':id', $id, PDO::PARAM_INT);
       $requete->execute();
    }
    echo '{"ID":'.$CODE_AUTH.',"TOKEN":"'.$token.'","LOGIN":"'.$login.'"}';

/*function AES_Encode($plain_text)
{
    global $key;
    return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
}*/

function AES_Decode($base64_text)
{
    global $key;
    return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
}

?>