<?php
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
                Mes Amis
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


