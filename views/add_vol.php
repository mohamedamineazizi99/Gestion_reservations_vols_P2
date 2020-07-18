<?php
	include_once('../controllers/VolsController.php');
	include_once('../views/includes/header.php');
	include_once('../app/classes/Session.php');
	if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }
    else if ($_SESSION['statut'] != 'Admin') {
    	Redirect::to('index');
    }
	if (isset($_POST['submit'])) {
		$newVol = new VolsController();
		$newVol->addVol();
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
	<style>
            .chois_name{
                border: none;
                padding: 2px 40px;
                border-radius: 10px;
                -moz-box-shadow: -5px 18px 54px 29px rgba(127,140,141,1);
                -webkit-box-shadow: -7px 2px 12px 14px rgba(127,140,141,0.99);
                -moz-box-shadow: -7px 2px 12px 14px rgba(127,140,141,0.99);
                box-shadow: 0px 2px 7px 8px rgba(127,140,141,0.99);
                background-color: white;
                margin-left: 30px;
                outline: none;
                color: #C13584;
            }
            .chois_name:hover{
                background-color: #C13584;
                color: white;
            }
        </style>
        <script>
            function choix_vol_famille(){
                document.getElementById("nam_voll").value = "Voyage en famille";
            }
            function choix_vol_travel(){
                document.getElementById("nam_voll").value = "Voyage de travel";
            }
        </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav_header">
        <a class="navbar-brand" href="index.php">T-aér</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="profil_admin.php">Profil</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a href="<?php echo "../controllers/LogOut.php" ?>" class="btn btn-info p-2"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
            </div>
        </div>
    </nav>
    <!-- --------------------------- -->
    <section class="jumbotron p-4">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                <center>
                    <?php
                        echo '<h3 class="ml-4 float-right my-0 p-3"> Bienvenue Admin :' . $_SESSION['nameUser'] . ' ' . $_SESSION['prenomUser'] .'</h3>';
                    ?>
                </center>
                </div>
            </div>
        </div>
    </section>
    <!-- --------------------------- -->

	<div class="container">
		<div class="row my-4">
			<div class="col-md-10 mx-auto">
				<?php include('../views/includes/alerts.php');?>
			</div>
		</div>
	</div>
	 <!-- start container form -->
        <div class="container shadow-lg p-3 mt-5 mb-5 bg-white rounded">
            <h1 class="text-center mt-5">Ajouter un nouveau vol</h1>
            <div class="row mb-5 mt-5">
                <div class="col-md-1 order-md-1"></div>
                <div class="col-md-10 order-md-1">
                    <form class="needs-validation" method='POST'>
                        <h2>Information de Voll</h2><br> 
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="text">Nom Voll :</label>
                                <input type="button" id="btn_vol_famille" class="chois_name" onclick="choix_vol_famille()" value="#Voyage en famille" >
                                <input type="button" id="btn_vol_travel" class="chois_name" onclick="choix_vol_travel()" value="#Voyage en travel" >
                            </div>
                            <div>
                                <input type="text" name="nam" class="form-control" id="nam_voll" placeholder="Autre nom" required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="text">Pays De Depart :</label>
                                <input type="text" name="pays_depart" class="form-control" id="pays_depart" placeholder="Pays De Depart" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="text">Pays De Arrive :</label>
                                <input type="text" name="pays_arrive" class="form-control" id="pays_arrive" placeholder="Pays De Arrive" required>
                            </div>
                        </div><br>

                        <div class="mb-3">
                            <label for="text">Date De Voll :</label>
                            <input type="date" name="date_vol" class="form-control" id="date_vol" placeholder="Date De Voll" required>
                        </div><br>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="text">Hour De Vol :</label>
                                <input type="number" name="hour_vol" class="form-control" id="hour_vol" placeholder="Hour De Vol" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="text">Minute_vol :</label>
                                <input type="number" name="minute_vol" class="form-control" id="minute_vol" placeholder="Minute_vol" required>
                            </div>
                        </div><br>

                        <div class="mb-3">
                            <label for="text">Nombre De plasse De Voll :</label>
                            <input type="number" name="nb_place_initial" class="form-control" id="nb_place_initial" placeholder="Nombre De plasse De Voll" required>
                        </div><br>



                        <div class="mb-3">
                            <label for="text">Price Voll :</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Price Voll" required>
                        </div><br>	
                        <div class="mb-3">
                            <label for="text">Image :</label>
                            <input type="text" name="image" class="form-control" id="image" placeholder="Image" required >
                        </div><br>
                        <hr class="mb-4">

                        <button class="btn btn-outline-success btn-lg btn-block" type="submit"  name="submit">Add New Voll</button>
                    </form>
                </div>
                <div class="col-md-1 order-md-1">
                </div>
            </div>
        </div>
<?php
	include_once('../views/includes/footer.php');
?>
