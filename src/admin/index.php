<?php
session_start();
include "../core/function.php";
if(empty($_SESSION['admin_login'])){
    header("Location: ../login/login.php");
}


// si il recoit desactive alors il désative le compte
if(isset($_POST['desactive'])){
    $connection = connectDB();
    $sql = "UPDATE utilisateur SET statut = -1 WHERE idUtilisateur = :idUtilisateur";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['idUtilisateur' => $_POST['idUtilisateur']]);
    header("Location: index.php");
}

// si il recoit active alors il active le compte
if(isset($_POST['active'])){
    $connection = connectDB();
    $sql = "UPDATE utilisateur SET statut = 1 WHERE idUtilisateur = :idUtilisateur";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['idUtilisateur' => $_POST['idUtilisateur']]);
    header("Location: index.php");
}

// si il recoit supprimer alors il supprime le compte
if(isset($_POST['delete'])){
    $connection = connectDB();
    $sql = "DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['idUtilisateur' => $_POST['idUtilisateur']]);
    header("Location: index.php");
}

include "../template/header.php";

// afficher les utilisateurs présent dans la base de données dans un tableau
$connection = connectDB();
$sql = "SELECT * FROM utilisateur";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();


?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Liste des utilisateurs</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">idUtilisateur</th>
                    <th scope="col">pseudo</th>
                    <th scope="col">mail</th>
                    <th scope="col">statut</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <?php foreach($result as $user){ ?>
                <tr>
                    <td><?php echo $user['idUtilisateur'] ?></td>
                    <td><?php echo $user['pseudo'] ?></td>
                    <td><?php echo $user['mail'] ?></td>
                    <td><?php echo $user['statut'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="idUtilisateur" value="<?php echo $user['idUtilisateur'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                            <button type="submit" name="<?php if($user['statut'] == 1){
                                echo "desactive";
                                } 
                            else{
                                echo "active";
                                }?>"
                                class="btn btn-warning"><?php 
                            if($user['statut'] == 1){
                                echo "Désactiver";
                                } 
                            else{
                                echo "Activer";
                                }?></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>