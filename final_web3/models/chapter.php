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

		public function GetAllChapter() {
			$db = Database::connect();
			$sql = "SELECT * FROM chapters;";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public function InsertChapter($idChapter, $idCourse, $nameChapter) {
			$db = Database::connect();
			$sql = "INSERT INTO `chapters`(`id_chapter`, `id_course`, `name_chapter`) VALUES ('$idChapter','$idCourse','$nameChapter');";
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