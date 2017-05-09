<?php
	include '../../models/course.php';
	class Course {
		public static function GetAllCourse() {
			$listLesson = CourseModel::GetAllCourse();
			return $listLesson;
		}
	} 
?>