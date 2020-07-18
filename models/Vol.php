<?php
	if(!isset($_SESSION)){
	        session_start();
	    }
	$id_admin_created = $_SESSION['idUser'];

	class Vol { 
		function __construct() {
			$this->conn = new mysqli("localhost","root","","db_app_vol_aeriens");
		}
		static public function getquery($query){
			$stmt = DB::connect()->prepare('SELECT * FROM `vols` WHERE '.$query.' ');
			$stmt ->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function getOnVol($data){
			$id = $data['id'];
			try{
				$query = 'SELECT * FROM vols WHERE id_vol=:id';
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":id" => $id));
				$vol = $stmt->fetch(PDO::FETCH_OBJ);
				$_SESSION['nb_place_initial'] = $vol->nb_place_initial;
				// $_SESSION['nb_place_rest'] = $vol->nb_place_rest;

				return $vol;
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function add($data){
			$stmt = DB::connect()->prepare('INSERT INTO vols (nam,price,image,pays_depart,pays_arrive,date_vol,hour_vol,minute_vol,nb_place_initial,nb_place_rest,statu_vol,id_admin_created) VALUES(:nam,:price,:image,:pays_depart,:pays_arrive,:date_vol,:hour_vol,:minute_vol,:nb_place_initial,:nb_place_initial,:statu_vol,:id_admin_created)');
			$stmt->bindParam(':nam',$data['nam']);
			$stmt->bindParam(':price',$data['price']);
			$stmt->bindParam(':image',$data['image']);
			$stmt->bindParam(':pays_depart',$data['pays_depart']);
			$stmt->bindParam(':pays_arrive',$data['pays_arrive']);
			$stmt->bindParam(':date_vol',$data['date_vol']);
			$stmt->bindParam(':hour_vol',$data['hour_vol']);
			$stmt->bindParam(':minute_vol',$data['minute_vol']);
			$stmt->bindParam(':nb_place_initial',$data['nb_place_initial']);
			$stmt->bindParam(':nb_place_rest',$data['nb_place_initial']);
			$stmt->bindParam(':statu_vol',$data['statu_vol']);
			$stmt->bindParam(':id_admin_created',$_SESSION['idUser']);

			if($stmt->execute()) {
				return 'ok';
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function update($data){
			$stmt = DB::connect()->prepare('UPDATE vols SET nam = :nam,pays_depart = :pays_depart,pays_arrive = :pays_arrive,date_vol = :date_vol,hour_vol = :hour_vol,minute_vol = :minute_vol,nb_place_initial = :nb_place_initial,price = :price,image = :image WHERE id_vol = :id_vol');
			$stmt->bindParam(':id_vol',$data['id_vol']);
			$stmt->bindParam(':nam',$data['nam']);
			$stmt->bindParam(':pays_depart',$data['pays_depart']);
			$stmt->bindParam(':pays_arrive',$data['pays_arrive']);
			$stmt->bindParam(':date_vol',$data['date_vol']);
			$stmt->bindParam(':hour_vol',$data['hour_vol']);
			$stmt->bindParam(':minute_vol',$data['minute_vol']);
			$stmt->bindParam(':nb_place_initial',$data['nb_place_initial']);
			$stmt->bindParam(':price',$data['price']);
			$stmt->bindParam(':image',$data['image']);
			// die(print_r($data));
			if($stmt->execute()) {
				return 'ok';
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function getAllActive(){

			$date1 = new DateTime;
            $date1 = $date1->format('Y-m-d') ;

            $dateMoins1 = new DateTime('-1 day');
            $dateMoins1 = $dateMoins1->format('Y-m-d') ;

            $stmt = DB::connect()->prepare("SELECT * FROM `vols` WHERE `date_vol` > '{$dateMoins1}' AND `statu_vol` = 'active' AND nb_place_rest > 0  ORDER BY `vols`.`id_vol` DESC");
			$stmt ->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;

		}

		static public function getAllActiveForAdmin(){

			$date1 = new DateTime;
            $date1 = $date1->format('Y-m-d') ;

            $dateMoins1 = new DateTime('-1 day');
			$dateMoins1 = $dateMoins1->format('Y-m-d') ;
			
			$id = $_SESSION['idUser'];

            $stmt = DB::connect()->prepare("SELECT * FROM `vols` WHERE `id_admin_created` = {$id} AND `date_vol` > '{$dateMoins1}' AND `statu_vol` = 'active' AND nb_place_rest > 0  ORDER BY `vols`.`id_vol` DESC");
			$stmt ->execute();

			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function getAllDisabledAndNotExpiredForAdmin(){

			$date1 = new DateTime;
            $date1 = $date1->format('Y-m-d') ;

            $dateMoins1 = new DateTime('-1 day');
			$dateMoins1 = $dateMoins1->format('Y-m-d') ;
			
			$id = $_SESSION['idUser'];

            $stmt = DB::connect()->prepare("SELECT * FROM `vols` WHERE `id_admin_created` = {$id} AND `date_vol` > '{$dateMoins1}' AND `statu_vol` = 'annule' AND nb_place_rest > 0  ORDER BY `vols`.`id_vol` DESC");
			$stmt ->execute();

			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}
		static public function getAllVolsForAdmin(){
			
			$id = $_SESSION['idUser'];

            $stmt = DB::connect()->prepare("SELECT * FROM `vols` WHERE `id_admin_created` = {$id}  ORDER BY `vols`.`id_vol` DESC");
			$stmt ->execute();

			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function getVol(){

			$dateMoins1 = new DateTime('-1 day');
			$dateMoins1 = $dateMoins1->format('Y-m-d') ;
							
			$searchkey = $_SESSION['searchkey'];
            $searchkey1 = $_SESSION['searchkey1'];
			$stmt = DB::connect()->prepare("SELECT * FROM `vols` WHERE pays_depart LIKE '%$searchkey%' AND pays_arrive LIKE '%$searchkey1%'  ANd statu_vol = 'active' AND `date_vol` > '$dateMoins1' ");

			$stmt->bindParam(':pays_depart',$data['vilDepart']);

			$stmt ->execute();
			
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;

		}

		static public function annuler($data){
			$id_vol = $data['id_vol'];
			try{
				$query = "UPDATE vols SET statu_vol='annule' WHERE id_vol=:id_vol";
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":id_vol" => $id_vol));
				if($stmt->execute()) {
					return 'ok';
				}
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function active($data){
			$id_vol = $data['id_vol'];
			try{
				$query = "UPDATE vols SET statu_vol='active' WHERE id_vol=:id_vol";
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":id_vol" => $id_vol));
				if($stmt->execute()) {
					return 'ok';
				}
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function volMoins12($data){
			$stmt2 = DB::connect()->prepare('UPDATE `vols` SET nb_place_rest = nb_place_rest - 1 WHERE id_vol=:id_vol LIMIT 1');
			$stmt2->bindParam(':id_vol',$data);
			$stmt2->execute();

			$stmt2 = null;
		}

		function vol_show_id($id) {

			$query = "SELECT * from vols where id_vol='$id'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			return  $result;
				
		}
	}

?>