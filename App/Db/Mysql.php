<?php

namespace App\Db;

class Mysql
{
  private $db_name; 
  private $db_user; 
  private $db_password; 
  private $db_port; 
  private $db_host; 
  private $pdo;
  private static $_instance = null;

  private function __construct()
  {
    $conf = require_once _ROOTPATH_.'/config.php';

    if (isset($conf['db_name'])) {
      $this->db_name = $conf['db_name'];
    }
    if (isset($conf['$db_user'])) {
      $this->db_user = $conf['db_user'];
    }
    if (isset($conf['db_password'])) {
      $this->db_password = $conf['db_password'];
    }
    if (isset($conf['db_port'])) {
      $this->db_port = $conf['db_port'];
    }
    if (isset($conf['db_host'])) {
      $this->db_host = $conf['db_host'];
    }

  }

  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new mysql();
    }
    return self::$_instance;
  }
}