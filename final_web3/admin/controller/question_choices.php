<?php
	include '../../models/question_choices.php';
	class QuestionChoice {
		public static function GetAllQuesChoi() {
			$listQuesChoi = QuestionChoiceModel::GetAllQuesChoi();
			return $listQuesChoi;
		}
	} 
?>