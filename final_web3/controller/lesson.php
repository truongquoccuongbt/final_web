<?php
	require_once '../models/lesson.php';
	class Lesson {
		public function GetLessonByIdChapter ($idChapter) {
			$listLesson = LessonModel::GetLessonByIdChapter($idChapter);
			return $listLesson;
		}
	}
?>