<?php
	class QuestionWriteModel {
		public static function GetQuestionWriteByIdLesson ($idLesson) {
			$db = Database::connect();
			$sql = "SELECT * FROM question_writes WHERE id_lesson='{$idLesson}';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>