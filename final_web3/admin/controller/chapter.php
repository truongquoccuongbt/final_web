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

		public function InsertChapter($idChapter, $idCourse, $nameChapter) {
			$check = ChapterModel::InsertChapter($idChapter, $idCourse, $nameChapter);
			return $check;
		}
	} 
?>