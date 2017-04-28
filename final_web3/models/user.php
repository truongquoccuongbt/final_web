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

		public static function GetUserByIdUserAndPassword($id_user,$password) {
			$db = Database::connect();
			$sql = "SELECT `id_user`,`password` FROM users WHERE id_user = '$id_user' AND password = '$password';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>