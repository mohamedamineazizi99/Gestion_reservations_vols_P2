<?php
include_once('../database/DB.php');
include_once('../views/includes/header.php');
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../controllers/ReservationsController.php');
include_once('../controllers/VolsController.php');
if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }
    if (isset($_POST['submit'])) {
		$newReservation = new ReservationsController();
		$newReservation->addReservation();
	}

    $id_v = $_SESSION['id_voll'];
    $type=(int)isset($_GET['type']) ? $_GET['type'] : die('ERROR: Record type not found.');
    $_SESSION['typrReservation'] = $type ;
    $id_admin_created = $_SESSION['id_client'];
    $test_type = $_SESSION['passager_exist'];
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
<hr>
<?php
    echo "
    <div class='container shadow-lg p-3 mt-5 mb-5 bg-white rounded'>
        <h1 class='text-center mt-5'>confirmer la réservation</h1>
        <h3 class='text-center mt-5'>Verifier c'est formulaire</h3>
        <div class='row mb-5 mt-5'>
            <div class='col-md-1 order-md-1'></div>
            <div class='col-md-10 order-md-1'>";
                if ($type == 1 && $test_type === 'Validation@Type$1'){
                    echo " <form class='needs-validation' method='POST'>";
                    $data1 = new VolsController();
                    $vols = $data1->getVolsquery(" `vols`.`id_vol` = '$id_v' AND `vols`.`statu_vol` = 'active'");
                    foreach ($vols as $row0):
                    // ----------
                    $heurMinut = $row0['hour_vol'] .'h ' .$row0["minute_vol"] .'min';
                    $place_initial = $row0['nb_place_initial'];
                    $place_reste = $row0['nb_place_rest'];
                    $place_reste = $place_reste - 1;
                    $num_plass = $place_initial - $place_reste;
                    echo "<h4> Le nombre total de place de vol : ".$place_initial." </h4>";
                    echo "<h4> Le nombre de places reste : ".$place_reste." </h4>";
                    echo "<h4> Votre numéro de place : ".$num_plass." </h4>";
                    echo "
                        <div class=' mb-4'>
                            <div class='mb-3'>
                                <center><h2>Information De Voll</h2></center>
                                
                            </div><br>
                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <h3>". $row0["nam"] ."</h3>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <h3><strong> ID Voll : </strong> ". $id_v ."</h3>
                                </div>
                            </div><br>
                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Vill De Depart : </label>
                                    <input type='text' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["pays_depart"] . " disabled>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Vill D'arive : </label>
                                    <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=" . $row0["pays_arrive"] . " disabled>
                                </div>
                            </div><br>
                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Date voll : </label>
                                    <input type='date' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["date_vol"] . " disabled>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Heur Voll : </label>
                                    <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=' $heurMinut' disabled>
                                </div>
                            </div><br>
                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Numero de plass : </label>
                                    <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Nombre De Plasse' value='  $num_plass  ' disabled>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <label for='text'>Prix : </label>
                                    <input type='number' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["price"] . " disabled>
                                </div>
                            </div><br><hr>
                        </div>";
                        $cin_user = NULL;
                        $query1 = DB::connect()->prepare("SELECT `cin` FROM `user` WHERE `user`.`id` = $id_admin_created");
                            $query1 ->execute();
                            if($query1->rowCount() > 0){
                                while($row1 = $query1->fetch(PDO::FETCH_ASSOC)){
                                $cin_user = $row1["cin"];
                            }
                            $query2 = DB::connect()->prepare("SELECT p.* FROM `passager` p,`user` u WHERE u.`id` = p.`id_user_created` AND u.`cin` = p.`cin_passager` AND u.`id` = $id_admin_created AND u.`cin` = '$cin_user'");
                            $query2 ->execute();
                            if($query2->rowCount() > 0){
                                while($row2 = $query2->fetch(PDO::FETCH_ASSOC)){
                                    $_SESSION["id_passager"] = $row2["id_passager"];
                                    $_SESSION['cin_user_passager'] = $row2["cin_passager"];
                                    
                                    echo "
                                        <div class='mb-3'>
                                            <center><h2>Information De Passager</h2></center>
                                            
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Nom De Passager :</label>
                                            <input type='text' name='nom_passager' class='form-control' id='nom_passager' placeholder='Nom De Passager' value=" . $row2["nom_passager"] . " disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Prenom De Passager :</label>
                                            <input type='text' name='prenom_passager' class='form-control' id='prenom_passager' placeholder='Prenom De Passager' value=" . $row2["prenom_passager"] . " disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Date de naissance :</label>
                                            <input type='date' name='date_de_naissance' class='form-control' id='date_de_naissance' placeholder='Date De Naissance De Passager'  value=" . $row2["date_de_naissance"] . " disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='example-tel-input'>Telephone :</label>
                                            <input type='number' name='phone_passager' class='form-control' id='phone_passager' placeholder='Telephone' value=" . $row2["phone_passager"] . " disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Email :</label>
                                            <input type='text' name='email_passager' class='form-control' id='email_passager' placeholder='Email' value=" . $row2["email_passager"] . " disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Cin :</label>
                                            <input type='text' name='cin_passager' class='form-control' id='cin_passager' placeholder='Cin' value=". $row2["cin_passager"] ." disabled>
                                        </div><br>
                                        <div class='mb-3'>
                                            <label for='text'>Numero De Passport :</label>
                                            <input type='text' name='n_passport_passager' class='form-control' id='n_passport' placeholder='Numero De Passport' value=". $row2["n_passport_passager"] ." disabled>
                                        </div><br>
                                        <hr class='mb-4'>
                                        <button class='btn btn-outline-success btn-lg btn-block' type='submit'  name='submit'><i class='fas fa-check mr-2'></i>Confermer La Reservation</button>
                                        <hr class='mb-4'>
                                    ";           
                                }
                            }else {
                                Session::set('error','You can not Get tour information');
                                header("Location:'.'reserve.php?id_v='.$id_v.'");
                                exit();
                            }
                        }else{
                            $_SESSION['id_client']==null;
                            
                            Redirect::to("index");
                        }
                    endforeach;
                    echo "</form>";
                    echo "
                    <form method='POST' class='mr-1' action='update_user.php' >
                        <input type='hidden' name='id' value=" .$_SESSION["idUser"].">
                        <button class='btn btn-outline-success btn-lg btn-block' ><i class='fa fa-edit mr-2' ></i>Modifiez vos informations</button>
                    </form>
                    ";
                }else if ($type == 3 && $test_type === 'Validation@Type$2'){
                    echo " <form class='needs-validation' method='POST'>";
                    // -------------------------------
                    $data1 = new VolsController();
                    $vols = $data1->getVolsquery(" `vols`.`id_vol` = $id_v AND `vols`.`statu_vol` = 'active'");
                    foreach ($vols as $row0):
                    // -------------------------------
                        $heurMinut = $row0['hour_vol'] .'h ' .$row0["minute_vol"] .'min';
                        $place_initial = $row0['nb_place_initial'];
                        $place_reste = $row0['nb_place_rest'];
                        $place_reste = $place_reste - 1;
                        $num_plass = $place_initial - $place_reste;
                        echo "<h4> Le nombre total de place de vol : ".$place_initial." </h4>";
                        echo "<h4> Le nombre de places reste : ".$place_reste." </h4>";
                        echo "<h4> Votre numéro de place : ".$num_plass." </h4>";
                        echo "
                            <div class=' mb-4'>
                                <div class='mb-3'>
                                    <center><h2>Information De Voll</h2></center>
                                    
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-6 mb-3'>
                                        <h3>". $row0["nam"] ."</h3>
                                    </div>
                                    <div class='col-md-6 mb-3'>
                                        <h3><strong> ID Voll : </strong> ". $id_v ."</h3>
                                    </div>
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Vill De Depart : </label>
                                        <input type='text' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["pays_depart"] . " disabled>
                                    </div>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Vill D'arive : </label>
                                        <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=" . $row0["pays_arrive"] . " disabled>
                                    </div>
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Date voll : </label>
                                        <input type='date' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["date_vol"] . " disabled>
                                    </div>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Heur Voll : </label>
                                        <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=' $heurMinut' disabled>
                                    </div>
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Numero de plass : </label>
                                        <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Nombre De Plasse' value='  $num_plass  ' disabled>
                                    </div>
                                    <div class='col-md-6 mb-3'>
                                        <label for='text'>Prix : </label>
                                        <input type='number' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["price"] . " disabled>
                                    </div>
                                </div><br><hr>
                            </div>";

                            $cin_user = NULL;
                            
                            $query1 = DB::connect()->prepare("SELECT * FROM `user` WHERE `user`.`id` = $id_admin_created");
                            $query1 ->execute();
                            if($query1->rowCount() > 0){
                                while($row1 = $query1->fetch(PDO::FETCH_ASSOC)){
                                    $cin_user = $row1["cin"];
                                    
                                    $nom = $row1["nom"];
                                    $prenom = $row1["prenom"];
                                    $email = $row1["email"];
                                    $statut_user = $row1["statut"];
                                    
                                }
                                
                                $query2 = DB::connect()->prepare("SELECT p.* FROM `passager` p,`user` u WHERE u.`id` = p.`id_user_created` AND u.`cin` = p.`cin_passager` AND u.`id` = $id_admin_created AND u.`cin` = '$cin_user'");
                                $query2 ->execute();
                                $rrrr = 0;
                                if($query1->rowCount() > 0){
                                    while($row1 = $query1->fetch(PDO::FETCH_ASSOC)){
                                        $rrrr ++;
                                    }
                                }
                                if($rrrr == 0){
                                        echo "
                                            <div class='mb-3'>
                                                <center><h2>Information De Passager</h2></center>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Nom De Passager :</label>
                                                <input type='hidden' name='nom_passager' value= '$nom'>
                                                <input type='text' name='nom_passager1' class='form-control' id='nom_passager' placeholder='Nom De Passager' value=" . $nom . " disabled>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Prenom De Passager :</label>
                                                <input type='hidden' name='prenom_passager' value= '$prenom'>
                                                <input type='text' name='prenom_passager1' class='form-control' id='prenom_passager' placeholder='Prenom De Passager' value=" . $prenom . " disabled>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Date de naissance :</label>
                                                <input type='date' name='date_de_naissance' class='form-control' id='date_de_naissance' placeholder='Date De Naissance De Passager'  required>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='example-tel-input'>Telephone :</label>
                                                <input type='number' name='phone_passager' class='form-control' id='phone_passager' placeholder='Telephone' required>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Email :</label>
                                                <input type='hidden' name='email_passager' value= '$email'>
                                                <input type='text' name='email_passager1' class='form-control' id='email_passager' placeholder='Email' value=" . $email . " disabled>
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Cin :</label>";
                                                if ($statut_user === 'User' && $cin_user === '_'){
                                                    echo "<input type='text' name='cin_passager' class='form-control' id='cin_passager' placeholder='Cin' required>";
                                                }else{
                                                    echo "<input type='hidden' name='cin_passager' value= '$cin_user'>
                                                    <input type='text' name='cin_passager1' class='form-control' id='cin_passager' placeholder='Cin' value=". $cin_user ." disabled>";
                                                }
                                            echo "  
                                            </div><br>
                                            <div class='mb-3'>
                                                <label for='text'>Numero De Passport :</label>
                                                <input type='text' name='n_passport_passager' class='form-control' id='n_passport' placeholder='Numero De Passport' required>
                                            </div><br>
                                            <hr class='mb-4'>
                                            <button class='btn btn-outline-success btn-lg btn-block' type='submit'  name='submit'><i class='fas fa-paper-plane'></i> Confermer La Reservation</button>
                                            <hr class='mb-4'>
                                        ";           
                                }else {
                                    Session::set('error','all erdy exist');
                                    header("Location:'.'reserve.php?id_v='.$id_v.'");
                                    exit();
                                }
                            }else{
                                $_SESSION['id_client']==null;
                                Redirect::to("index");
                            }
                    endforeach;
                    echo "</form>";
                    echo "
                    <form method='POST' class='mr-1' action='update_user.php' >
                        <input type='hidden' name='id' value=" .$_SESSION["idUser"].">
                        <button class='btn btn-outline-success btn-lg btn-block' ><i class='fa fa-edit mr-2' ></i>Modifiez vos informations</button>
                    </form>
                    ";
                }else if ($type == 2 && ($test_type === 'Validation@Type$2' || $test_type === 'Validation@Type$1' )){
                    echo " <form class='needs-validation' method='POST'>";
                            // -------------------------------
                            $data1 = new VolsController();
                            $vols = $data1->getVolsquery(" `vols`.`id_vol` = $id_v AND `vols`.`statu_vol` = 'active'");
                            foreach ($vols as $row0):
                            // -------------------------------

                            $heurMinut = $row0['hour_vol'] .'h ' .$row0["minute_vol"] .'min';
                            $place_initial = $row0['nb_place_initial'];
                            $place_reste = $row0['nb_place_rest'];
                            $place_reste = $place_reste - 1;
                            $num_plass = $place_initial - $place_reste;
                            echo "<h4> Le nombre total de place de vol : ".$place_initial." </h4>";
                            echo "<h4> Le nombre de places reste : ".$place_reste." </h4>";
                            echo "<h4> Votre numéro de place : ".$num_plass." </h4>";

                            echo "
                                <div class=' mb-4'>
                                    <div class='mb-3'>
                                        <center><h2>Information De Voll</h2></center>
                                        
                                    </div><br>
                                    <div class='row'>
                                        <div class='col-md-6 mb-3'>
                                            <h3>". $row0["nam"] ."</h3>
                                        </div>
                                        <div class='col-md-6 mb-3'>
                                            <h3><strong> ID Voll : </strong> ". $id_v ."</h3>
                                        </div>
                                    </div><br>
                                    <div class='row'>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Vill De Depart : </label>
                                            <input type='text' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["pays_depart"] . " disabled>
                                        </div>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Vill D'arive : </label>
                                            <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=" . $row0["pays_arrive"] . " disabled>
                                        </div>
                                    </div><br>
                                    <div class='row'>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Date voll : </label>
                                            <input type='date' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["date_vol"] . " disabled>
                                        </div>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Heur Voll : </label>
                                            <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Minute_vol' value=' $heurMinut' disabled>
                                        </div>
                                    </div><br>
                                    <div class='row'>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Numero de plass : </label>
                                            <input type='text' name='minute_vol' class='form-control' id='minute_vol' placeholder='Nombre De Plasse' value='  $num_plass  ' disabled>
                                        </div>
                                        <div class='col-md-6 mb-3'>
                                            <label for='text'>Prix : </label>
                                            <input type='number' name='hour_vol' class='form-control' id='hour_vol' placeholder='Hour De Vol' value=" . $row0["price"] . " disabled>
                                            
                                        </div>
                                    </div><br> <hr>
                                </div>";
                                echo "
                                <div class='mb-3'>
                                    <center><h2>Information De Passager</h2></center>
                                    
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Nom De Passager :</label>
                                    <input type='text' name='nom_passager' class='form-control' id='nom_passager' placeholder='Nom De Passager' required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Prenom De Passager :</label>
                                    <input type='text' name='prenom_passager' class='form-control' id='prenom_passager' placeholder='Prenom De Passager' required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Date de naissance :</label>
                                    <input type='date' name='date_de_naissance' class='form-control' id='date_de_naissance' placeholder='Date De Naissance De Passager'  required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='example-tel-input'>Telephone :</label>
                                    <input type='number' name='phone_passager' class='form-control' id='phone_passager' placeholder='Telephone' required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Email :</label>
                                    <input type='text' name='email_passager' class='form-control' id='email_passager' placeholder='Email' required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Cin :</label>
                                    <input type='text' name='cin_passager' class='form-control' id='cin_passager' placeholder='Cin' required>
                                </div><br>
                                <div class='mb-3'>
                                    <label for='text'>Numero De Passport :</label>
                                    <input type='text' name='n_passport_passager' class='form-control' id='n_passport' placeholder='Numero De Passport' required>
                                </div><br>
                                <hr class='mb-4'>
                                <center>
                                    <button class='btn btn-outline-success btn-lg btn-block' type='submit'  name='submit'><i class='fas fa-check mr-2'></i>Confermer La Reservation</button>
                                </center>";           
                    endforeach;
                    echo"</form>"; 
                }
                echo "
            </div>
            <div class='col-md-1 order-md-1'>
            </div>
        </div>
    </div>"; 
?>
<?php
	include_once('../views/includes/footer.php');
?>