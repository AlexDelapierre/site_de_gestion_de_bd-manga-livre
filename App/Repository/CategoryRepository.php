<?php

namespace App\Repository;

use App\Entity\Category;
use App\Db\Mysql;

class CategoryRepository
{
  private $mysql;
  private $pdo;

  public function __construct()
  {
    $this->mysql = Mysql::getInstance();    
    $this->pdo = $this->mysql->getPDO();
  }

  public function getCategoryById(int $id): ?Category
  {
    $query = "SELECT * FROM category WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':id', $id, $this->pdo::PARAM_INT);
    $stmt->execute();
    $categoryData = $stmt->fetch($this->pdo::FETCH_ASSOC);

    if ($categoryData) {
      $category = new Category();
      $category->setId($categoryData['id']);
      $category->setName($categoryData['name']);
      return $category;
    }

    return null;
  }
}
