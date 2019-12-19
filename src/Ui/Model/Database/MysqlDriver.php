<?php

namespace Ui\Model\Database;
use PDO;
use PDOException;

class MysqlDriver extends PDO{
	private $dsn;
	private $server;
	private $port;
	private $database;
	private $user;
	private $password;
	public function __construct($file='./config/config.ini'){
		$config=parse_ini_file($file,TRUE);
		$this->dsn = $config['MYSQL']['DSN'];
		$this->server = $config['MYSQL']['SERVER'];
		$this->port = $config['MYSQL']['PORT'];
		$this->database = $config['MYSQL']['DATABASE'];
		$this->user = $config['MYSQL']['USER'];
		$this->password = $config['MYSQL']['PASSWORD'];
		$this->dsn = $this->dsn
			.':host='.$this->server
			.';port='.$this->port
			.';dbname='.$this->database;
		#echo "$this->dsn <BR>";
		try {
			parent::__construct($this->dsn,$this->user,$this->password);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			// echo "DB object created";
		} catch (PDOException $e) {
		// echo "<H1>DB ERROR PLEASE ASK TO TO YOUR DBA<> <BR>";

			echo $e->getMessage();
		}
	}
}
