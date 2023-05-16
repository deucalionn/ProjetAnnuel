<?php
require "../core/function.php";
session_start();



$data = json_decode(file_get_contents("php://input"), true);
$altArray = $data;
$connection = connectDB();



if (empty($_SESSION['info']["lastname"])
|| empty($_SESSION['info']["firstname"])
|| empty($_SESSION['info']["email"])
|| empty($_SESSION['info']["password"])
|| empty($_SESSION['info']["password-Confirm"])
|| empty($_SESSION['info']["gender"])
|| empty($_SESSION['info']["dateNaissance"])){

    if (isset($altArray) && !empty($altArray)) {
        #verifier le captcha
        if ($altArray[0] == "39-11-l26.jpg"){
            if ($altArray[0] == "39-11-l26.jpg"){
                if($altArray[1] == "39-12-l26.jpg"){
                    if($altArray[2] == "39-13-l26.jpg"){
                        if($altArray[3] == "39-21-l26.jpg"){
                            if($altArray[4] == "39-22-l26.jpg"){
                                if($altArray[5] == "39-23-l26.jpg"){
                                    $lastname = $_SESSION['info']['lastname'];
                                    $firstname = $_SESSION['info']['firstname'];
                                    $email = $_SESSION['info']['email'];
                                    $pwd = $_SESSION['info']['password'];
                                    $gender = $_SESSION['info']['gender'];
                                    $birthday = $_SESSION['info']['dateNaissance'];
                                    $city = $_SESSION['info']['ville'];
                                    $pseudo = $_SESSION['info']['username'];

                                    $queryPrepared = $connection->prepare("INSERT INTO utilisateur
										(genre, prenom, nom, pseudo, mail, pwd, anniversaire, ville)
										VALUES 
										(:genre, :prenom, :nom, :pseudo, :mail, :pwd, :anniversaire, :ville)");

                                    $queryPrepared->execute([
                                                                "genre"=>$gender,
                                                                "prenom"=>$firstname,
                                                                "nom"=>$lastname,
                                                                "pseudo"=>$pseudo,
                                                                "mail"=>$email,
                                                                "pwd"=>password_hash($pwd, PASSWORD_DEFAULT),
                                                                "anniversaire"=>$birthday,
                                                                "ville"=>$city
                                                            ]);
                                    $errorInfo = $queryPrepared->errorInfo();
                                    echo "Erreur SQL : " . $errorInfo[2];
                                    http_response_code(200);
                                    echo json_encode(["status" =>"ok", "msg" => "Le captcha est correcte"]);
                            
                                    exit();
                                }
                            }
                        }
                    }
                }
            }  
        }
        http_response_code(400);
        echo json_encode(["status" =>"error", "msg" => "Le captcha est incorrecte"]);
        exit();
    
    }

}
else{
    http_response_code(200);
    echo json_encode(["status" =>"error", "msg" => "pas de session"]);
}



?>
