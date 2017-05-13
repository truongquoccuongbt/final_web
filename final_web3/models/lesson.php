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

		public function GetAllLesson() {
			$db = Database::connect();
			$sql = "SELECT * FROM lessons;";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public function InsertLesson($idLesson, $idChapter, $contentLesson) {
			$db = Database::connect();
			$sql = "INSERT INTO `lessons`(`id_lesson`, `id_chapter`, `content_lesson`) VALUES ('$idLesson','$idChapter','$contentLesson')";
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