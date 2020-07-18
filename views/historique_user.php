<?php
	include_once('../controllers/UsersController.php');
	include_once('../database/DB.php');
    include_once('../models/User.php');
    include_once('../models/Reservation.php');
	// include_once('../views/includes/header.php');
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

	<title>Sky flight</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs ">
                    <li class="nav-item">
                        <a class="nav-link " href="profil_client.php">Votre information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="testing2.php">Historique</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h1 class="card-title pb-4">Historique des commandes</h1>
                <!-- ---------------------------------- -->
                <div class="continer p-5">
                    <div id="historique">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Date reservation</th>
                                    <th scope="col">For ?</th>
                                    <th scope="col">Détails</th>
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
                                                echo "you";
                                            }else{
                                                echo "other Parsson";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <button name="view" id="<?= $row['id_reservation']; ?>"
                                        class="btn btn-outline-warning btn-xs view_data"><i class="fas fa-eye"></i>Détails</button>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                            
                        </table>
                        <div>
                        </div>
                    </div>
                </div>
                <!-- ---------------------------------- -->
            </div>
        </div>
    </div>
<!-- ------- -->

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

<!-- ---------------------------------------------------- -->

<!-- Footer -->
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
<!-- Footer -->

<!-- ---------------------------------------------------- -->

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
<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
	</script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
	</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</body>
</html>