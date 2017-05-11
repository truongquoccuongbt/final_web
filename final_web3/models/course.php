<?php
	class CourseModel {
		public function GetAllCourse () {
			$db = Database::connect();
			$sql = "SELECT * FROM courses";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public function InsertCourse($idCourse, $nameCourse) {
			$db = Database::connect();
			$sql = "INSERT INTO `courses`(`id_course`, `name_course`) VALUES ('$idCourse','$nameCourse');";
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
	} 
?>