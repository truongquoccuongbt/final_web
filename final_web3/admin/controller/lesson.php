<?php
	include '../../models/lesson.php';
	class Lesson {
		public static function GetAllLesson() {
			$listLesson = LessonModel::GetAllLesson();
			return $listLesson;
		}
	} 
?>