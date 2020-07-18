<?php
include_once('../database/DB.php');
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../models/User.php');
include_once('../models/Passager.php');

	class UsersController{
		
		public function getAllUser(){
			// models
			$users = User::getAll();
			return $users;
		}

		public function getOneUserInId(){
			if (isset($_POST['id'])) {
				$data = array(
					'id' => $_POST['id']
				);
				$user = User::getUser($data);
				return $user;
			}
		}

		public function loginUser(){
			if (isset($_POST['email'],$_POST['password'])) {
				$data = array(
					'email' => $_POST['email'],
					'password' => $_POST['password'],
				);
				$user = User::login($data);
				return $user;
			}
		}


		public function addUser(){
			if(isset($_POST['submit'])){
				$data = array(
					'nom' => $_POST['nom'],
					'prenom' => $_POST['prenom'],
					'email' => $_POST['email'],
					'password' => $_POST['ConfirmMotpass'],
					'statut' => 'User',
					'cin' => '_',
				);
				$result	= User::add($data);
				if($result === 'ok'){
					// header('location:'.BASE_URL);
					Session::set('success','User Ajoute');
					Redirect::to('login');
				}else{
					echo $result;
				}			
			}
		}
		

		// -----------khedaaam hnaa---------------

		// public function updateUser(){
		// 	if(isset($_POST['submit'])){
		// 		$data = array(
		// 			'id' => $_POST['id'],
		// 			'nom' => $_POST['nom_user_nv'],
		// 			'prenom' => $_POST['Prenom_user_nv'],
		// 			'email' => $_POST['email_nv'],
		// 			'cin' => $_POST['cin_nv'],
		// 			'password' => $_POST['password_nv'],
		// 		);
		// 		$result	= User::update($data);
		// 		if($result === 'ok'){
		// 			$_SESSION['nameUser'] = $_POST['nom_user_nv'];
		// 			$_SESSION['prenomUser'] = $_POST['Prenom_user_nv'];
		// 			$_SESSION['cin'] = $_POST['cin_nv'];
		// 			$_SESSION['email'] = $_POST['email_nv'];
		// 			// header('location:'.BASE_URL);
		// 			if($_SESSION['statut'] === 'Admin'){
		// 				Session::set('success','Admin modifie');
		// 				Redirect::to('admin');
		// 			}else if($_SESSION['statut'] === 'User'){
		// 				// header('location:'.BASE_URL);
		// 				Session::set('success','user modifie');
		// 				Redirect::to('client');
		// 			}
		// 			// Session::set('success','User modifie');
		// 			// Redirect::to('profil_client');
		// 		}else{
		// 			echo $result;
		// 		}			
		// 	}
		// }

		public function updateUser(){
			if(isset($_POST['submit'])){
				$data1 = array(
					'id' => $_POST['id'],
					'email' => $_POST['email_nv'],
					'cin' => $_POST['cin_nv'],
				);
				$result1 = User::verificationUpdate($data1);
				if($result1 == 0){
					$data = array(
						'id' => $_POST['id'],
						'nom' => $_POST['nom_user_nv'],
						'prenom' => $_POST['Prenom_user_nv'],
						'email' => $_POST['email_nv'],
						'cin' => $_POST['cin_nv'],
						'password' => $_POST['password_nv'],
					);
					$result	= User::update($data);
					if($result === 'ok'){
						// $_SESSION['nameUser'] = $_POST['nom_user_nv'];
						// $_SESSION['prenomUser'] = $_POST['Prenom_user_nv'];
						// $_SESSION['cin'] = $_POST['cin_nv'];
						// $_SESSION['email'] = $_POST['email_nv'];
						// header('location:'.BASE_URL);
						$data3 = array(
							'id' => $_POST['id'],
							'nom' => $_POST['nom_user_nv'],
							'prenom' => $_POST['Prenom_user_nv'],
							'email' => $_POST['email_nv'],
							'cin' => $_POST['cin_nv'],
							'cin2' => $_SESSION['cin'],
							'password' => $_POST['password_nv'],
						);
						$result3	= Passager::update($data3);
						if($result3 === 'ok'){
							$_SESSION['nameUser'] = $_POST['nom_user_nv'];
							$_SESSION['prenomUser'] = $_POST['Prenom_user_nv'];
							$_SESSION['cin'] = $_POST['cin_nv'];
							$_SESSION['email'] = $_POST['email_nv'];
							if($_SESSION['statut'] === 'Admin'){
								Session::set('success','Admin modifie AND PASSAger');
								Redirect::to('admin');
							}else if($_SESSION['statut'] === 'User'){
								// header('location:'.BASE_URL);
								Session::set('success','user modifie AND PASSAger');
								Redirect::to('client');
							}
						}else{
							echo $result3;
						}
					}else{
						echo $result;
					}
				}else if($result1 == 1){
					if($_SESSION['statut'] === 'Admin'){
						Session::set('error','Admin verifier votre donne');
						Redirect::to('profil_admin');
					}else if($_SESSION['statut'] === 'User'){
						// header('location:'.BASE_URL);
						Session::set('error','User verifier votre donne');
						Redirect::to('profil_client');
					}
				}else{
					echo $result1;
				}			
			}
		}

		public function updateCinUser(){
			if(isset($_POST['submit'])){
				$data = array(
					'id' => $_SESSION['idUser'],
					'cin' => $_SESSION['nv_cin_passager'],
					'email' =>$_SESSION['email_passager'],
					// 'prenom' => $_POST['prenom'],
					// 'matricule' => $_POST['mat'],
					// 'depart' => $_POST['depart'],
					// 'poste' => $_POST['poste'],
					// 'date_emb' => $_POST['date_emb'],
					// 'statut' => $_POST['statut'],
				);
				$result	= User::updateCin($data);
				if($result === 'ok'){
					// header('location:'.BASE_URL);
					Session::set('success','User modifie avec succès');
					// Redirect::to('home');
				}else{
					echo $result;
				}			
			}
		}
		public function updateCinUsermem(){
			if(isset($_POST['submit'])){
				$data = array(
					'id' => $_SESSION['idUser'],
					'cin' => $_SESSION['cin'],
					'email' =>$_SESSION['email'],
					// 'prenom' => $_POST['prenom'],
					// 'matricule' => $_POST['mat'],
					// 'depart' => $_POST['depart'],
					// 'poste' => $_POST['poste'],
					// 'date_emb' => $_POST['date_emb'],
					// 'statut' => $_POST['statut'],
				);
				$result	= User::updateCin($data);
				if($result === 'ok'){
					// header('location:'.BASE_URL);
					Session::set('success','User modifie avec succès');
					// Redirect::to('home');
				}else{
					echo $result;
				}			
			}
		}
	}

?>