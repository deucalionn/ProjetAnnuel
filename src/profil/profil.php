<?php


session_start();
include "../core/function.php";
include "../template/header.php";

//d'abord on s'assure que la variable session login est a 1
if(empty($_SESSION['login'])){
    header('Location: ../login/login.php');

  }


// si une action existe on l'affiche
if (isset($_SESSION['action'])) {
    foreach ($_SESSION['action'] as $action) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        ".$action."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    unset($_SESSION['action']);
}


// code pour modifier le profil
if (isset($_POST['edit-profil'])) {
    $uploadDir = '../img/'; // Spécifiez le répertoire de destination
    $fileName = $_FILES['image']['name'];
    $filePath = $uploadDir . $fileName;

    if($fileName != ""){
            if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)){
            $connection = connectDB();
            $sql = "UPDATE utilisateur SET pseudo = :pseudo, biographie = :biographie, pdp = :pdp, ville = :ville WHERE mail = :mail";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['pseudo' => $_POST['pseudo'], 'biographie' => $_POST['biographie'], 'pdp' => $_FILES['image']['name'], 'ville'=> $_POST['ville'], 'mail' => $_SESSION['email']]);
            header('Location: profil.php');
            $_SESSION['action'] = ["Profil modifié"];
            header('Location: profil.php');
            exit();
        }
        else {
            $_SESSION['action'] = ["Erreur lors de l'upload de l'image"];
            header('Location: profil.php');
        }

    }
    else {
        $connection = connectDB();
        $sql = "UPDATE utilisateur SET pseudo = :pseudo, biographie = :biographie, ville = :ville WHERE mail = :mail";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['pseudo' => $_POST['pseudo'], 'biographie' => $_POST['biographie'], 'ville' => $_POST['ville'], 'mail' => $_SESSION['email']]);
        header('Location: profil.php');
        $_SESSION['action'] = ["Profil modifié"];
        header('Location: profil.php');
        exit();
    }
}


// code pour delete la publication
if (isset($_POST['delete'])) {
  $connection = connectDB();
  $sql = "DELETE FROM publication WHERE idPublication = :id";
  $stmt = $connection->prepare($sql);
  $stmt->execute(['id' => $_POST['id']]);
  header('Location: profil.php');
  $_SESSION['action'] = ["Publication supprimée"];
  header('Location: profil.php');
  exit();
}


//code php qui affiche tt les publications de l'utilisateur connecté
$connection = connectDB();
// premiere requete pour recuperer l'id utilisateur avec son email
$sql = "SELECT idUtilisateur FROM utilisateur WHERE mail = :mail";
$stmt = $connection->prepare($sql);
$stmt->execute(['mail' => $_SESSION['email']]);
$result = $stmt->fetch();
$idUtilisateur = $result['idUtilisateur'];
$sql = "SELECT * FROM publication WHERE idUtilisateur = :idUtilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute(['idUtilisateur' => $idUtilisateur]);
$result = $stmt->fetchAll();
?>


<!-- Affichage des informations de l'utilisateur -->
<?php 
// on affiche la photo de profil, le pseudo et la biographie de l'utilisateur connecté
$sql = "SELECT pdp, pseudo, biographie, ville FROM utilisateur WHERE mail = :mail";
$stmt = $connection->prepare($sql);
$stmt->execute(['mail' => $_SESSION['email']]);
$result_info = $stmt->fetch();
$pdp = $result_info['pdp'];
$pseudo = $result_info['pseudo'];
$biographie = $result_info['biographie'];
$ville = $result_info['ville'];


// on affiche les informations avec possiblité de les modifier
?>
<form method="POST" enctype="multipart/form-data">
    <div class="col-12 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
        <div class="row-12 d-flex justify-content-center">
            <div class="m-3">
                <img id="pdp" src="<?php echo "../img/".$pdp ?>" alt="photo de profil">
                <a href="#" class="btn btn-custom" id="editButton">Edit</a>
                <div id="edit-overlay" style="display: none;">
                <input type="file" name="image" class="form-control input-login" id="image">
                </div>
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="input-group mb-3 username">
                <span class="input-group-text" id="basic-addon1">Pseudo</span>
                <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" value="<?php echo $pseudo ?>">
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="input-group mb-3 username">
                <span class="input-group-text" id="basic-addon1">Ville</span>
                <input type="text" name="ville" class="form-control" placeholder="Ville" value="<?php echo $ville ?>">
            </div>
        </div>
        <div class="row-12 mb-3 d-flex justify-content-center">
            <div class="input-group biographie">
                <span class="input-group-text">Biographie</span>
                <textarea class="form-control" name="biographie" aria-label="With textarea" placeholder="<?php echo $biographie ?>" value="<?php echo $biographie ?>"></textarea>
            </div>
        </div>
        <div class="row-12 mb-3 d-flex justify-content-center">
            <button type="submit" value="edit-profil" name="edit-profil" class="btn btn-custom-2">
                        Modifier votre profil
            </button>
        </div>
    </div>
</form>


<!-- Affichage des publications -->
<div class="col-12 d-flex justify-content-center">
<?php
foreach ($result as $row) {
    ?>
    <div class="col-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
        <div class="row-12">
            <div class="m-3">
                <h2 class="publication-title"><?php echo $row['title'] ?></h1>
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="m-3">
                <a href="<?php echo "http://".HOST."/ProjetAnnuel/src/publication/publication?id=".$row['idPublication'] ?>">
                    <img class="publication-image" src="../img/<?php echo $row['image'] ?>" alt="publication">
                </a>
                </div>
        </div>
        <div class="row-12">
            <div class="m-3">
                <p class="publication-description"><?php echo $row['description'] ?></h2>
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="m-3">
                <p class="publication-date"><?php echo explode(" ", $row['date_contenu'])[0] ?></h2>
            </div>
        </div>
        <!-- créer le bouton delete -->
        <div class="row-12 d-flex float-end">
            <div class="m-3">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['idPublication'] ?>">
                    <input type="submit" name="delete" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
    <?php
}


?>
</div>


<script>

const addButton = document.getElementById('editButton');

// Récupérer l'overlay par son ID
const overlay = document.getElementById('edit-overlay');

// Fonction pour afficher l'overlay lors du clic sur le bouton
addButton.addEventListener('click', function() {
    overlay.style.display = 'block';
});

</script>