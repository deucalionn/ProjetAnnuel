<?php 
session_start();
include "../template/header.php";
include_once('../core/function.php');
// code qui affiche le profil d'un utilisateur
// on récupère l'id de l'utilisateur si il n'y en a pas alors on redirect sur index
if (empty($_GET['id'])){
    header('Location: ../index.php');
    exit();
}
$idUtilisateur = $_GET['id'];
$connection = connectDB();
// on récupère les informations de l'utilisateur
$sql = "SELECT pdp, pseudo, biographie, ville FROM utilisateur WHERE idUtilisateur = :idUtilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute(['idUtilisateur' => $idUtilisateur]);
$result = $stmt->fetch();
$pdp = $result['pdp'];
$pseudo = $result['pseudo'];
$biographie = $result['biographie'];
$ville = $result['ville'];
// on récupère les publications de l'utilisateur
$sql = "SELECT * FROM publication WHERE idUtilisateur = :idUtilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute(['idUtilisateur' => $idUtilisateur]);
$result_publication = $stmt->fetchAll();


// on affiche les informations de l'utilisateur


?>
<div class="row d-flex justifiy-content-center info-profil">
    <div class="col-12">
        <div class="row">
            <!-- Affichage des informations de l'utilisateur -->
            <div class="col-12">
                <div class="row-12">
                    <div class="mt-3 d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img id="pdp" src="../img/<?php echo $result['pdp'] ?>" alt="pdp" class="publication-image-flux">
                        </div>
                        <div class="flex-shrink-0">
                        <canvas id="canvas" style="border:3px solid #000000;" class="" value=<?php 
                            $queryPrepared = $connection->prepare("SELECT AVATAR FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
                            $queryPrepared->execute(["idUtilisateur"=>$idUtilisateur]);
                            $alt=$queryPrepared->fetch();
                            echo($alt[0]);
                        ?>></canvas>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p><a class="pseudo" href="<?php echo "profil/profilOf.php?id=".$idUtilisateur?>"><?php echo $pseudo?></a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="localisation-text"><?php echo "Localisation: ".$ville ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><?php echo $biographie ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
<!-- Affichage des publications de l'utilisateur -->
    <?php foreach ($result_publication as $publication) { ?>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <h4 class="title-publication-on-profil"><?php echo $publication['title'] ?></h3>
                </div>
                <div class="col-12">
                    <a href="<?php echo "http://".HOST."/ProjetAnnuel/src/publication/publication?id=".$publication['idPublication'] ?>">
                        <img src="../img/<?php echo $publication['image'] ?>" alt="publication" class="publication-image-flux">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="publication-description-flux"><?php echo $publication['description'] ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script src="../avatar/avatar/avatar.js"></script>