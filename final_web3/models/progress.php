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

		public static function InsertProgressOfUser ($idUser, $date, $score) {
			$db = Database::connect();
			$sql = "INSERT INTO `progress`(`date`, `id_user`, `score`) VALUES ('$date','$idUser', $score)";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}
	} 
?>