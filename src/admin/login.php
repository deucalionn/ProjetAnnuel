<?php 
include "../template/header.php";
include "../core/function.php";
session_start(); ?>


<?php
    if(!empty($_SESSION['error'])){
        ?>
        <div class="container">
        <div class="row">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                    foreach($_SESSION['error'] as $error){
                        echo "<li>".$error."</li>";
                    }
                ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
        </div>
        </div>

    <?php
    unset($_SESSION['error']);
    }


    if(!empty($_POST["email"]) &&  !empty($_POST["password"])) {

        $email = cleanEmail($_POST["email"]);
        $pwd = $_POST['password'];

        $connect = connectDB();
        $queryPrepared = $connect->prepare("SELECT pwd FROM admin_users WHERE email=:email");
        $queryPrepared->execute(["email"=>$email]);
        $result = $queryPrepared->fetch();

        if(empty($result)){
            $_SESSION['error'] = ["Indentifiants incorrects"];
            header("Location: login.php");
        }else if(password_verify($pwd, $result["pwd"])){
            $_SESSION['email'] =$email;
            $_SESSION['admin_login'] =1;
            header("Location: index.php");
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
                    <h1><b>ADMIN login</b></h1>
                </div>
            <div class="col-md-6 offset-md-3">
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control input-login" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control input-login" id="password">
                    </div>
                    <button type="submit" class="btn btn-custom">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
