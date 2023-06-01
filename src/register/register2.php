<?php  session_start()?>
<?php include "../template/header_register.php" ?>
<?php


if (empty($_SESSION['info']["lastname"])
|| empty($_SESSION['info']["firstname"])
|| empty($_SESSION['info']["email"])
|| empty($_SESSION['info']["gender"])
|| empty($_SESSION['info']['dateNaissance'])
|| empty($_SESSION['info']['ville'])
|| empty($_SESSION['info']['username']))
{
header('Location: register.php');
exit();
}




if(!empty($_SESSION['errors'])){
    ?>
    

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <?php 
               foreach($_SESSION['errors'] as $error){
                   echo "<li>".$error."</li>";
               }
           ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>

<?php
   unset($_SESSION['errors']);
}



if (isset($_POST['next'])) {
    foreach ($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);

    $pwd = $_SESSION['info']['password'];
    $pwdConfirm = $_SESSION['info']['password-confirm'];
    if ($pwd != $pwdConfirm){
        $_SESSION['errors'] = ["Les mots de passes ne se correspondent pas."];
        header('Location: register2.php');
    }
    else {
        header('Location: register3.php');
    }

    if (in_array('next', $keys)){
        unset($_SESSION['info']['next']);
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
                    <h1><b>Etape 2</b></h1>
                </div>
            <div class="col-md-7 offset-md-3">
                <form method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password-confirm" class="form-control" id="password-confirm" placeholder="Confirmez">
                    </div>
                    <button type="submit" name="next" value="next" class="btn btn-custom btn-block">Next</button>
                    <a href="register.php">Précédent</a>
                </form>
            </div>
        </div>
    </div>
</div>