<?php
if(!isset($_SESSION)){
        session_start();
    }

	class User { 
		static public function getAll(){
			$stmt = DB::connect()->prepare('SELECT * FROM user');
			$stmt ->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function getUser($data){
			$id = $data['id'];
			try{
				$query = 'SELECT * FROM user WHERE id=:id';
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":id" => $id));
				$user = $stmt->fetch(PDO::FETCH_OBJ);
				return $user;
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function login($data){
			$email = $data['email'];
			$password = $data['password'];
			try{
				$query = 'SELECT * FROM user WHERE email=:email AND password=:password';
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":email" => $email,"password" => $password));
				$user = $stmt->fetch(PDO::FETCH_OBJ);
				// return $user;
				if($user == null){
					Session::set('error','email ou password incorrect');
					Redirect::to('login');
				}else{
					if ($user->statut === 'Admin') {
						$_SESSION['statut'] = $user->statut;
						$_SESSION['idUser'] = $user->id;
						$_SESSION['nameUser'] = $user->nom;
						$_SESSION['prenomUser'] = $user->prenom;
						$_SESSION['cin'] = $user->cin;
						$_SESSION['email'] = $user->email;
						Session::set('success','Wolcom Admin');
						Redirect::to('admin');
					}else if ($user->statut === 'User') {
						$_SESSION['statut'] = $user->statut;
						$_SESSION['idUser'] = $user->id;
						$_SESSION['nameUser'] = $user->nom;
						$_SESSION['prenomUser'] = $user->prenom;
						$_SESSION['cin'] = $user->cin;
						$_SESSION['email'] = $user->email;
						Session::set('success','Wolcom User');
						Redirect::to('client');
					}else{
						// $_SESSION['idUser'] = null;
						Session::set('error','chi probleem tema');
						Redirect::to('login');
					}
					return $user;
				}
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function add($data){


			$email = $data['email'];
			try{
				$query = 'SELECT * FROM user WHERE email=:email';
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":email" => $email));
				$user = $stmt->fetch(PDO::FETCH_OBJ);
				// return $user;
				if ($user == null ) {
					$stmt = DB::connect()->prepare('INSERT INTO user (nom,prenom,email,password,statut,cin) VALUES(:nom,:prenom,:email,:password,:statut,:cin)');
						$stmt->bindParam(':nom',$data['nom']);
						$stmt->bindParam(':prenom',$data['prenom']);
						$stmt->bindParam(':email',$data['email']);
						$stmt->bindParam(':password',$data['password']);
						$stmt->bindParam(':statut',$data['statut']);
						$stmt->bindParam(':cin',$data['cin']);

						if($stmt->execute()) {
							return 'ok';
						}else{
							return 'error';
						}
						$stmt->close();
						$stmt = null;
				}else{
					Session::set('error','User deja exist');
					Redirect::to('inscription');
				}
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

		static public function update($data){
			$stmt = DB::connect()->prepare('UPDATE user SET nom = :nom,prenom = :prenom,email = :email,password = :password,cin = :cin WHERE id = :id');
			$stmt->bindParam(':id',$_SESSION['idUser']);
			$stmt->bindParam(':nom',$data['nom']);
			$stmt->bindParam(':prenom',$data['prenom']);
			$stmt->bindParam(':email',$data['email']);
			$stmt->bindParam(':cin',$data['cin']);
			$stmt->bindParam(':password',$data['password']);
			if($stmt->execute()) {
				
				$stmt2 = DB::connect()->prepare('UPDATE passager SET nom_passager = :nom,prenom_passager = :prenom,email_passager = :email,cin_passager = :cin WHERE id_user_created = :id AND cin_passager = :cin2');
                $stmt2->bindParam(':id',$_SESSION['idUser']);
                $stmt2->bindParam(':nom',$data['nom']);
                $stmt2->bindParam(':prenom',$data['prenom']);
                $stmt2->bindParam(':email',$data['email']);
                $stmt2->bindParam(':cin2',$_SESSION['cin']);
                $stmt2->bindParam(':cin',$data['cin']);
                // die(print_r($data));
                if($stmt2->execute()) {
                    // hena khedmet lcontroler
                    return 'ok';
                }else{
                    return 'error';
                }
                $stmt2->close();
                $stmt2 = null;
				return 'ok';
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}
		
		static public function verificationUpdate($data1){
			$stmt = DB::connect()->prepare('SELECT * FROM `user` WHERE `id` <> :id  AND`cin` = :cin or `email` = :email ');
			$stmt->bindParam(':id',$_SESSION['idUser']);
			$stmt->bindParam(':email',$data1['email']);
			$stmt->bindParam(':cin',$data1['cin']);
			$stmt ->execute();
			if($stmt->rowCount() > 0){
				return 1;
			}else{
				return 0;
			}
			$stmt->close();
			$stmt = null;
		}

		static public function updateCin($data){
			$stmt = DB::connect()->prepare('UPDATE user u ,passager p SET u.cin = :cin WHERE u.id = p.id_user_created and u.id = :id and u.email = :email');
			$stmt->bindParam(':id',$data['id']);
			$stmt->bindParam(':cin',$data['cin']);
			$stmt->bindParam(':email',$data['email']);
			if($stmt->execute()) {
				return 'ok';
			}else{
				// return 'error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function delete($data){
			$id = $data['id'];
			try{
				$query = 'DELETE FROM employes WHERE id=:id';
				$stmt = DB::connect()->prepare($query);
				$stmt->execute(array(":id" => $id));
				if($stmt->execute()) {
					return 'ok';
				}
			}catch(PDOException $ex){
				echo 'erreur'.$ex->getMessage();
			}
		}

	}

?>