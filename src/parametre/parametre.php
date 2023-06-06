<?php
session_start();
include "../template/header.php";
include "../core/function.php";

if(empty($_SESSION['login'])){
    header('Location: login/login.php');

  }


if (isset($_POST['delete'])) {
  $connection = connectDB();
  $sql = "DELETE FROM utilisateur WHERE mail = :mail";
  $stmt = $connection->prepare($sql);
  $stmt->execute(['mail' => $_SESSION['email']]);
  header('Location: ../register/register.php');
  exit();
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

<div class="col-12 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <img id="pdp" src="<?php echo "../img/".$pdp ?>" alt="photo de profil">
      </div>
    </div>
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <h2><?php echo "Pseudo: ".$username ?></h1>
      </div>
    </div>
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <h2><?php echo "Prénom: ".$prenom ?></h2>
      </div>
      <div class="m-3">
        <h2><?php echo "Nom: ".$nom ?></h2>
      </div>
    </div>
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <h2><?php echo "Email: ".$email ?></h2>
      </div>
    </div>
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <h2><?php echo "Date de création: ".$date_creation ?></h2>
      </div>
    </div>
    <div class="row-12 d-flex justify-content-center">
      <div class="m-3">
        <form method="POST">
          <button type="submit" name="delete" value="delete" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Supprimer le compte
          </button>
        </form>
      </div>
    </div>
</div> 