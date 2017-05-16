<?php
	include '../models/user.php';
	class User {
		public function GetUserByUserNameAndPass ($idUser, $password) {
			$user = UserModel::GetUserByIdUserAndPassword($idUser, $password);
			return $user;
		}

		public function InsertUser($idUser, $password, $email, $firstName, $lastName, $totalScore) {
				$check = UserModel::InsertUser($idUser, $password, $email, $firstName, $lastName, $totalScore);
			return $check;
		}

		public function UpdateTotalScore($idUser, $totalScore) {
			$check = UserModel::UpdateTotalScore($idUser, $totalScore);
			return $check;
		}
	} 
?>