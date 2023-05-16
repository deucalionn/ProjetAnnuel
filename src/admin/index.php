<?php

session_start();

if(empty($_SESSION['admin_login'])){
    header("Location: ../login/login.php");
}


?>