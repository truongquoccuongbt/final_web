<?php
	include '../models/progress.php';
	class Progress {
		public function GetProgressOfUser($idUser) {
			$progressOfUser = ProgressModel::GetProgressOfUser($idUser);
			return $progressOfUser;
		}

		public function InsertProgressOfUser($idUser, $date, $score) {
			ProgressModel::InsertProgressOfUser($idUser, $date, $score);
		}

		public function UpdateProgressOfUser($idUser, $date, $score) {
			ProgressModel::UpdateProgressOfUser($idUser, $date, $score);
		}

		public function GetProgressOfUserWithDate($idUser, $date) {
			$progressOfUser = ProgressModel::GetProgressOfUserWithDate($idUser, $date);
			return $progressOfUser;
		}
	} 
?>