<?php include "../template/header_register.php" ?>
<?php  session_start() ?>
<?php
require "../conf.inc.php";
require "../core/function.php";



if (empty($_SESSION['info']["lastname"])
|| empty($_SESSION['info']["firstname"])
|| empty($_SESSION['info']["email"])
|| empty($_SESSION['info']["password"])
|| empty($_SESSION['info']["password-confirm"])
|| empty($_SESSION['info']["gender"])
|| empty($_SESSION['info']['dateNaissance'])
|| empty($_SESSION['info']['ville'])
|| empty($_SESSION['info']['username']))
{
header('Location: register.php');
exit();
}


?>


<script>
function start(e){
    e.dataTransfer.effectAllowed="move"; // effet de deplacement, donc lors du deplacement il va quitté son parent vers son nouveau parent
    e.dataTransfer.setData("text", e.target.getAttribute("id"));
}

function over(e){
    return false;
}


function drop(e){
    ob = e.dataTransfer.getData("text");
    e.currentTarget.appendChild(document.getElementById(ob));
    e.stopPropagation();
    return false;
}

</script>




<div class="row">
    <div class="col-6" id="left-home-side">
        <div class="d-flex align-items-center h-100 justify-content-end">
            <div class="row not-posed" ondragstart="start(event)" ondragover="return over(event)" ondrop="return drop(event)">
                <?php
                // Chemin vers le dossier contenant les photos
                $dir = '../img/captcha';

                // Liste des fichiers dans le dossier
                $files = scandir($dir);

                // Supprime les fichiers . et ..
                unset($files[0], $files[1]);

                // Mélange la liste des fichiers
                shuffle($files);
                // Initialise un compteur pour les images
                $i = 0;

                // Boucle sur les images
                foreach ($files as $file) {
                    echo '<img class="captcha" id="'.$i.'" src="' . $dir . '/' . $file . '" alt="' . $file . '" draggable="true">';
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-6" id="right-home-side">
        <div class="d-flex align-items-center h-100">
            <div class="col-md-7">
                <div class="row posed" ondragstart="start(event)" ondragover="return over(event)" ondrop="return drop(event)"></div>
            </div>
        </div>
    </div>
</div>

<script>
// Sélectionne la div qui contient les images "posed"
let posedDiv = document.querySelector(".posed");

// Ajoute un écouteur d'événement pour détecter lorsque 6 images ont été placées dans posed
posedDiv.addEventListener("DOMNodeInserted", function(event) {
  // Vérifie si la div posed contient 6 images
  if (posedDiv.children.length === 6) {
    // Récupère les attributs "alt" des 6 images et les stocke dans un tableau
    let altArray = [];
    for (let i = 0; i < posedDiv.children.length; i++) {
    altArray.push(posedDiv.children[i].getAttribute("alt"));
    }
    console.log(altArray);

    // Utilise JSON.stringify() pour transformer l'array en JSON
    let jsonAltArray = JSON.stringify(altArray);

    // Envoie les attributs "alt" au serveur en utilisant fetch()
    fetch("verif_captcha.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    credentials: 'include',
    body: jsonAltArray
    })
    .then(response => {
        console.log(response);
        if (response.status == 200){
            window.location.href = "http://localhost/ProjetAnnuel/src/register/final.php";
        }
        if (!response.ok) {
            throw new Error("Erreur lors de l'envoi des données au serveur");
        }

        return response.json();
        })
    .then(data => {
        console.log(data); // Affiche la réponse du serveur si besoin
    })
    .catch(error => {
        console.error(error);
    });

  }
});

</script>