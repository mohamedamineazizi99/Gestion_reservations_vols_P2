<?php
include_once('../database/DB.php');
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../models/Passager.php');
if(!isset($_SESSION)){
    session_start();
}
    class PassageresController{
        
        public function addPassager(){
			if(isset($_POST['submit'])){
                // $cin = $_POST['cin_passager'];
                if ($_SESSION['typrReservation'] == 1){
                    
                }
                else if ($_SESSION['typrReservation'] == 2){
                    $data = array(
                        'nom_passager' => $_POST['nom_passager'],
                        'prenom_passager' => $_POST['prenom_passager'],
                        'date_de_naissance' => $_POST['date_de_naissance'],
                        'phone_passager' => $_POST['phone_passager'],
                        'email_passager' => $_POST['email_passager'],
                        'cin_passager' => $_POST['cin_passager'],
                        'n_passport_passager' => $_POST['n_passport_passager'],
                        'id_user_created' => $_SESSION['idUser'],
                        $_SESSION['cin_user'] = $_POST['cin_passager'],
                        $_SESSION['email_passager'] = $_POST['email_passager'],
                    );
                    $result	= Passager::add($data);
                    if($result === 'ok exist'){
                        
                        $_SESSION['id_passager'] = 0;
                        $cin_user =$_POST['cin_passager'];
                        $id_user_creat = $_SESSION['idUser'];
                        $stmt2 = DB::connect()->prepare("SELECT * FROM passager WHERE  passager.cin_passager = '{$cin_user}' AND passager.id_user_created = '{$id_user_creat}'");
                        $stmt2 ->execute();
                        if($stmt2->rowCount() > 0){
                            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                // echo '<h5>Nome2 : ' .$row["id_passager"].'</h5>';
                                $_SESSION['id_passager'] = $row["id_passager"];
                            }
                        }
                        
                        Session::set('success','Passager nv Deje exist et reservation Ajoute avec id '.$_SESSION['id_passager'].'et kaayn');
                        // Redirect::to('client');
                    }else if($result === 'ok not_exist'){
                        // $newUser = new UsersController();
                        // $newUser->updateCinUser();
                        
                        Session::set('success','Passager nv not exist et reservation Ajoute avec id '.$_SESSION['id_passager'].'et makaaaynch');
                        // Redirect::to('client');
                    }
                    
                }else if ($_SESSION['typrReservation'] == 3){
                    // $_SESSION['cin_for_user'] = $_POST['cin_passager'];
                    $data = array(
                        'nom_passager' => $_POST['nom_passager'],
                        'prenom_passager' => $_POST['prenom_passager'],
                        'date_de_naissance' => $_POST['date_de_naissance'],
                        'phone_passager' => $_POST['phone_passager'],
                        'email_passager' => $_POST['email_passager'],
                        'cin_passager' => $_POST['cin_passager'],
                        $_SESSION['nv_cin_passager']  => $_POST['cin_passager'],
                        'n_passport_passager' => $_POST['n_passport_passager'],
                        'id_user_created' => $_SESSION['id_client'],
                    );
                    $result	= Passager::add($data);
                    if($result === 'ok'){

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

                        if($_SESSION['statut'] === 'Admin'){



                             
                            // $stmt2 = DB::connect()->prepare('SELECT * FROM `user` WHERE `id` = '.$_SESSION['idUser'].'');
                            // $stmt2 = DB::connect()->prepare('SELECT * FROM passager WHERE passager.email_passager = '.$_POST['email_passager'].'  AND  passager.cin_passager= '.$_POST['cin_passager'].'  AND passager.n_passport_passager= '.$_POST['n_passport_passager'].' AND  passager.id_user_created= '.$_SESSION['id_client'].'');
                            // // $result = $con->prepare($query);
						    // $stmt2 ->execute();
						    // if($stmt2->rowCount() > 0){
							//     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							//     	// echo '<h5>Nome2 : ' .$row["id_passager"].'</h5>';
                            //         // echo '<h5>Prenom : '.$row["prenom"].'</h5>';
                            //         // echo '<h5>Cin : '. $row["cin"].'</h5>';
                            //         // echo '<h5>Email : '. $row["email"].'</h5>';
                            //         $_SESSION['id_passager'] = $row["id_passager"];
							//     }
                            // }
                            
                            // header('location:'.BASE_URL);
                            Session::set('success','Passager Ajoute avec id '.$_SESSION['id_passager'].'et');
                            // Redirect::to('admin');
                        }else if($_SESSION['statut'] === 'User'){
                            // header('location:'.BASE_URL);
                            Session::set('success','Passager Ajoute avec id '.$_SESSION['id_passager'].'et');
                            // Redirect::to('client');
                        }
                        // // header('location:'.BASE_URL);
                        // Session::set('success','Reservation Ajoute');
                        // Redirect::to('home');
                    }else{
                        echo $result;
                    }
                }
			}
        }
    }

?>