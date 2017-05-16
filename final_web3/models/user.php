<?php
	class UserModel {
		public static function get_all_from() {
			$db = Database::connect();
			$sql = "SELECT * FROM users";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public static function GetUserByIdUserAndPassword($idUser,$password) {
			$db = Database::connect();
			$sql = "SELECT `id_user`,`password` FROM users WHERE id_user = '$idUser' AND password = '$password';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public static function InsertUser ($idUser, $password, $email, $firstName, $lastName, $totalScore) {
			$db = Database::connect();
			$sql = "INSERT INTO `users`(`id_user`, `password`, `email`, `first_name`, `last_name`, `total_score`) VALUES ('$idUser','$password','$email','$firstName','$lastName',$totalScore)";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			if ($stmt->errorCode() == 23000) {
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return false;
			}
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return true;
		}

		public static function DeleteUser($idUser) {
			$db = Database::connect();
			$sql = "DELETE FROM `users` WHERE id_user='$idUser'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}
	} 
?>