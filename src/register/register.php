<?php include "../template/header_register.php" ?>
<?php include "../core/function.php" ?>
<?php  session_start(); ?>

<?php
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
?>

<?php






if (isset($_POST['next'])) {
    foreach ($_POST as $key => $value) {
        $_SESSION['info'][$key] = $value;
    }

    if(verifIfEmailExist($_SESSION['info']['email']) == 1){
        $_SESSION['errors'] = ["email déjà utilisée."];
        header('Location: register.php');
        exit();

    }

    if (isset($_SESSION['info']['email']) && isset($_SESSION['info']['lastname']) && isset($_SESSION['info']['firstname']) && isset($_SESSION['info']['username']) && isset($_SESSION['info']['gender']) && isset($_SESSION['info']['dateNaissance']) && isset($_SESSION['info']['ville'])) {
        if (in_array('next', array_keys($_SESSION['info']))) {
            unset($_SESSION['info']['next']);
        }

        header('Location: register2.php');
    } else {
        header('Location: register.php');
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
                    <h1><b>Etape 1</b></h1>
                </div>
            <div class="col-md-7 offset-md-3">
                <form method="POST">
                    <div class="form-group">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="gender">
                            <option value="1">Homme</option>
                            <option value="2">Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" 
                            placeholder="Nom d'utilisateur" name="username"  required="required" value="<?= isset($_SESSION['info']['username']) ? $_SESSION['info']['username'] : ''  ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="lastname" placeholder="Nom" name="lastname" required="required" value="<?= isset($_SESSION['info']['lastname']) ? $_SESSION['info']['lastname'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="firstname" placeholder="Prénom" name="firstname"  required="required" value="<?= isset($_SESSION['info']['firstname']) ? $_SESSION['info']['firstname'] : ''?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ville" placeholder="Ville" name="ville"  required="required" value="<?= isset($_SESSION['info']['ville']) ? $_SESSION['info']['ville'] : ''?>">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="<?= isset($_SESSION['info']['dateNaissance']) ? $_SESSION['info']['dateNaissance'] : ''?>">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"  required="required" value="<?= isset($_SESSION['info']['email']) ? $_SESSION['info']['email'] : ''?>">
                    </div>
                    <button type="submit" name="next" value="next" class="btn btn-custom btn-block">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>