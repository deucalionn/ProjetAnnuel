<?php include "template/header.php" ?>
<?php  session_start() ?>
<?php



if (isset($_POST['next'])) {
    foreach ($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);

    if (in_array('next', $keys)){
        unset($_SESSION['info']['next']);
    }

    header('Location: register3.php');
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
                    <h1><b>Etape 2</b></h1>
                </div>
            <div class="col-md-7 offset-md-3">
                <form method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Mot de passe">
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