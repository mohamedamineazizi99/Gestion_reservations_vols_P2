<?php
	include_once('../controllers/UsersController.php');
	include_once('../database/DB.php');
    include_once('../models/User.php');
    include_once('../models/Reservation.php');
	include_once('../app/classes/Session.php');
	if(!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION['idUser'] == null) {
    	Redirect::to('index');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Historiqur</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <a href="profil_admin.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-user-tie mt-2 float-left"></i>Profil</a>
                    <hr>
                    <a href="gestion_vol.php" class="btn btn-info btn-lg btn-block"><i class="fas fa-location-arrow mt-2 float-left"></i>gestion des vols</a>
                    <hr>
                    <a href="historique.php" class="btn btn-primary btn-lg btn-block"><i class="fas fa-list-alt float-left mt-2"></i>gestion des Historique</a>
                    
                </div>
            </div>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
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
        <h2>Historique</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm table-hover">
            <thead>
                <tr>
                <th>#Id</th>
                <th>Date reservation</th>
                <th>Passager</th>
                <th>Autre Détails</th>
                </tr>
            </thead>
                <?php
                $info = new Reservation();
                $res = $info -> reservation_join();
                ?>
                <tbody>
                    <tr>
                        <?php foreach ($res as $row):?>
                        <td><?= $row['id_reservation']; ?></td>
                        <td><?= $row['date_reservation']; ?></td>
                        <td>
                            <?php
                                if($row['cin_passager'] === $_SESSION['cin']){
                                    echo "POUR VOUS";
                                }else{
                                    echo "AUTRE PASSAGER";
                                }
                            ?>
                        </td>
                        <td>
                            
                            <button name="view" id="<?= $row['id_reservation']; ?>"
                            class="btn btn-outline-warning btn-xs view_data"><i class="fas fa-eye"></i>Détails</button>

                                
                        </td>
                    </tr>
                    <?php 
                        // } 
                    ?>
                    <?php endforeach;?>
                </tbody>
            </table>
            <!-- --------------------------------------------------- -->
            
            <div class="modal fade p-5" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalCenterTitle">détails de Reservation</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="detail">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- --------------------------------------------------- -->
        </div>
    </main>
  </div>
</div>

 <canvas class="my-4 w-100" id="myChart" width="900" height="80"></canvas>

<hr>

<footer class="page-footer font-small grey lighten-3 py-4 dark-grey-text">

  <!-- Footer Elements -->
  <div class="container">

    <div class="row">
      <div class="col-md-4">
        <h3 class="font-weight-bold mb-0">T-aér</h3>
      </div>
      <div class="col-md-4">
        <ul class="list-unstyled d-flex justify-content-center mb-0 mt-2">
          <li>
          	<!-- <a class="mx-3" role="button">About</a> -->
          </li>
          <li>
          	<!-- <a class="mx-3" role="button">Blog</a> -->
          </li>
          <li>
          	<!-- <a class="mx-3" role="button">Policy</a> -->
          </li>
          <li>
          	<!-- <a class="mx-3" role="button">Contact</a> -->
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <!-- Copyright -->
        <div class="footer-copyright text-right bg-transparent dark-grey-text mt-2">© 2020.
          <a class="dark-grey-text" href="#"> By Taoufiq RHOUAS.</a>
        </div>
        <!-- Copyright -->
      </div>
    </div>

  </div>
  <!-- Footer Elements -->

</footer>
   

<script>
        $(document).ready(function () {
            $('.view_data').click(function () {
                var rid = $(this).attr("id");
                $.ajax({
                    url: "../controllers/historique_user.php",
                    method: "post",
                    data: {
                        rid: rid
                    },
                    success: function (data) {
                        $('#detail').html(data);
                        $('#exampleModalCenter').modal("show");
                    }
                });
            });
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
	</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</body>
</html>

