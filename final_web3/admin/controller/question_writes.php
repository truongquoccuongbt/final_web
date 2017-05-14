<?php
	include '../../models/question_writes.php';
	class QuestionWrite {
		public static function GetAllQuesWri() {
			$listQuesWri = QuestionWriteModel::GetAllQuesWri();
			return $listQuesWri;
		}

		public static function InsertQuesWri($idQuesWri, $idLesson, $contentQues, $answer) {
			$check = QuestionWriteModel::InsertQuesWri($idQuesWri, $idLesson, $contentQues, $answer);
			return $check;
		}
	} 
?>