<?php

include_once('../controllers/VolsController.php');
include_once('../models/Vol.php');

include_once('../database/DB.php');
	if (isset($_POST['id_vol'])) {
		$exitVol = new VolsController();
		$exitVol->activeVol();
	}


?>