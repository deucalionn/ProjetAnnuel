<?php
include_once(__DIR__ . '/function.php');
// code qui recevra un id de publication et un id d'utilisateur pour liker une publication
// on récupère les données de la publication

// si on recupère une requete POST avec "like" dedans alors on ajoute un like à une publication
if(!empty($_POST)){
    $connection = connectDB();
    // d'abord on vérifie si l'utilisateur n'a pas déjà liker la publication
    $queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."likes WHERE idUtilisateur = :idUtilisateur AND idPublication = :idPublication");
    $queryPrepared->execute([
        "idUtilisateur"=>intval($_POST["idUtilisateur"]),
        "idPublication"=>intval($_POST["idPublication"])
    ]);
    $result = $queryPrepared->fetch();
    if(!empty($result)){
        echo json_encode(["status" =>"error", "msg" => "ligne déjà présente dans la base de donnée"]);
        exit();
    }


    $queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."likes (idUtilisateur, idPublication) VALUES (:idUtilisateur, :idPublication)");
    $queryPrepared->execute([
        "idUtilisateur"=>intval($_POST["idUtilisateur"]),
        "idPublication"=>intval($_POST["idPublication"])
    ]);
    echo json_encode(["status" =>"ok", "msg" => "ligne rentrer dans la base de donnée"]);
    exit();

}



echo json_encode(["status" =>"error", "msg" => "pas de ligne inserer"]);





?>