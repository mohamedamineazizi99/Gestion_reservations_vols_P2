<?php
include_once('../database/DB.php');
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../models/Reservation.php');
include_once('../controllers/PassageresController.php');
include_once('../controllers/UsersController.php');
include_once('../controllers/VolsController.php');
include_once('../models/Vol.php');
// include_once('../models/Passager.php');
if(!isset($_SESSION)){
    session_start();
}
    class ReservationsController{
        
        public function addReservation(){
			if(isset($_POST['submit'])){
                if ($_SESSION['typrReservation'] == 1){

                    $_SESSION['id_passagerexist'] = 0;
                    $cin_user = $_SESSION['cin'];
                    $id_user_creat = $_SESSION['idUser'];
                    $stmt2 = DB::connect()->prepare("SELECT * FROM passager WHERE  passager.cin_passager = '{$cin_user}' AND passager.id_user_created = '{$id_user_creat}'");
                    $stmt2 ->execute();
                    if($stmt2->rowCount() > 0){
                        while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                            $_SESSION['id_passagerexist'] = $row["id_passager"];
                        }
                    }
                    $data = array(
                        'id_passager' => $_SESSION['id_passagerexist'] ,
                        'id_vol' => $_SESSION['id_voll'],
                    );
                    
                    $result	= Reservation::add($data);
                    if($result === 'ok'){
                        
                        if($_SESSION['statut'] === 'Admin'){
                            Session::set('success','Reservation2 Ajoute');
                            Redirect::to('admin');
                        }else if($_SESSION['statut'] === 'User'){
                            Session::set('success','Reservation2 Ajoute');
                            Redirect::to('client');
                        }
                    }else{
                        echo $result;
                    }

                }else if ($_SESSION['typrReservation'] == 2){
                    $newPassager = new PassageresController();
                    $newPassager->addPassager();
                    $passager_if_exist = 0;
                    $passager_if_exist = $_SESSION['passager_if_exist'];
                    if( $passager_if_exist  === 'exist'  ){

                        $_SESSION['id_passager'] = 0;
                        $cin_user = $_SESSION['cin_user'];
                        $id_user_creat = $_SESSION['idUser'];
                        $stmt2 = DB::connect()->prepare("SELECT * FROM passager WHERE  passager.cin_passager = '{$cin_user}' AND passager.id_user_created = '{$id_user_creat}'");
                        $stmt2 ->execute();
                        if($stmt2->rowCount() > 0){
                            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                // echo '<h5>Nome2 : ' .$row["id_passager"].'</h5>';
                                $_SESSION['id_passager'] = $row["id_passager"];
                            }
                        }
                        $data = array(
                            'id_passager' => $_SESSION['id_passager'] ,
                            'id_vol' => $_SESSION['id_voll'],
                        );
                        $result	= Reservation::add($data);

                        $af = $_SESSION['idUser'];
                        if($_SESSION['statut'] === 'Admin'){
                            Session::set('success','Réservation enregistré avec succès / Bon voyage');
                            Redirect::to('admin');
                        }else if($_SESSION['statut'] === 'User'){
                            Session::set('success','Réservation enregistré avec succès / Bon voyage');
                            Redirect::to('client');
                        }
                        
                    }else if( $passager_if_exist  === 'not_exist'  ){

                        $_SESSION['id_passager'] = 0;
                        $cin_user = $_SESSION['cin_user'];
                        $id_user_creat = $_SESSION['idUser'];
                        $stmt2 = DB::connect()->prepare("SELECT * FROM passager WHERE  passager.cin_passager = '{$cin_user}' AND passager.id_user_created = '{$id_user_creat}'");
                        $stmt2 ->execute();
                        if($stmt2->rowCount() > 0){
                            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                
                                $_SESSION['id_passager'] = $row["id_passager"];
                            }
                        }
                        $newUser = new UsersController();
                        $newUser->updateCinUser();
                        $data = array(
                            'id_passager' => $_SESSION['id_passager'] ,
                            'id_vol' => $_SESSION['id_voll'],
                        );
                        $result	= Reservation::add($data);
                        if($_SESSION['statut'] === 'Admin'){
                            Session::set('success','Réservation pour autre personne enregistré avec succès /N° De Passager : '.$_SESSION['id_passager']);
                            Redirect::to('admin');
                        }else if($_SESSION['statut'] === 'User'){
                            Session::set('success','Réservation pour autre personne enregistré avec succès /N° De Passager : '.$_SESSION['id_passager']);
                            Redirect::to('client');
                        }
                    }

                    
                }else if ($_SESSION['typrReservation'] == 3){

                    $newPassager = new PassageresController();
                    $newPassager->addPassager();

                    $newUser = new UsersController();
                    $newUser->updateCinUsermem();

                    $data = array(
                        'id_passager' => $_SESSION['id_passager'] ,
                        'id_vol' => $_SESSION['id_voll'],
                    );
                    $result	= Reservation::add($data);
                    if($result === 'ok'){

                        if($_SESSION['statut'] === 'Admin'){
                            // header('location:'.BASE_URL);
                            Session::set('success',"C'est votre première réservation / Réservation enregistré avec succès / bon voyage");
                            Redirect::to('admin');
                        }else if($_SESSION['statut'] === 'User'){
                            // header('location:'.BASE_URL);
                            Session::set('success',"C'est votre première réservation / Réservation enregistré avec succès / bon voyage");
                            Redirect::to('client');
                        }
                        
                    }else{
                        echo $result;
                    }
                }
			}
		}
    }























?>