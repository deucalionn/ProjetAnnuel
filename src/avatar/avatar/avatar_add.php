<?php
	session_start();
	require "../../core/function.php";

    if($_SESSION["login"]!=1){
        header("Location: ../../login/login.php");
    }
    
    if(
        empty($_POST["head"]) ||
        empty($_POST["hair"]) ||
        empty($_POST["eyes"]) ||
        empty($_POST["accessories"]) ||
        empty($_SESSION["email"])
    ){
        header("Location: error.php");
        die("error");
    }
    // avoir l'id de l'utilisateur via l'email
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare('SELECT idUtilisateur FROM utilisateur where mail=:mail');
    $queryPrepared->execute([
        "mail"=>$_SESSION["email"]
    ]);
    $userid=$queryPrepared->fetch()["idUtilisateur"];


    $change[0]=$_POST["head"];
    $change[1]=$_POST["hair"];
    $change[2]=$_POST["eyes"];
    $change[3]=$_POST["accessories"];
    $update=implode(",",$change);


    $queryPrepared = $pdo->prepare('UPDATE utilisateur set AVATAR = :update where idUtilisateur=:idUtilisateur'); 
    $queryPrepared->execute([
        "update"=>$update,
        "idUtilisateur"=>$userid
    ]);
    
    header("Location: avatar_modify.php");
