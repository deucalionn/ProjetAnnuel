<?php
session_start();
include "template/header.php";

if(empty($_SESSION['login'])){
    header('Location: login/login.php');

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
                    <form method="POST">
                            <div class="mb-2">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="title" class="form-control input-login" id="title">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control input-login" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control input-login" id="image">
                            </div>
                            <button type="submit" value="publie" class="btn btn-custom">Publier</button>
                    </form>
                </div>
            </div>
        </div>
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
</script>






