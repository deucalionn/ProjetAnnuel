<?php include "template/header.php" ?>
<?php include "core/function.php" ?>
<?php  session_start() ?>

<?php
    if (isset($_SESSION['error'])){
        ?>
        <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error'] ?>
        </div>
    <?php
    unset($_SESSION['errors']);
    }
?>

<?php



if (verifIfEmailExist($_SESSION['email'] == 1)){
    $_SESSION['error'] = "l'email est déjà utilisé";
    header('Location: register.php');

}


if (isset($_POST['next'])) {
    foreach ($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);
    if ( count($_POST) == 5 ){
        if (in_array('next', $keys)){
            unset($_SESSION['info']['next']);
        }
    
        if (in_array('email', $keys)){
            $_SESSION['info']['email'] = cleanEmail($_SESSION['info']['email']);
        }
    
        header('Location: register2.php');
    }
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
                    <h1><b>Etape 1</b></h1>
                </div>
            <div class="col-md-7 offset-md-3">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" 
                            placeholder="Nom d'utilisateur" name="username"  required="required" value="<?= isset($_SESSION['info']['username']) ? $_SESSION['info']['lastname'] : ''  ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="lastname" placeholder="Nom" name="lastname" required="required" value="<?= isset($_SESSION['info']['lastname']) ? $_SESSION['info']['lastname'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="firstname" placeholder="Prénom" name="name"  required="required" value="<?= isset($_SESSION['info']['name']) ? $_SESSION['info']['name'] : ''?>">
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