<?php
	include '../models/question_choices.php';
	class QuestionChoice {
		public function GetQuestionChoiceByIdLesson ($idLesson) {
			$question = QuestionChoiceModel::GetQuestionChoiceByIdLesson($idLesson);
			return $question;
		}
	} 
?>