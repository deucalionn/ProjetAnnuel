<?php
session_start();
include "template/header.php";
include "core/functions.php";

if(empty($_SESSION['login'])){
    header('Location: login/login.php');

}

// requete sql qui recupere le nom prenom et nom d'utilisateur de l'utilisateur connecté à partir de son email
$connection = connectDB();
$sql = "SELECT nom, prenom, pseudo, date_creation, pdp FROM utilisateur WHERE mail = :mail";
$stmt = $connection->prepare($sql);
$stmt->execute(['mail' => $_SESSION['email']]);

// je créer une variable pour stocker les données de la requete
$result = $stmt->fetch();
$nom = $result['nom'];
$prenom = $result['prenom'];
$username = $result['pseudo'];
$email = $_SESSION['email'];
$date_creation = $result['date_creation'];
$pdp = $result['pdp'];


?>

<div class="col-5 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
    <div class="row">
      <h1>Profil de <?php $username ?></h1>
      <img src="<?php echo $pdp ?>" alt="photo de profil">
    </div>
</div>