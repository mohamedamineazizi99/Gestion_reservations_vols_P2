<?php
    class Passager { 

        function __construct() {
			$this->conn = new mysqli("localhost","root","","db_app_vol_aeriens");
        }

        static public function update($data3){
            // $a = $_SESSION['cin'];
            $stmt = DB::connect()->prepare('UPDATE passager SET nom_passager = :nom,prenom_passager = :prenom,email_passager = :email,cin_passager = :cin WHERE id_user_created = :id AND cin_passager = :cin2');
            $stmt->bindParam(':id',$_SESSION['idUser']);
            $stmt->bindParam(':nom',$data3['nom']);
            $stmt->bindParam(':prenom',$data3['prenom']);
            $stmt->bindParam(':email',$data3['email']);
            $stmt->bindParam(':cin2',$_SESSION['cin']);
            $stmt->bindParam(':cin',$data3['cin']);
            // die(print_r($data));
            if($stmt->execute()) {
                return 'ok';
            }else{
                return 'error';
            }
            $stmt->close();
            $stmt = null;
		}

        static public function add($data){
            // if ($_SESSION['typrReservation'] == 1){

            // }
            // else 
            if ($_SESSION['typrReservation'] == 2 || $_SESSION['typrReservation'] == 1){

                $_SESSION['passager_if_exist'] = null;
                $email_passager = $data['email_passager'];
                $id_user_creat = $data['id_user_created'];
                $stmt2 = DB::connect()->prepare("SELECT * FROM passager WHERE  passager.email_passager = '{$email_passager}' AND passager.id_user_created = '{$id_user_creat}'");
                $stmt2 ->execute();
                $contur_test = 0;
                if($stmt2->rowCount() > 0){
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        // echo '<h5>Nome2 : ' .$row["id_passager"].'</h5>';
                        $_SESSION['id_passager'] = $row["id_passager"];
                        $contur_test ++;
                    }
                }
                if($contur_test > 0){
                    $_SESSION['passager_if_exist'] = 'exist';
                    return 'ok exist';
                }else if($contur_test == 0){
                    // $_SESSION['passager_if_exist'] = 'passager_not_exist';
                    $stmt = DB::connect()->prepare('INSERT INTO passager (nom_passager,prenom_passager,date_de_naissance,phone_passager,email_passager,cin_passager,n_passport_passager,id_user_created) VALUES(:nom_passager,:prenom_passager,:date_de_naissance,:phone_passager,:email_passager,:cin_passager,:n_passport_passager,:id_user_created)');
                    $stmt->bindParam(':nom_passager',$data['nom_passager']);
                    $stmt->bindParam(':prenom_passager',$data['prenom_passager']);
                    $stmt->bindParam(':date_de_naissance',$data['date_de_naissance']);
                    $stmt->bindParam(':phone_passager',$data['phone_passager']);
                    $stmt->bindParam(':email_passager',$data['email_passager']);
                    $stmt->bindParam(':cin_passager',$data['cin_passager']);
                    $stmt->bindParam(':n_passport_passager',$data['n_passport_passager']);
                    $stmt->bindParam(':id_user_created',$data['id_user_created']);
                    $_SESSION['cin_user'] = 0;
                    $_SESSION['cin_user'] = $data['cin_passager'];

                    if($stmt->execute()) {
                        $_SESSION['passager_if_exist'] = 'not_exist';
                        return 'ok not_exist';
                    }else{
                        return 'error';
                    }
                    $stmt->close();
                    $stmt = null;                    
                }

            }else if ($_SESSION['typrReservation'] == 3){
                $stmt = DB::connect()->prepare('INSERT INTO passager (nom_passager,prenom_passager,date_de_naissance,phone_passager,email_passager,cin_passager,n_passport_passager,id_user_created) VALUES(:nom_passager,:prenom_passager,:date_de_naissance,:phone_passager,:email_passager,:cin_passager,:n_passport_passager,:id_user_created)');
                $stmt->bindParam(':nom_passager',$data['nom_passager']);
                $stmt->bindParam(':prenom_passager',$data['prenom_passager']);
                $stmt->bindParam(':date_de_naissance',$data['date_de_naissance']);
                $stmt->bindParam(':phone_passager',$data['phone_passager']);
                $stmt->bindParam(':email_passager',$data['email_passager']);
                $stmt->bindParam(':cin_passager',$data['cin_passager']);
                $stmt->bindParam(':n_passport_passager',$data['n_passport_passager']);
                $stmt->bindParam(':id_user_created',$data['id_user_created']);
                $_SESSION['cin_user'] = $data['cin_passager'];
                
                if($stmt->execute()) {
                    return 'ok';
                }else{
                    return 'error';
                }
                $stmt->close();
                $stmt = null;
            }
        }

        function passager_show_id($id) {
            $query = "SELECT * from passager where id_passager='$id'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			return  $result;
				
        }
    }
?>