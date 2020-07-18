<?php
	include_once('../controllers/UsersController.php');
	include_once('../views/includes/header.php');
	include_once('../app/classes/Session.php');
?>
<link rel="stylesheet" href="../public/css/style_login.css">
</head>
<body>

	<div class="container" id="alert_msg">
		<div class="row my-4">
			<div class="col-md-10 mx-auto">
				<?php include('../views/includes/alerts.php');?>
			</div>
		</div>
	</div>
	<div class="bg-image"></div>

<div class="bg-text">
    <!-- ------------------------ -->

    <div>
		<div class="container">
			<div class="row my-4">
				<div class="col-md-8 mx-auto">
					<div class="card" id="content_login">
						<div class="card-body bg-light">
							<a href="index.php" class="btn btn-sm btn-secondary mr-2 mb-2" ><i class="fas fa-home" ></i></a>
							<form class="my-3 mx-md-5" method='POST' action="sign_in.php">
				                <div class="mb-3">
				                    <label for="text" class="text-secondary text_content_foat_left">Email :</label>
									<input type="email" name="email" class="form-control" id="email" placeholder="Adresse e-mail" required>
				                </div><br>

				                <!-- password -->
				                <div class="mb-3">
				                    <label for="text" class="text-secondary text_content_foat_left">Mot De Pass :</label>
				                    <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" required>
				                </div><br>
				                <hr class="mb-4">
				                <button class="btn btn-outline-success btn-lg btn-block">Connexion</button>
                                <hr>
                                <a href="inscription.php" class="btn btn-warning">Créer un compte</a>
				            </form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- ------------------------ -->
</div>


<?php
	include_once('../views/includes/footer.php');
?>
