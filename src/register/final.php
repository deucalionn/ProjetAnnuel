<?session_start();?>

<?php require "../conf.inc.php" ?>
<?php require "../core/function.php" ?>
<?php include "../template/header.php" ?>

<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="row">
			<div class="col-12">
				<h1 class="m-4">Activer votre compte</h1>

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
			if(isset($_POST['valider'])){
				echo "okok";
				echo $_POST['codeInput'];
				echo $_SESSION['code'];
				if ($_POST['codeInput'] == $_SESSION['code'])
				{
					echo "ok";
					#compte activé
					$connection = connectDB();
					$sql = "UPDATE utilisateur SET statut = 1 WHERE mail = :mail";
					$email = $_SESSION['info']['email'];
					$queryPrepared = $connection->prepare($sql);
					$queryPrepared->execute([
						":mail" => $email
					]);
				}

			}
				?>
				 	
				<form method="POST">
					<div class="row mb-4">
						<div class="col-md-4">
							<input class="form-control" class="form-control" type="text" name="codeInput" id="code" placeholder="Code" required="required">
						</div>
					</div>
					<button type="submit" name="valider" value="valider" class="btn btn-primary mb-4">Valider</button>		
				</form>
			</div>
		</div>
	</div>
</div>