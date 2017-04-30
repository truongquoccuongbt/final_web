<?php
	require_once '../models/course.php';
	class Course {
		public function GetAllCourse () {
			$listCourse = CourseModel::GetAllCourse();
			return $listCourse;
		}
	}
?>