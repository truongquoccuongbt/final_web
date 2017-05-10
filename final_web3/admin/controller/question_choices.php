<?php
	include '../../models/question_choices.php';
	class QuestionChoice {
		public static function GetAllQuesChoi() {
			$listQuesChoi = QuestionChoiceModel::GetAllQuesChoi();
			return $listQuesChoi;
		}

		public static function InsertQuesChoi($idQuesChoi, $idLesson, $contentQues, $choice_1, $choice_2, $choice_3, $picture_1,$picture_2, $picture_3, $answer) {
			QuestionChoiceModel::InsertQuesChoi($idQuesChoi, $idLesson, $contentQues, $choice_1, $choice_2, $choice_3, $picture_1,$picture_2, $picture_3, $answer);
		}
	} 
?>