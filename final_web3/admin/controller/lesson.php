<?php
	include '../../models/lesson.php';
	class Lesson {
		public static function GetAllLesson() {
			$listLesson = LessonModel::GetAllLesson();
			return $listLesson;
		}

		public function InsertLesson($idLesson, $idChapter, $contentLesson) {
			LessonModel::InsertLesson($idLesson, $idChapter, $contentLesson);
		}
	} 
?>