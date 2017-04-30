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
	} 
?>