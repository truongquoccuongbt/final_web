<?php
	include '../models/question_writes.php';
	class QuestionWrite {
		public static function GetQuestionWriteByIdLesson ($idLesson) {
			$question = QuestionWriteModel::GetQuestionWriteByIdLesson($idLesson);
			return $question;
		}
	} 
?>