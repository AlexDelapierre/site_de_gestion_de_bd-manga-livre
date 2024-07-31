<?php

namespace App\Repository;

use App\Entity\Type;
use App\Db\Mysql;

class TypeRepository
{
  private $mysql;
  private $pdo;

  public function __construct()
  {
    $this->mysql = Mysql::getInstance();    
    $this->pdo = $this->mysql->getPDO();
  }

  public function getTypeById(int $id): ?Type
  {
    $query = "SELECT * FROM type WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':id', $id, $this->pdo::PARAM_INT);
    $stmt->execute();
    $typeData = $stmt->fetch($this->pdo::FETCH_ASSOC);

    if ($typeData) {
      $type = new Type();
      $type->setId($typeData['id']);
      $type->setName($typeData['name']);
      return $type;
    }

    return null;
  }
}
