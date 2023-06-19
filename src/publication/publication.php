<?php 
session_start();
include "../template/header.php";
include "../core/function.php";

// code pour voir une publication en particulier
// on récupère l'id de la publication
if (empty($_GET['id'])){
    header('Location: ../index.php');
    exit();
}
$idPublication = $_GET['id'];
$connection = connectDB();
// on récupère les informations de la publication
$sql = "SELECT * FROM publication WHERE idPublication = :idPublication";
$stmt = $connection->prepare($sql);
$stmt->execute(['idPublication' => $idPublication]);
$result = $stmt->fetch();
$titre = $result['title'];
$description = $result['description'];
$photo = $result['image'];
$localisation = $result['localisation'];
$date = $result['date_contenu'];
// on récupère les informations de l'utilisateur qui a publié
$sql = "SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute(['idUtilisateur' => $result['idUtilisateur']]);
$result_utilisateur = $stmt->fetch();
$pseudo = $result_utilisateur['pseudo'];
$pdp = $result_utilisateur['pdp'];


$queryPrepared = $connection->prepare("SELECT COUNT(*)  FROM ".DB_PREFIX."likes WHERE idPublication=:idPublication");
            $queryPrepared->execute([
                "idPublication"=>$idPublication
            ]);

            $result3 = $queryPrepared->fetch();
            $result3 = $result3[0];

// on récupère les commentaires de la publication
// pour plus tard 
?>

<row class="d-flex justify-content-center">
    <div class="col-6 mt bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
        <div class="mt-3 d-flex align-items-center" style="margin-left: 10%;">
            <div class="flex-shrink-0">
                <img class="publication-owner-image-flux "src="../img/<?php echo $pdp?>" alt="photo de profil">
            </div>
            <div class="flex-grow-1 ms-3">
                <p><a href="<?php echo "../profil/profilOf.php?id=".$result['idUtilisateur']?>"><?php echo $pseudo?></a></p>
            </div>
        </div>
        <div class="row-12">
            <div class="m-3">
                <h3 class="publication-title-flux"><?php echo $titre ?></h1>
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="mt-2">
                <img class="publication-image-flux" src="../img/<?php echo $photo ?>" alt="photo">
            </div>
        </div>
        <div class="mt-3 d-flex align-items-center" style="margin-left: 10%;">
            <div class="flex-shrink-0">
                <img class="publication-like-icon" src="../img/like_button.png" alt="like" onclick="<?php echo "like(".$idPublication.",".$result["idUtilisateur"].")"?>">
            </div>
            <div class="flex-grow-1 ms-3">
                <p class="publication-like-text" id="<?php echo "like".$idPublication ?>"><?php echo $result3 ?> </p>
            </div>
        </div>
        <div class="row-12">
            <div class="m-3">
                <p class="publication-description-flux"><?php echo $description ?></p>
            </div>
        </div>
        <div class="row-12 d-flex justify-content-center">
            <div class="m-3">
                <p class="publication-date-flux"><?php echo explode(" ", $date)[0] ?></h2>
            </div>
        </div>
    </div>
</div>




