<?php
session_start();
include "template/header.php";
include "core/function.php";

if(empty($_SESSION['login'])){
    header('Location: login/login.php');

}


if (isset($_SESSION['action'])) {
    foreach ($_SESSION['action'] as $action) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        ".$action."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    unset($_SESSION['action']);
}

function createPublication($title, $image, $description, $localisation){
	$connection = connectDB();
	$queryPrepared = $connection->prepare("SELECT idUtilisateur FROM ".DB_PREFIX."utilisateur WHERE mail=:mail");
	$queryPrepared->execute([
		"mail"=>$_SESSION["email"]
	]);
	$result = $queryPrepared->fetch();
	$id_utilisateur = $result["idUtilisateur"];
	$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."publication (title, image, description, localisation, idUtilisateur) VALUES (:title, :image, :description, :localisation, :idUtilisateur)");
	$queryPrepared->execute([
		"title"=>$title,
		"image"=>$image,
		"description"=>$description,
        "localisation"=>$localisation,
		"idUtilisateur"=>$id_utilisateur
	]);
    $_SESSION['action'] = ["Publication créée"];
    //echo $queryPrepared->errorInfo()[2];
    header('Location: index.php');
    exit();
}




if (isset($_POST['publie'])) {
    $uploadDir = 'img/'; // Spécifiez le répertoire de destination
    $fileName = $_FILES['image']['name'];
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $localisation = $_POST['localisation'];
        createPublication($title, $image, $description, $localisation);
    }
    else{
        $_SESSION['action'] = ["Erreur lors de l'upload de l'image"];
        header('Location: index.php');
    }

}



?>
<div class="row p-4 content-fluid grid gap-3">
    
    <div class="col-3 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded"">
        <div class="d-flex justify-content-center">
            Evenement
        </div>
    </div>
    
    <div class="col-5 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center">
                Proche de moi
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-custom" id="addButton">+</a>
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-center">
                Mes Amis
                </div>
            </div>
        </div>
        <div id="overlay" style="display: none;">
            <!-- Contenu de l'overlay -->
            <div class="overlay-content">
                <!-- Ajoutez ici le contenu de l'overlay -->
                <div class="col-md-6 offset-md-3">
                    <form method="POST" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="title" class="form-control input-login" id="title" required>
                            </div>
                            <div class="mb-2">
                                <label for="localisation" class="form-label">Localisation</label>
                                <input type="text" name="localisation" class="form-control input-login" id="localisation" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control input-login" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control input-login" id="image" required>
                            </div>
                            <button type="submit" name="publie" value="publie" class="btn btn-custom">Publier</button>
                    </form>
                </div>
            </div>
        </div>
    <!-- on affiche les publications ou la localisation de cette dernière est égale à celle de l'utilisateur connecté -->
    <?php
        $connection = connectDB();
        $queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."publication WHERE localisation = (SELECT ville FROM ".DB_PREFIX."utilisateur WHERE mail=:mail)");
        $queryPrepared->execute([
            "mail"=>$_SESSION["email"]
        ]);
        $result = $queryPrepared->fetchAll();
        foreach ($result as $row) {
            // on recuperer le pseudo de l'utilisateur qui a publié et son image de profil
            $queryPrepared = $connection->prepare("SELECT pseudo, pdp FROM ".DB_PREFIX."utilisateur WHERE idUtilisateur=:idUtilisateur");
            $queryPrepared->execute([
                "idUtilisateur"=>$row["idUtilisateur"]
            ]);
            $result2 = $queryPrepared->fetch();
            $pseudo = $result2["pseudo"];
            $pdp = $result2["pdp"];

            // on recupere le nombre de like de la publication
            $queryPrepared = $connection->prepare("SELECT COUNT(*)  FROM ".DB_PREFIX."likes WHERE idPublication=:idPublication");
            $queryPrepared->execute([
                "idPublication"=>$row["idPublication"]
            ]);

            $result3 = $queryPrepared->fetch();
            $result3 = $result3[0];




            ?>
            <div class="col-12 mt-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
                <div class="mt-3 d-flex align-items-center" style="margin-left: 10%;">
                    <div class="flex-shrink-0">
                        <img class="publication-owner-image-flux "src="img/<?php echo $pdp?>" alt="photo de profil">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p><a href="<?php echo "profil/profilOf.php?id=".$row['idUtilisateur']?>"><?php echo $pseudo?></a></p>
                    </div>
                </div>
                <div class="row-12">
                    <div class="m-3">
                        <h3 class="publication-title-flux"><?php echo $row['title'] ?></h1>
                    </div>
                </div>
                <div class="row-12 d-flex justify-content-center">
                    <div class="mt-2">
                        <img class="publication-image-flux" src="img/<?php echo $row['image'] ?>" alt="photo">
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center" style="margin-left: 10%;">
                    <div class="flex-shrink-0">
                        <img class="publication-like-icon" src="img/like_button.png" alt="like" onclick="<?php echo "like(".$row['idPublication'].",".$row['idUtilisateur'].")"?>">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="publication-like-text" id="<?php echo "like".$row['idPublication'] ?>"><?php echo $result3 ?> </p>
                    </div>
                </div>
                <div class="row-12">
                    <div class="m-3">
                        <p class="publication-description-flux"><?php echo $row['description'] ?></p>
                    </div>
                </div>
                <div class="row-12 d-flex justify-content-center">
                    <div class="m-3">
                        <p class="publication-date-flux"><?php echo explode(" ", $row['date_contenu'])[0] ?></h2>
                    </div>
                </div>
            </div>

        <?php }?>
</div>



    <div class="col-3 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
        <div class="d-flex justify-content-center">
            Messagerie
        </div>
    </div>

</div>

<div class="row p-4 container-fluid gap-1">
   
        <div class="col-3 p-3 bg-dark-subtle bg-opacity-10 border border-dark-subtle rounded">
            <div class="d-flex justify-content-center">
                Annonce
            </div>
        </div>
</div>



<script>
    // Récupérer le bouton "+" par son ID
    const addButton = document.getElementById('addButton');

    // Récupérer l'overlay par son ID
    const overlay = document.getElementById('overlay');

    // Fonction pour afficher l'overlay lors du clic sur le bouton
    addButton.addEventListener('click', function() {
        overlay.style.display = 'block';
    });



    // si on clique sur l'image de like alors on ajoute un like à la publication
    // on recupere l'id de la publication
    // on envoie une requete ajax pour ajouter un like à la publication
    function like(idPublication, idUtilisateur){
        console.log(idPublication);
        console.log(idUtilisateur);
        $.ajax({
            url: "core/like.php",
            type: "POST",
            data: {
                idPublication: idPublication,
                idUtilisateur: idUtilisateur,

            },
            success: function (response) {
                var data = JSON.parse(response);
                // on augmente le nombre de like de la publicationù
                console.log(data);
                if (data.status == "error"){
                    return 0;
                }
                else {var like = document.getElementById("like"+idPublication);
                like.innerHTML = parseInt(like.innerHTML) + 1;}
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //console.log(textStatus, errorThrown);
            }
        });
    }
</script>






