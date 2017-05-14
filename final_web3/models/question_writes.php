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

		public static function GetAllQuesWri() {
			$db = Database::connect();
			$sql = "SELECT * FROM question_writes;";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $result;
		}

		public static function InsertQuesWri($idQuesWri, $idLesson, $contentQues, $answer) {
			$db = Database::connect();
			$sql = "INSERT INTO `question_writes`(`id_question_write`, `id_lesson`, `content_question`, `answer`) VALUES ('$idQuesWri','$idLesson','$contentQues','$answer');";
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