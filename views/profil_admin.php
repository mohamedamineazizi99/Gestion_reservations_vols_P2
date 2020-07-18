
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
    else if ($_SESSION['statut'] != 'Admin') {
    	Redirect::to('index');
    }
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
    </style>
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
                <!-- <span>Saved</span> -->
                <h3><?php echo $_SESSION['prenomUser'] ."/".$_SESSION['nameUser'] ?></h3>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Dashboard</span>
                <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <div class="">
                <div class="btn-group-vertical btn-lg btn-block">
                    <hr>
                    <a href="profil_admin.php" class="btn btn-primary btn-lg btn-block"><i class="fas fa-user-tie mt-2 float-left"></i>Profil</a>
                    <hr>
                    <a href="gestion_vol.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-location-arrow mt-2 float-left"></i>gestion des vols</a>
                    <hr>
                    <a href="historique.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-list-alt float-left mt-2"></i>Historique</a>
                    
                </div>
            </div>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="container">
        <div class="row my-4">
          <div class="col-md-10 mx-auto">
            <?php include('../views/includes/alerts.php');?>
          </div>
        </div>
      </div>
          <!-- <hr> -->
      <div>
          <div class="my-2 p-2 p-5">
              <div class="col-md-6 mx-auto">
                  <center><a href="add_vol.php" class="btn btn-primary my-2 p-4 button_add_vol btn-lg btn-block"><i class="fas fa-plus"></i> ADD NEW VOL</a></center>
                  
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
                          <a class="nav-link active" href="profil_client.php">Votre information</a>
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
                    <button class="btn btn-warning p-3" ><i class="fa fa-edit" ></i>Modifier Votre Information</button>
                </form>
              </div>
          </div>
      </div>
    </main>
  </div>
</div>
<?php
	include_once('../views/includes/footer.php');
?>
