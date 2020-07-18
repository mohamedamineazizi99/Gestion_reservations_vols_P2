<?php
include_once('../app/classes/Session.php');
include_once('../app/classes/Redirect.php');
include_once('../controllers/UsersController.php');
include_once('../models/User.php');
include_once('../views/includes/header.php');
	if (isset($_POST['email'])) {
		$exitUser = new UsersController();
		$user = $exitUser->loginUser();
	}else{
		Redirect::to('index');
	}
?>
