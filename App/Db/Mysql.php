<?php

namespace App\Db;

class Mysql
{
  private $db_connect;
  private $db_user; 
  private $db_password; 
  private $pdo = null;
  private static $_instance = null;

  // Singleton pattern design
  private function __construct()
  {
    // $config = require_once _ROOTPATH_.'/config.php';
    $config = require_once('config.php');

    if (isset($config)) {
      $this->db_connect = $config["db_connect"];
      $this->db_user = $config["db_user"];
      $this->db_password = $config["db_password"];
    }
  }

  public static function getInstance(): self
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new mysql();
    }
    return self::$_instance;
  }

  public function getPDO() 
  {
    if (is_null($this->pdo)) {
      $this->pdo = new \PDO($this->db_connect, $this->db_user, $this->db_password);
    }
    return $this->pdo;
  }
}