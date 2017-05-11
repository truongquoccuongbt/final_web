<?php
	include '../../models/course.php';
	class Course {
		public static function GetAllCourse() {
			$listLesson = CourseModel::GetAllCourse();
			return $listLesson;
		}

		public static function InsertCourse($idCourse, $nameCourse) {
			$check = CourseModel::InsertCourse($idCourse, $nameCourse);
			return $check;
		}
	} 
?>