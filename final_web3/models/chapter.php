<?php
	class ChapterModel {
		public function GetChapterWithIdCourse ($idCourse) {
			$db = Database::connect();
			$sql = "SELECT * FROM chapters WHERE id_course='$idCourse'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>