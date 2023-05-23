<?session_start();?>

<?php require "conf.inc.php" ?>
<?php require "core/functions.php" ?>
<?php include "template/header.php" ?>

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

				

				<form action="core/registerUser.php" method="POST">
					<div class="row mb-4">
						<div class="col-md-4">
							<input class="form-control" class="form-control" type="text" name="code" id="code" placeholder="Code" required="required">
						</div>
					</div>			
					<div class="row">
						<div class="col-md-12 text-center">
							<label>
								<button class="btn btn-primary mb-4">Valider</button>
							</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>