<?php
	include_once('../controllers/UsersController.php');
	include_once('../views/includes/header.php');
	include_once('../app/classes/Session.php');
	if (isset($_POST['submit'])) {
		$newUser = new UsersController();
		$newUser->addUser();
	}
?>
	<script type="text/javascript">
		function testPassword1(){
	    var p1 = document.getElementById("Motpass1").value;
	    var p2 = document.getElementById("ConfirmMotpass1").value;
	    if( p1 != p2){
	        document.getElementById("btnsubmit1").style.backgroundColor = "red";
	        document.getElementById("btnsubmit1").disabled = true;
	        document.getElementById("btnsubmit1").style.cursor = "not-allowed";
	        document.getElementById("error_pasword1").innerText = "Error Mot De Pass";
	    }else{
	        document.getElementById("btnsubmit1").style.backgroundColor = "#f9ca24";
	        document.getElementById("btnsubmit1").disabled = false;
	        document.getElementById("btnsubmit1").style.cursor = "pointer";
	        document.getElementById("error_pasword1").innerText = "";
	    }
	}
	function testPassword2(){
	    var p1 = document.getElementById("Motpass2").value;
	    var p2 = document.getElementById("ConfirmMotpass2").value;
	    if( p1 != p2){
	        document.getElementById("btnsubmit2").style.backgroundColor = "red";
	        document.getElementById("btnsubmit2").disabled = true;
	        document.getElementById("btnsubmit2").style.cursor = "not-allowed";
	        document.getElementById("error_pasword2").innerText = "Error Mot De Pass";
	    }else{
	        document.getElementById("btnsubmit2").style.backgroundColor = "yellow";
	        document.getElementById("btnsubmit2").disabled = false;
	        document.getElementById("btnsubmit2").style.cursor = "pointer";
	        document.getElementById("error_pasword2").innerText = "";
	    }
	}
	</script>
	<link rel="stylesheet" href="../public/css/style_inscription.css">
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
    <div>
		<div class="row my-4 p-5">
			<div class="col-md-8 mx-auto">
				<div class="card">
					<div class="card-body bg-light">
						<a href="index.php" class="btn btn-sm btn-secondary mr-2 mb-2" ><i class="fas fa-home" ></i></a>
						<form class="my-3 mx-md-5" method='POST'>
							<h2 class="text-secondary" >Inscription</h2><br> 
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="text"  class="text-secondary text_content_foat_left">Nom :</label>
									<input type="text" name="nom" class="form-control" id="firstName" placeholder="First name" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="text" class="text-secondary text_content_foat_left">Prenom :</label>
									<input type="text" name="prenom" class="form-control" id="lastName" placeholder="Last name" required>
								</div>
							</div><br>
							<div class="mb-3">
								<label for="text" class="text-secondary text_content_foat_left">Email :</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
							</div><br>

							<!-- password -->
							<div class="mb-3">
								<label for="text" class="text-secondary text_content_foat_left">Mot De Pass :</label>
								<input type="password" name="Motpass" class="form-control" id="Motpass2" placeholder="you@example.com" onkeyup="testPassword2()" required>
							</div><br>
							<div class="mb-3">
								<label for="text" class="text-secondary text_content_foat_left">Confermer Le Mot De Pass :</label>
								<input type="password" name="ConfirmMotpass" class="form-control" id="ConfirmMotpass2" placeholder="you@example.com" onkeyup="testPassword2()" required>
							</div>
							<h2 id="error_pasword2"></h2><br>

							<hr class="mb-4">
							<button class="btn btn-outline-success btn-lg btn-block" type="submit"  name="submit" id="btnsubmit2">Inscription</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
	include_once('../views/includes/footer.php');
?>
