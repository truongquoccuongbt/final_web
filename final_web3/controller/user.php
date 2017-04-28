<?php
	include 'models/user.php';
	class User {
		public function GetUserByUserNameAndPass ($idUser, $password) {
			$user = UserModel::GetUserByIdUserAndPassword($idUser, $password);
			return $user;
		}
	} 
?>