<?php
include_once('../database/DB.php');
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../models/Vol.php');
	if(!isset($_SESSION)){
        session_start();
    }

	$id_admin_created = $_SESSION['idUser'];

	class VolsController{
        
        public function getVolsquery($query){
			// models
			$vols = Vol::getquery($query);
			return $vols;
		}


		public function getAllVolActive(){
			// models
			$vols = Vol::getAllActive();
			return $vols;
		}

		public function getOneVol(){
			// hadi li radi tretunrni rmployr
			if (isset($_POST['id'])) {
				$data = array(
					'id' => $_POST['id']
				);
				$vol = Vol::getOnVol($data);
				return $vol;
			}
		}

		public function addVol(){
			if(isset($_POST['submit'])){
				$data = array(
					'nam' => $_POST['nam'],
					'price' => $_POST['price'],
					'image' => $_POST['image'],
					// 'date_created' => $_POST['date_created'],
					'pays_depart' => $_POST['pays_depart'],
					'pays_arrive' => $_POST['pays_arrive'],
					'date_vol' => $_POST['date_vol'],
					'hour_vol' => $_POST['hour_vol'],
					'minute_vol' => $_POST['minute_vol'],
					'nb_place_initial' => $_POST['nb_place_initial'],
					'nb_place_rest' => $_POST['nb_place_initial'],
					'statu_vol' => 'active',
					'id_admin_created' => '2',
				);
				$result	= Vol::add($data);
				if($result === 'ok'){
					// header('location:'.BASE_URL);
					Session::set('success','Vol Ajoute avec succès');
					Redirect::to('admin');
				}else{
					echo $result;
				}			
			}
		}

 
		public function updateVol(){
			if(isset($_POST['submit'])){
				$data = array(
					'id_vol' => $_POST['id_vol'],
					'nam' => $_POST['nam'],
					'pays_depart' => $_POST['pays_depart'],
					'pays_arrive' => $_POST['pays_arrive'],
					'date_vol' => $_POST['date_vol'],
					'hour_vol' => $_POST['hour_vol'],
					'minute_vol' => $_POST['minute_vol'],
                    'nb_place_initial' => $_POST['nb_place_initial'],
                    'price' => $_POST['price'],
					'image' => $_POST['image'],
				);
				$result	= Vol::update($data);
				if($result === 'ok'){
					// header('location:'.BASE_URL);
					Session::set('success','Vol modifie avec succès');
					Redirect::to('gestion_vol');
				}else{
					echo $result;
				}			
			}
		}

		public function getVolRecherch(){
			// if (isset($_POST['vilDepart'],$_POST['vilArive'])) {
			// 	$data = array(
			// 		'vilDepart' => $_POST['vilDepart'],
			// 		'vilArive' => $_POST['vilArive'],
			// 	);
			// 	$vol = Vol::getVol($data);
			// 	return $vol;
			// }
			$_SESSION['searchkey'] = $_POST['vilDepart'];
            $_SESSION['searchkey1'] = $_POST['vilArive'];
			$vols = Vol::getVol();
			return $vols;
		}

		public function annulerVol(){
			if(isset($_POST['id_vol'])){
				$data['id_vol'] = $_POST['id_vol'];
				$result = Vol::annuler($data);
				if ($result === 'ok') {
					// header('location:'.BASE_URL);
					Session::set('info','Vol annuler avec succès');
					Redirect::to('gestion_vol');
				}else{
					echo $result;
				}
			}
		}

		public function activeVol(){
			if(isset($_POST['id_vol'])){
				$data['id_vol'] = $_POST['id_vol'];
				$result = Vol::active($data);
				if ($result === 'ok') {
					// header('location:'.BASE_URL);
					Session::set('success','Vol activer avec succès');
					Redirect::to('gestion_vol');
				}else{
					echo $result;
				}
			}
		}

		public function getAllVolsActiveForAdmin(){
			// models
			$volsActive = Vol::getAllActiveForAdmin();
			return $volsActive;
		}
		public function getAllVolsDisabledAndNotExpiredForAdmin(){
			// models
			$vols = Vol::getAllDisabledAndNotExpiredForAdmin();
			return $vols;
		}
		public function getAllVols(){
			// models
			$Allvols = Vol::getAllVolsForAdmin();
			return $Allvols;
		}
		
	}

?>