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
    else if ($_SESSION['statut'] != 'User') {
    	Redirect::to('index');
    }
?>
<link rel="stylesheet" href="../public/css/style_for_all.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav_header">
        <a class="navbar-brand" href="index.php">T-aér</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="client.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profil_client.php">Profil</a>
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
                        echo '<h3 class="ml-4 float-right my-0 p-3"> Bienvenue User :' . $_SESSION['nameUser'] . ' ' . $_SESSION['prenomUser'] .'</h3>';
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
    <div>
        <div class="my-2 p-2 pb-5">
            <div class="col-md-6 mx-auto">
                <div class="card shadow_div_sherch mb-4">
                    <div class="card-header" ><center><h2>Recherche </h2></center></div>
                    <div class="card-body bg-light">
                        <form class="my-5 mx-md-0 p-1" method='POST' action="recherche.php">                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="text">Vil Depart :</label>
                                    <input type="text" name="vilDepart" class="form-control" id="vilDepart" placeholder="First name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="text">Vil Arrive :</label>
                                    <input type="text" name="vilArive" class="form-control" id="vilArive" placeholder="Last name" required>
                                </div>
                            </div><br>
                            <button class="btn btn-outline-success btn-lg btn-block" type="submit"  name="submit" id="btnsubmit2"><i class="fas fa-search"></i> Recherche</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------------------------------------------------------------------------ -->
<hr>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs ">
                    <li class="nav-item">
                        <a class="nav-link active" href="profil_client.php">Votre information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historique_user.php">Historique</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h1 class="card-title  pb-4">Votre information</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <i class="fas fa-user-tie pt-4" style="font-size: 150px;"></i>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table class="table mx-auto">
                                <tr>
                                    <td><h5 class="float-left" >Nome :</h5></td>
                                    
                                    <td><?php echo '<h5 class="float-left" >'. $_SESSION['nameUser'] .'</h5>'; ?></td>
                                </tr>
                                <tr>
                                    <td><h5 class="float-left">Prenom :</h5></td>
                                    <td><?php echo '<h5 class="float-left">'. $_SESSION['prenomUser'] .'</h5>'; ?></td>
                                </tr>
                                <tr>
                                    <td><h5 class="float-left">Cin :</h5></td>
                                    <td><?php echo '<h5 class="float-left">'. $_SESSION['cin'] .'</h5>'; ?></td>
                                </tr>
                                <tr>
                                    <td><h5 class="float-left">Email :</h5></td>
                                    <td><?php echo '<h5 class="float-left">'. $_SESSION['email'] .'</h5>'; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <form method="POST" class="mr-1" action="update_user.php" >
                    <input type="hidden" name="id" value="<?php echo $_SESSION['idUser'];?>">
                    <button class="btn btn-warning" ><i class="fa fa-edit" ></i>Modifier Votre Information</button>
                </form>
            </div>
        </div>
    </div>
<?php
	include_once('../views/includes/footer.php');
?>