<?php
	include_once('../controllers/UsersController.php');
	include_once('../database/DB.php');
	include_once('../models/User.php');
	include_once('../views/includes/header.php');
	include_once('../app/classes/Session.php');
	if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }
    if (isset($_POST['id'])) {
		$exitUser = new UsersController();
		$user = $exitUser->getOneUserInId();
	}else{
		Redirect::to('index');
    }
    if (isset($_POST['submit'])) {
		$exitUser = new UsersController();
		$exitUser->updateUser();
	}
?>
<<link rel="stylesheet" href="../public/css/style_for_all.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav_header">
        <a class="navbar-brand" href="index.php">T-aér</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                    if($_SESSION['statut'] === 'Admin'){
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='admin.php'>Home <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='profil_admin.php'>Profil</a>
                        </li>";
                    }else if($_SESSION['statut'] === 'User'){
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='client.php'>Home <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='profil_client.php'>Profil</a>
                        </li>";
                    }
                ?>
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
                        echo '<h3 class="ml-4 float-right my-0 p-3"> Bienvenue '.$_SESSION['statut'].'  :' . $_SESSION['nameUser'] . ' ' . $_SESSION['prenomUser'] .'</h3>';
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
    <!-- --------------------------- -->
    
    <CEnter><h1>Modifiez vos informations</h1></CEnter>
    <!-- start container form -->
        <div class="container shadow-lg p-3 mt-5 mb-5 bg-white rounded">
            <div class="row mb-5 mt-5">
                <div class="col-md-1 order-md-1"></div>
                <div class="col-md-10 order-md-1">
                    <form class="needs-validation" method="POST">
                        <h2>Informations personnelles</h2><br>
                        <div class='row'>
                            <div class='col-md-6 mb-3'>
                                <label for='text'>Nom :</label>
                                <input type='text' name='nom_user_nv' class='form-control' id='nom_user_nv' value="<?php echo $user->nom; ?>">
                            </div>
                            <div class='col-md-6 mb-3'>
                                <label for='text'>Prenom :</label>
                                <input type='text' name='Prenom_user_nv' class='form-control' id='Prenom_user_nv' placeholder='Prenom' value="<?php echo $user->prenom; ?>" required>
                            </div>
                        </div><br>

                        <div class='mb-3'>
                            <label for='text'>Email :</label>
                            <input type='text' name='email_nv' class='form-control' id='email_nv' placeholder='Email' value="<?php echo $user->email; ?>" required>
                        </div><br>
                        <div class='mb-3'>
                            <label for='text'>Cin :</label>
                            <input type='text' name='cin_nv' class='form-control' id='cin_nv' placeholder='Email' value="<?php echo $user->cin; ?>" required>
                        </div><br>
                        <div class='mb-3'>
                            <label for='text'>password :</label>
                            <input type='text' name='password_nv' class='form-control' id='password_nv' placeholder='password' value="<?php echo $user->password; ?>" required>
                        </div><br>
                        <hr class='mb-4'>

                        <button class='btn btn-outline-success btn-lg btn-block' type='submit'  name='submit' ><i class="fa fa-edit" ></i> Modifiez vos informations</button>
                    </form>
                </div>
                <div class="col-md-1 order-md-1">
                </div>
                
            </div>
        </div>
    <!-- end container form -->
<?php
	include_once('../views/includes/footer.php');
?>