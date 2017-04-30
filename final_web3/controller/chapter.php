<?php
	require_once '../models/chapter.php';
	class Chapter {
		public function GetChapterWithIdCourse ($idCourse) {
			$listChapter = ChapterModel:: GetChapterWithIdCourse($idCourse);
			return  $listChapter;
		}
	}
?>