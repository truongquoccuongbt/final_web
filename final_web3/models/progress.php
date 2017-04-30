<?php
	class ProgressModel {
		public static function GetProgressOfUser ($idUser) {
			$db = Database::connect();
			$sql = "SELECT * FROM progress WHERE id_user = '$idUser';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>