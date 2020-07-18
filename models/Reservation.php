<?php
include_once('../database/DB.php');
    class Reservation { 

		function __construct() {
			$this->conn = new mysqli("localhost","root","","db_app_vol_aeriens");
		}

        function add($data){
			$stmt = DB::connect()->prepare('INSERT INTO reservations (id_vol,id_passager) VALUES(:id_vol,:id_passager)');
			$stmt->bindParam(':id_vol',$data['id_vol']);
			$stmt->bindParam(':id_passager',$data['id_passager']);
			
			if($stmt->execute()) {
				
				$exitVolForUpdat = new Vol();
				$exitVolForUpdat->volMoins12($_SESSION['id_voll']);
				return 'ok';
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}

		function reservation_show_id($id) {

			$query = "SELECT * from reservations where id_reservation='$id'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			return  $result;
				
		}

		function reservation_join() {
			$idUser = $_SESSION['idUser'];
			$query = "SELECT r.*,p.cin_passager FROM reservations r,passager p,user u  WHERE r.id_passager = p.id_passager AND p.id_user_created = u.id AND u.id ='$idUser' ORDER BY r.date_reservation DESC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			return  $result;
				
		}
    }
?>