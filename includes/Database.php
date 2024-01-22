<?php

require './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

abstract class Database
{
	protected static $connection = null;

	public static function get()
	{
		if (!self::$connection) {
			try {
				self::$connection = self::createConnection();
			} catch (PDOException $e) {
				throw new Exception('Database ERROR');
			}
		}

		return self::$connection;
	}

	protected static function createConnection()
	{
		$host = $_ENV['DB_HOST'];
		$user = $_ENV['DB_USER'];
		$password = $_ENV['DB_PASSWORD'];

		return new PDO($host, $user, $password, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
	}
}


