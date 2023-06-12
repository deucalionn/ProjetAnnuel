<?php 
// code pour voir une publication en particulier
// on récupère l'id de la publication
$idPublication = $_GET['id'];
$connection = connectDB();
// on récupère les informations de la publication
$sql = "SELECT * FROM publication WHERE idPublication = :idPublication";
$stmt = $connection->prepare($sql);
$stmt->execute(['idPublication' => $idPublication]);
$result = $stmt->fetch();
$titre = $result['titre'];
$description = $result['description'];
$photo = $result['image'];
$localisation = $result['localisation'];
$date = $result['date'];
// on récupère les informations de l'utilisateur qui a publié
$sql = "SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute(['idUtilisateur' => $result['idUtilisateur']]);
$result_utilisateur = $stmt->fetch();
$pseudo = $result_utilisateur['pseudo'];
$pdp = $result_utilisateur['pdp'];
// on récupère les commentaires de la publication




?>