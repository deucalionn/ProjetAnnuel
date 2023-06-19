<?php

  session_start();
  require "../../core/function.php";
  include "../../template/header.php";
  $pdo = connectDB();

  if($_SESSION["login"]!=1){
      header("Location: ../../login/login.php");
  }
  // recupere l'id via l'email
  $queryPrepared = $pdo->prepare('SELECT idUtilisateur FROM utilisateur where mail=:mail');
  $queryPrepared->execute([
      "mail"=>$_SESSION["email"]
  ]);
  $userid=$queryPrepared->fetch()["idUtilisateur"];

  $queryPrepared = $pdo->prepare("SELECT AVATAR FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
  $queryPrepared->execute(["idUtilisateur"=>$userid]);
  $avatar_str=$queryPrepared->fetch();
  list($head,$hair,$eyes,$accessories)=explode(",",$avatar_str[0]);
?>
<div class="col-12 d-flex justify-content-center">
    <row>
        <canvas id="canvas" style="border:5px solid #000000;" class="" value=<?php 
            $queryPrepared = $pdo->prepare("SELECT AVATAR FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
            $queryPrepared->execute(["idUtilisateur"=>$userid]);
            $alt=$queryPrepared->fetch();
            echo $queryPrepared->errorInfo()[2];
            echo($alt[0]);
        ?>></canvas>
    </row>
    <row>
        <a class="btn btn-secondary" href="avatar_modify.php">Edit</a>
    </row>
</div>
<script src="avatar.js"></script>
