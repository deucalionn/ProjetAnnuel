<?php
  session_start();
  require "../../core/function.php";
  include "../../template/header.php";
  if($_SESSION["login"]!=1){
        header("Location: ../../login/login.php");
    }
    
?>



 <?php
$pdo = connectDB();

    // recupere l'id utilisateur via l'email
    $queryPrepared = $pdo->prepare('SELECT idUtilisateur FROM utilisateur where mail=:mail');
    $queryPrepared->execute([
        "mail"=>$_SESSION["email"]
    ]);
    $userid=$queryPrepared->fetch()["idUtilisateur"];
?>

  <body>



    <div class="row">
        <div class="col-lg-12">
            <div class="row " >    
                <div class="d-flex justify-content-center" >    
                    <canvas id="canvas" style="border:5px solid #000000;max-height: 200px;max-width: 200px;" ></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-ls-2">
                    <button onclick="head1();" class="btn btn-primary m-2 button">-></button><br>
                    <button onclick="hair1();" class="btn btn-primary m-2 button">-></button><br>
                    <button onclick="eyes1();" class="btn btn-primary m-2 button">-></button><br>
                    <button onclick="accessories1();" class="btn btn-primary m-2 button">-></button><br>
                    <button onclick="accessories1();eyes1();hair1();head1();" class="btn btn-primary m-2 button">+1</button>
                </div>
                <?php     
                    $pdo = connectDB();
                    $queryPrepared = $pdo->prepare("SELECT AVATAR FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
                    $queryPrepared->execute(["idUtilisateur"=>$userid]);
                    $avatar_str=$queryPrepared->fetch();
                    echo $queryPrepared->errorInfo()[2];  
                    list($head,$hair,$eyes,$accessories)=explode(",",$avatar_str[0]);

                        ?>
                <div class="col-ls-3 mx-2">
                    <form method="POST" action="avatar_add.php" id="form" > 
                        <input type="text" name="head" id="headDisp" class="my-3" style="width:20px;" value="<?php     
                                echo($head);
                        ?>" readonly> </input><br>
                        <input type="text" name="hair" id="hairDisp" class="my-1" style="width:20px;" value="<?php 
                                echo($hair);
                        ?>" readonly> </input><br>
                        <input type="text" name="eyes" id="eyesDisp" class="my-3" style="width:20px;" value="<?php 
                                echo($eyes);
                        ?>" readonly> </input><br> 
                        <input type="text" name="accessories" id="accessoriesDisp" class="my-1" style="width:20px;" value="<?php 
                                echo($accessories);
                        ?>" readonly> </input><br>

                    <button type="submit" class="btn btn-warning text-center my-3" id="submit">Enregistrer</button>
                    </form>
                </div>
                <div class="col-ls-2">
                    
                    <button onclick="head0();" class="btn btn-primary m-2 button"><-</button><br>
                    <button onclick="hair0();" class="btn btn-primary m-2 button"><-</button><br>
                    <button onclick="eyes0();" class="btn btn-primary m-2 button"><-</button><br>
                    <button onclick="accessories0();" class="btn btn-primary m-2 button"><-</button><br>
                    <button onclick="head0();hair0();eyes0();accessories0();" class="btn btn-primary m-2 button">-1</button>
                </div>
            </div>
        </div>
        

        

    </div>
    <!--<div class="hidden"><?php  echo '<div name="head" id="$idTete"></div> ' ?></div>-->



    <?php include "../../template/footer.php"; ?>

<script src="avatar_modify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
