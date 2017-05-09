<?php
	include '../../models/chapter.php';
	class Chapter {
		public function GetAllChapter() {
			$listChapter = ChapterModel::GetAllChapter();
			return $listChapter;
		}

		public function GetChapterWithIdCourse($idCourse) {
			$listChapter = ChapterModel::GetChapterWithIdCourse($idCourse);
			return $listChapter;
		}
	} 
?>