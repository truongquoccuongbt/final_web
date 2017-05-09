<?php
	class QuestionChoiceModel {
		public static function GetQuestionChoiceByIdLesson ($idLesson) {
			$db = Database::connect();
			$sql = "SELECT * FROM question_choices WHERE id_lesson='{$idLesson}';";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public static function GetAllQuesChoi() {
			$db = Database::connect();
			$sql = "SELECT * FROM question_choices;";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}
	} 
?>