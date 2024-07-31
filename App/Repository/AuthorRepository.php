<?php

namespace App\Repository;

use App\Entity\Author;
use App\Db\Mysql;

class AuthorRepository
{
  private $mysql;
  private $pdo;

  public function __construct()
  {
    $this->mysql = Mysql::getInstance();    
    $this->pdo = $this->mysql->getPDO();
  }

  public function getAuthorById(int $id): ?Author
  {
    $query = "SELECT * FROM author WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':id', $id, $this->pdo::PARAM_INT);
    $stmt->execute();
    $authorData = $stmt->fetch($this->pdo::FETCH_ASSOC);

    if ($authorData) {
      $author = new Author();
      $author->setId($authorData['id']);
      $author->setLastName($authorData['last_name']);
      $author->setFirstName($authorData['first_name']);
      return $author;
    }

    return null;
  }
}
