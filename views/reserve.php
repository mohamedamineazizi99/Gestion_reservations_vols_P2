<?php
include_once('../database/DB.php');
include_once('../views/includes/header.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
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
                <?php
                    if($_SESSION['statut'] === 'Admin'){
                        echo "
                        <li class='nav-item active'>
                            <a class='nav-link' href='admin.php'>Home <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='profil_admin.php'>Profil</a>
                        </li>";
                    }else if($_SESSION['statut'] === 'User'){
                        echo "
                        <li class='nav-item active'>
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
    <hr>
    <?php
    if (isset($_POST['id'])) {
        $_SESSION['id_vol_1'] = $_POST['id'];
        $_SESSION['id_voll'] = $_POST['id'];
        $_SESSION['id_client'] = $_SESSION['idUser'];
	}
    ?>
    <?php
        $id_v = $_POST['id'];
        $id_admin_created = $_SESSION['idUser'];

        $query1 = DB::connect()->prepare("SELECT `nb_place_rest` FROM `vols` WHERE `vols`.`id_vol` = '$id_v' ");
        $query1 ->execute();
        if($query1->rowCount() > 0){
            // $colapsContur = 1;
            while($row1 = $query1->fetch(PDO::FETCH_ASSOC)){
                $rombre_plass_rest = $row1["nb_place_rest"];
            }
        }
        $cin_user = NULL;
        $query2 = DB::connect()->prepare("SELECT `cin` FROM `user` WHERE `user`.`id` = '$id_admin_created'");
        $query2 ->execute();
        if($query2->rowCount() > 0){
            while($row2 = $query2->fetch(PDO::FETCH_ASSOC)){
                $cin_user = $row2["cin"];
            }
            // --------------------
            $query3 = DB::connect()->prepare("SELECT p.* FROM `passager` p,`user` u WHERE u.`id` = p.`id_user_created` AND u.`cin` = p.`cin_passager` AND u.`id` = '$id_admin_created' AND u.`cin` = '$cin_user'");
            $query3 ->execute();
            if($query3->rowCount() > 0){
                $_SESSION['passager_exist'] = 'Validation@Type$1';
                echo "<h1>oui deja exist com passager</h1>";
                echo "
                    <div class='container'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <center>
                                    <a href='confermation_reservation.php?id_v=$id_v&&type=1' class='btn btn-outline-success btn-lg btn-block mb-5'>Pour toi</a>
                                </center>
                            </div>
                            <div class='col-sm-6'>
                                <center>
                                    <a href='confermation_reservation.php?id_v=$id_v&&type=2' class='btn btn-outline-success btn-lg btn-block mb-5'>pour autre person</a>
                                </center>
                            </div>
                        </div>
                    </div>";
            }else {
                $_SESSION['passager_exist'] = 'Validation@Type$2';
                echo "<center><h1 class='pb-5' >Essayer votre premier voyage</h1></center>";
                echo "
                    <div class='container mt-5'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <center>
                                    <a href='confermation_reservation.php?id_v=$id_v&&type=3' class='btn btn-outline-success btn-lg btn-block mb-5'>Pour toi</a>
                                </center>
                            </div>
                            <div class='col-sm-6'>
                                <center>
                                    <a href='confermation_reservation.php?id_v=$id_v&&type=2' class='btn btn-outline-success btn-lg btn-block mb-5'>pour autre person</a>
                                </center>
                            </div>
                        </div>
                    </div>";
            }
        }else {
            echo "chi haja tema";
        }            
    ?>
     <canvas class="my-4 w-100" id="myChart" width="900" height="140"></canvas>
<?php
	include_once('../views/includes/footer.php');
?>