<?php include "template/header.php" ?>
<?php  session_start() ?>
<?php
require "conf.inc.php";
require "core/function.php";


if (isset($_POST['submit'])) {
    foreach ($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);
    
    # créer la requete de register
    $lastname = $_SESSION['lastname'];
    $firstname = $_SESSION['firstname'];
    $email = $_SESSION['email'];
    $pwd = $_SESSION['password'];
    $pwdConfirm = $_SESSION['password-confirm'];
    print_r($_SESSION['info']);
    $listOfErrors = [];
    
}

?>






















<div class="row">
    <div class="col-6" id="left-home-side">
        <div class="d-flex align-items-center h-100 justify-content-end">
            <div class="row">
                <img src="img/iphone_white.jpg" class="w-250 h-auto">
            </div>
        </div>
    </div>
    <div class="col-6" id="right-home-side">
        <div class="d-flex align-items-center h-100">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1><b>FINITO</b></h1>
                </div>
            <div class="col-md-7 offset-md-3">
                <form>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Choisir une photo de profil</label>
                        <input class="form-control form-control" id="formFile" type="file">
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom btn-block">Finito</button>
                    <a href="register2.php">Précédent</a>
                </form>
            </div>
        </div>
    </div>
</div>


