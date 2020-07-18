
<?php
	include_once('../controllers/UsersController.php');
	include_once('../database/DB.php');
	include_once('../models/User.php');
	include_once('../views/includes/header.php');
    include_once('../app/classes/Session.php');
    include_once('../controllers/VolsController.php');
	if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }
    else if ($_SESSION['statut'] != 'Admin') {
    	Redirect::to('index');
    }
    $data = new VolsController();
    $volsActive = $data->getAllVolsActiveForAdmin();
    $volsDesabledAndNotExpered = $data->getAllVolsDisabledAndNotExpiredForAdmin();
    $Allvols = $data->getAllVols();
    
?>
<link rel="stylesheet" href="../public/css/style_for_all.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .button_add_vol{
            font-family: cursive, sans-serif;
            background-color: #ff9f43;
            border: none;
            -webkit-box-shadow: 0px 0px 51px -4px rgba(255,159,67,1);
            -moz-box-shadow: 0px 0px 51px -4px rgba(255,159,67,1);
            box-shadow: 0px 0px 51px -4px rgba(255,159,67,1);
        }
        .button_add_vol:hover{
            background-color: #e67e22;
            
        }
        #card_1{
            display:block;
        }
        #card_2{
            display:none;
        }
        #card_3{
            display:none;
        }
    </style>
    <script>
        function hideOrshowContent($choix){
            d1 = document.getElementById('card_1');
            d2 = document.getElementById('card_2');
            d3 = document.getElementById('card_3');
            if($choix == 1){
                document.getElementById('testing1').classList.add('active');
                document.getElementById('testing2').classList.remove('active');
                document.getElementById('testing3').classList.remove('active');

                d1.style.display="block";
                d2.style.display="none";
                d3.style.display="none";


            }else if($choix == 2){
                document.getElementById('testing1').classList.remove('active');
                document.getElementById('testing2').classList.add('active');
                document.getElementById('testing3').classList.remove('active');

                d1.style.display="none";
                d2.style.display="block";
                d3.style.display="none";
            }else if($choix == 3){
                document.getElementById('testing1').classList.remove('active');
                document.getElementById('testing2').classList.remove('active');
                document.getElementById('testing3').classList.add('active');

                d1.style.display="none";
                d2.style.display="none";
                d3.style.display="block";
            }
        }
    </script>
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
                    <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profil_admin.php">Profil</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a href="<?php echo "../controllers/LogOut.php" ?>" class="btn btn-info p-2"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
            </div>
        </div>
    </nav>
    <!-- --------------------------- -->

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <center><i class="fas fa-user-tie" style="font-size: 100px;"></i></center></h6>
                <h3>Taoufiq / RHOUAS</h3>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Tableau de bord</span>
                <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <div class="">
                <div class="btn-group-vertical btn-lg btn-block">
                    <hr>
                    <a href="profil_admin.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-user-tie mt-2 float-left"></i>Profil</a>
                    <hr>
                    <a href="gestion_vol.php" class="btn btn-primary btn-lg btn-block"><i class="fas fa-location-arrow mt-2 float-left"></i>gestion des vols</a>
                    <hr>
                    <a href="historique.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-list-alt float-left mt-2"></i>Historique</a>
                    
                </div>
            </div>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
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
        <div class="my-2 p-2 p-5">
            <div class="col-md-6 mx-auto">
                <center><a href="add_vol.php" class="btn btn-primary my-2 p-4 button_add_vol btn-lg btn-block"><i class="fas fa-plus"></i> AJOUTER UN NOUVEAU VOL</a></center>
                
            </div>
        </div>
    </div> 
    <hr>
    <!-- --------------------------- -->
    <div class="">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs ">
                    <li class="nav-item">
                        <button class="nav-link active" id="testing1" onclick="hideOrshowContent('1')">Les Volles Active</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="testing2" onclick="hideOrshowContent('2')">Les Volle Desactive Et Pas expiré</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="testing3" onclick="hideOrshowContent('3')">Tout Les Voles</a>
                    </li>
                </ul>
            </div>
            <div class="card-body" id="card_1">
                <h1 class="card-title  pb-4">Les Volles Active</h1>
                <!-- -------------------------------------------------- -->


                <div class="row" id="r1">
                    <!-- start script -->
                    <hr>
                    <?php
                        //vol active
                        $colapsContur = 1;
                        foreach ($volsActive as $row):
                            
                            echo '
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div  class="bd-placeholder-img card-img-top"  width="100%" height="225">
                                        <center>
                                            <strong><h1 class="fnt_fmly_cursive">'. $row["price"] .' DH </h1></strong>
                                            <h3>' . $row["nam"] . '</h3>
                                            <img src="../public/images/'.$row["image"].'" width="auto" height="225" alt="Img De Voll">
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <h6><strong>Ville De Départ : </strong>' . $row["pays_depart"] .'</h6>
                                        <h6><strong>Ville d arrive : </strong>' . $row["pays_arrive"] .'</h6>
                                        <h6><strong>Date De VOL : </strong>' . $row["date_vol"] .'</h6>
                                        
                                        <div class="accordion mb-3 mt-2" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" id="headingOne"  style="padding: 6px;">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapse'.$colapsContur.'" aria-expanded="false" aria-controls="collapseOne">Plus de détails</button>

                                                </div>

                                                <div id="collapse'.$colapsContur.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">

                                                    <h6><strong>Hour : </strong>' . $row["hour_vol"] .'h,' . $row["minute_vol"] .'min</h6>
                                                    <h6><strong>Nombre De Plasse : </strong>' . $row["nb_place_initial"] .'</h6>
                                                    <h6><strong>Nombre De Reste : </strong>' . $row["nb_place_rest"] .'</h6>
                                                    <h6><strong>Price : </strong>' . $row["price"] .'</h6>
                                                    <h6><strong>ID Voll : </strong>' . $row["id_vol"] .'</h6>

                                                    <h6><strong>ID ADMIN CREER : </strong>' . $row["id_admin_created"] .'</h6>
                                                    
                                                    <form method="POST" class="mr-1" action="reserve.php" >
                                                        <input type="hidden" name="id" value='.$row["id_vol"].'>
                                                        <button class="btn btn-outline-success btn-lg btn-block" ><i class="fas fa-paper-plane"></i> Reserve</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <form method="POST" action="update_Voll.php" >
                                                    <input type="hidden" name="id" value='. $row['id_vol'].'>
                                                    <button class="btn btn-lg btn-outline-warning  mb-2" ><i class="fa fa-edit" ></i> Edit</button>
                                                </form>
                                                
                                            </div>
                                            
                                            <form method="POST" action="annuler_Voll.php" >
                                                <input type="hidden" name="id_vol" value='. $row['id_vol'].'>
                                                <button class="btn btn-lg btn-outline-danger mb-2" ><i class="fa fa-lock" ></i> Desactive</button>
                                            </form>
                                            
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <h5>Etatt : </h5>
                                            </div>
                                            <h5 class="text-muted">Le vol est actuellement actif </h5>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                
                                            </div>
                                            <small class="text-muted">Pubblier Le :'. $row["date_created"] .'</small>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            $colapsContur ++;
                        endforeach
                    ?>
                    <hr>
                </div>
                <!-- -------------------------------------------------- -->
            </div>
            <div class="card-body" id="card_2">
                <h1 class="card-title  pb-4">Les Volle Desactive Et Pas expiré</h1>
                <div class="row" id="r3">
                    <?php
                        $colapsContur = 1;
                        foreach ($volsDesabledAndNotExpered as $row):
                            $statu_vol = $row["statu_vol"];
                            $date_vol = $row["date_vol"];
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
                                            <strong><h1 class="fnt_fmly_cursive">'. $row["price"] .' DH </h1></strong>
                                            <h3>' . $row["nam"] .'</h3>
                                            <img src="../public/images/'.$row["image"].'" width="auto" height="225" alt="Img De Voll">
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        
                                        <h6><strong>Ville De Départ : </strong>' . $row["pays_depart"] .'</h6>
                                        <h6><strong>Ville d arrive : </strong>' . $row["pays_arrive"] .'</h6>
                                        <h6><strong>Date De VOL : </strong>' . $row["date_vol"] .'</h6>
                                        
                                        <div class="accordion mb-3 mt-2" id="accordionExample">
                                            <div class="card">
                                            <div class="card-header" id="headingOne"  style="padding: 6px;">
                                                <button type="button" class="btn btn-sm btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapse'.$colapsContur.'" aria-expanded="false" aria-controls="collapseOne">Plus de détails</button>

                                            </div>

                                                <div id="collapse'.$colapsContur.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">

                                                    <h6><strong>Hour : </strong>' . $row["hour_vol"] .'h,' . $row["minute_vol"] .'min</h6>
                                                    <h6><strong>Nombre De Plasse : </strong>' . $row["nb_place_initial"] .'</h6>
                                                    <h6><strong>Nombre De Reste : </strong>' . $row["nb_place_rest"] .'</h6>
                                                    <h6><strong>Price : </strong>' . $row["price"] .'</h6>
                                                    <h6><strong>ID Voll : </strong>' . $row["id_vol"] .'</h6>

                                                    <h6><strong>ID ADMIN CREER : </strong>' . $row["id_admin_created"] .'</h6>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <form method="POST" action="update_Voll.php" >
                                                    <input type="hidden" name="id" value='. $row['id_vol'].'>
                                                    <button class="btn btn-lg btn-outline-warning  mb-2" ><i class="fa fa-edit" ></i> Edit</button>
                                                </form>
                                            </div>
                                            <form method="POST" action="active_Voll.php" >
                                                <input type="hidden" name="id_vol" value='. $row['id_vol'].'>
                                                <button class="btn btn-lg btn-outline-success mb-2" ><i class="fas fa-lock-open" ></i> Active</button>
                                            </form>
                                            
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <h5>Etatt : </h5>
                                            </div>
                                            <h5 class="text-muted">'. $statu .'</h5>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                
                                            </div>
                                            <small class="text-muted">Pubblier Le :'. $row["date_created"] .'</small>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            $colapsContur ++;
                        endforeach
                    ?>
                </div>
            </div>
            <div class="card-body" id="card_3">
                <h1 class="card-title  pb-4">Tout Les Voles</h1>
                <!-- ------------------------------------------- -->
                    <div class="row" id="r2">
                        <?php

                            $date1 = new DateTime;
                            $date1 = $date1->format('Y-m-d') ;

                            $dateMoins1 = new DateTime('-1 day');
                            $dateMoins1 = $dateMoins1->format('Y-m-d') ;

                            $colapsContur = 1;

                            foreach ($Allvols as $row):

                                $statu_vol = $row["statu_vol"];
                                $date_vol = $row["date_vol"];
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
                                                <strong><h1 class="fnt_fmly_cursive">'. $row["price"] .' DH </h1></strong>
                                                <h3>' . $row["nam"] . '</h3>
                                                <img src="../public/images/'.$row["image"].'" width="auto" height="225" alt="Img De Voll">
                                            </center>
                                        </div>
                                        <div class="card-body">
                                            
                                            <h6><strong>Ville De Départ : </strong>' . $row["pays_depart"] .'</h6>
                                            <h6><strong>Ville d arrive : </strong>' . $row["pays_arrive"] .'</h6>
                                            <h6><strong>Date De VOL : </strong>' . $row["date_vol"] .'</h6>
                                            
                                            <div class="accordion mb-3 mt-2" id="accordionExample">
                                                <div class="card">
                                                <div class="card-header" id="headingOne"  style="padding: 6px;">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapse'.$colapsContur.'" aria-expanded="false" aria-controls="collapseOne">Plus de détails</button>
                                                </div>
                                                    <div id="collapse'.$colapsContur.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">

                                                        <h6><strong>Hour : </strong>' . $row["hour_vol"] .'h,' . $row["minute_vol"] .'min</h6>
                                                        <h6><strong>Nombre De Plasse : </strong>' . $row["nb_place_initial"] .'</h6>
                                                        <h6><strong>Nombre De Reste : </strong>' . $row["nb_place_rest"] .'</h6>
                                                        <h6><strong>Price : </strong>' . $row["price"] .'</h6>
                                                        <h6><strong>ID Voll : </strong>' . $row["id_vol"] .'</h6>

                                                        <h6><strong>ID ADMIN CREER : </strong>' . $row["id_admin_created"] .'</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <form method="POST" action="update_Voll.php" >
                                                        <input type="hidden" name="id" value='. $row['id_vol'].'>
                                                        <button class="btn btn-lg btn-outline-warning  mb-2" ><i class="fa fa-edit" ></i> Edit</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <h5>Etatt : </h5>
                                                </div>
                                                <h5 class="text-muted">'. $statu .'</h5>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    
                                                </div>
                                                <small class="text-muted">Pubblier Le :'. $row["date_created"] .'</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                $colapsContur ++;
                                endforeach
                            ?>
                    </div>
                <!-- ------------------------------------------- -->
            </div>
        </div>
    </div>
    </main>
  </div>
</div>
<?php
	include_once('../views/includes/footer.php');
?>
