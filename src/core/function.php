<?php
require_once("../conf.inc.php");

function cleanEmail($email){
	return strtolower(trim($email));
}


function connectDB(){
	//Connexion à la bdd (DSN, USER, PWD)
	try{
		$connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
	}catch(Exception $e){
		die("Erreur SQL ".$e->getMessage());
	}

	return $connection;
}



#verifier si l'email est déjà en base de donnée
function verifIfEmailExist($email){
	$connection = connectDB();
	$queryPrepared = $connection->prepare("SELECT mail FROM ".DB_PREFIX."utilisateur WHERE mail=:mail");
	$queryPrepared->execute([
		"mail"=>$email
	]);
	$result = $queryPrepared->fetch();
	if (!empty($result)){
		return 1;
	}
	return 0;
}

function verifPasswordSyntaxe($pwd){
	if( strlen($pwd)<8 || 
		!preg_match("#[a-z]#", $pwd)  || 
		!preg_match("#[A-Z]#", $pwd)  || 
		!preg_match("#[0-9]#", $pwd) ){

			$listOfErrors[] = "Votre mot de passe doit faire au minimum 8 caractères avec des minuscules, des majuscules et des chiifres";
			return 1;
	}
	return 0;
}
?>