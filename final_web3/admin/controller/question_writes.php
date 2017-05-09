<?php
	include '../../models/question_writes.php';
	class QuestionWrite {
		public static function GetAllQuesWri() {
			$listQuesWri = QuestionWriteModel::GetAllQuesWri();
			return $listQuesWri;
		}
	} 
?>