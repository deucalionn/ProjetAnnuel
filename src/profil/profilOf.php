<?php 
include "../template/header.php";
include_once('../core/function.php');
// code qui affiche le profil d'un utilisateur
// on récupère l'id de l'utilisateur
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
<div class="row-12 d-flex justifiy-content-center info-profil">
    <div class="col-12">
        <div class="row-12">
            <!-- Affichage des informations de l'utilisateur -->
            <div class="col-12">
                <div class="row-12">
                    <div class="mt-3 d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img id="pdp" src="../img/<?php echo $result['pdp'] ?>" alt="publication" class="img-fluid">
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
</div>
<div class="row-12">
<!-- Affichage des publications de l'utilisateur -->
<div class="col-12">
    <div class="row">
        <div class="col-12">
            <h2>Publications</h2>
        </div>
    </div>
    <div class="row-12">
        <?php foreach ($result_publication as $publication) { ?>
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <h4 class="title-publication-on-profil"><?php echo $publication['title'] ?></h3>
                    </div>
                    <div class="col-12">
                        <img src="../img/<?php echo $publication['image'] ?>" alt="publication" class="img-fluid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><?php echo $publication['description'] ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>