<?php
	include '../models/progress.php';
	class Progress {
		public function GetProgressOfUser($idUser) {
			$progressOfUser = ProgressModel::GetProgressOfUser($idUser);
			return $progressOfUser;
		}
	} 
?>