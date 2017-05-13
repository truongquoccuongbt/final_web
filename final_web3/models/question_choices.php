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

		public function InsertQuesChoi($idQuesChoi, $idLesson, $contentQues, $choice_1, $choice_2, $choice_3, $picture_1,$picture_2, $picture_3, $answer) {
			$db = Database::connect();
			$sql = "INSERT INTO `question_choices`(`id_question_choice`, `id_lesson`, `content_question`, `choice_1`, `choice_2`, `choice_3`, `picture_1`, `picture_2`, `picture_3`, `answer`) VALUES ('$idQuesChoi','$idLesson','$content_question','$choice_1','$choice_2','$choice_3','$picture_1','$picture_2','$picture_3',$answer);";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}
	} 
?>