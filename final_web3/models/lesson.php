<?php
	class LessonModel {
		public function GetLessonByIdChapter ($idChapter) {
			$db = Database::connect();
			$sql = "SELECT * FROM lessons WHERE id_chapter='$idChapter';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>