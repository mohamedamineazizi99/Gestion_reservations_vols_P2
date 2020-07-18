<?php
	include_once('../controllers/UsersController.php');
	include_once('../controllers/VolsController.php');
	include_once('../database/DB.php');
	include_once('../models/User.php');
	include_once('../models/vol.php');
	include_once('../views/includes/header.php');
	include_once('../app/classes/Session.php');
	if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }else if ($_SESSION['statut'] != 'User') {
    	Redirect::to('index');
    }
    if (isset($_POST['vilDepart'])) {
        Redirect::to('recherche.php');
	}
    $data = new VolsController();
	$volsActive = $data->getAllVolActive();
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
                <li class="nav-item active">
                    <a class="nav-link" href="client.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
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
    <!-- <hr> -->
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
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- start script -->
                <hr>
                <?php
                    $date1 = new DateTime;
                    $date1 = $date1->format('Y-m-d') ;

                    $dateMoins1 = new DateTime('-1 day');
                    $dateMoins1 = $dateMoins1->format('Y-m-d') ;
                    $colapsContur = 1;
                    foreach ($volsActive as $volActive):
                        $statu_vol = $volActive["statu_vol"];
                        $date_vol = $volActive["date_vol"];
                        $statu = 'null';
                        if ($statu_vol === 'annule'){
                            $statu = 'Le voyage a été annulé';
                        }else if ($statu_vol === 'active' && $date1 > $date_vol){
                            $statu = 'Le voyage a expiré';
                        }else if ($statu_vol === 'active' && $date_vol > $dateMoins1){
                            $statu = 'Le vol est actuellement actif';
                        }
                        echo '
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div  class="bd-placeholder-img card-img-top"  width="100%" height="225">
                                    <center>
                                        <strong><h1 class="fnt_fmly_cursive">'. $volActive["price"] .' DH </h1></strong>
                                        <h3>' . $volActive["nam"] . '</h3>
                                        <img src="../public/images/'.$volActive["image"].'" width="auto" height="225" alt="Img De Voll">
                                    </center>
                                </div>
                                <div class="card-body">
                                    <h6><strong>Ville De Départ : </strong>' . $volActive["pays_depart"] .'</h6>
                                    <h6><strong>Ville d arrive : </strong>' . $volActive["pays_arrive"] .'</h6>
                                    <h6><strong>Date De VOL : </strong>' . $volActive["date_vol"] .'</h6>
                                    <div class="accordion mb-3 mt-2" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne" style="padding: 6px;">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapse'.$colapsContur.'" aria-expanded="false" aria-controls="collapseOne">Mor Detaills</button>
                                            </div>
                                            <div id="collapse'.$colapsContur.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <h6><strong>Hour : </strong>' . $volActive["hour_vol"] .'h,' . $volActive["minute_vol"] .'min</h6>
                                                    <h6><strong>Nombre De Plasse : </strong>' . $volActive["nb_place_initial"] .'</h6>
                                                    <input type="hidden" name="nb_place_rest_1" value='. $volActive['nb_place_rest'].'>
                                                    <h6><strong>Nombre De Reste : </strong>' . $volActive["nb_place_rest"] .'</h6>
                                                    <h6><strong>Price : </strong>' . $volActive["price"] .'</h6>
                                                    <h6><strong>ID Voll : </strong>' . $volActive["id_vol"] .'</h6>
                                                    
                                                    <form method="POST" class="mr-1" action="reserve.php" >
                                                        <input type="hidden" name="id" value='.$volActive["id_vol"].'>
                                                        <button class="btn btn-outline-success btn-lg btn-block mx-auto" ><i class="fas fa-paper-plane"></i> Reserve</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <h5>Etatt : </h5>
                                        </div>
                                        <h5 class="text-muted"> '.$statu.' </h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        </div>
                                        <small class="text-muted mb-2">Pubblier Le :'. $volActive["date_created"] .'</small>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        $colapsContur ++;
                    endforeach;
                ?>
                <hr>
                <!-- end script -->
            </div>
        </div>
    </div>
<!-- ------------------------------------------------------------------------------------ -->

<?php
	include_once('../views/includes/footer.php');
?>