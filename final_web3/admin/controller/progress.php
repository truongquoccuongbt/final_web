<?php
	include '../../models/progress.php';
	class Progress {
		public function DeleteProgress($idUser) {
			ProgressModel::DeleteProgress($idUser);
		}
	}
?>