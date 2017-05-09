<?php
	include '../../models/user.php';
	class User {
		public function GetUserByUserNameAndPass ($idUser, $password) {
			$user = UserModel::GetUserByIdUserAndPassword($idUser, $password);
			return $user;
		}

		public function GetAll() {
			$user = UserModel::get_all_from();
			return $user;
		}

		public function DeleteUser($idUser) {
			UserModel::DeleteUser($idUser);
		}
	} 
?>