<?php 
session_start(); 
include "../template/header_register.php";
include "../core/function.php";?>


<?php
    if(isset($_SESSION['error'])){
        ?>
        
        <div class="row">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                    foreach($_SESSION['error'] as $error){
                        echo "<li>".$error."</li>";
                    }
                ?>
            </div>
        </div>

    <?php
    unset($_SESSION['error']);
    }

    if(!empty($_POST["email"]) &&  !empty($_POST["password"])) {

        $email = cleanEmail($_POST["email"]);
        $pwd = $_POST['password'];

        $connect = connectDB();
        $queryPrepared = $connect->prepare("SELECT pwd FROM utilisateur WHERE mail=:mail");
        $queryPrepared->execute(["mail"=>$email]);
        $result = $queryPrepared->fetch();

        if(empty($result)){
            $_SESSION['error'] = ["Indentifiants incorrects"];
            header("Location: login.php");
        }else if(password_verify($pwd, $result["pwd"])){
            # on verifie si le statut de l'utilisateur est 1
            $queryPrepared = $connect->prepare("SELECT statut FROM utilisateur WHERE mail=:mail");
            $queryPrepared->execute(["mail"=>$email]);
            $result = $queryPrepared->fetch();
            if($result["statut"] == -1){
                $_SESSION['error'] = ["Votre compte n'est pas encore validé"];
                header("Location: login.php");
                exit();
            }
            $_SESSION['email'] =$email;
            $_SESSION['login'] =1;
            header("Location: ../index.php");
        }else{
            $_SESSION['error'] = ["Indentifiants incorrects"];
            header("Location: login.php");
        }

    }



?>

<div class="row">
    <div class="col-6" id="left-home-side">
        <div class="d-flex align-items-center h-100 justify-content-end">
            <div class="row">
                <img src="../img/iphone_white.jpg" class="w-250 h-auto">
            </div>
        </div>
    </div>
    <div class="col-6" id="right-home-side">
        <div class="d-flex align-items-center h-100">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1><b>MEETRAVEL</b></h1>
                </div>
            <div class="col-md-6 offset-md-3">
            <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control input-login" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control input-login" id="password">
                    </div>
                    <button type="submit" class="btn btn-custom">Se connnecter</button>
                    <p class="mt-2">Vous n'avez pas de compte ? <a href="http://localhost/ProjetAnnuel/src/register/register.php">Inscrivez vous.</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
