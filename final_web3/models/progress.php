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
			$sql = "INSERT INTO `progress`(`date`, `id_user`, `score`) VALUES (STR_TO_DATE('$date','%d/%m/%Y'),'$idUser', $score)";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}

		public static function UpdateProgressOfUser($idUser, $date, $score) {
			$db = Database::connect();
			$sql = "UPDATE `progress` SET score = $score WHERE id_user = '$idUser' AND date = '$date';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}

		public static function GetProgressOfUserWithDate($idUser, $date) {
			$db = Database::connect();
			$sql = "SELECT * FROM progress WHERE id_user = '$idUser' AND date = STR_TO_DATE('$date','%d/%m/%Y');";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>