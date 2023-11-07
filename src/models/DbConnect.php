<?php

namespace App\models;

use PDO;

class DbConnect {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;


        $host = $_ENV['DBHOST'];
        $dbname = $_ENV['DBNAME'];
        $username = $_ENV['USERNAME'];
        $password = $_ENV['PASSWORD'];

        // Connection base de données locale
        self::$instance = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password, $pdo_options);
      }
      return self::$instance;
    }
}
?>