<?php
	class Database {
		private static $db;
		private static $dsn = 'mysql:host=localhost;dbname=final_web;charset=utf8';
		private static  $username = 'root';
		private static $password = '';

		public static function connect() {
			if (!isset(self::$db)) {
				try {
					self::$db = new PDO(self::$dsn,self::$username, self::$password);
				}catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
			return self::$db;
		}
	} 
?>