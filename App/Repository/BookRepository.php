<?php

namespace App\Repository;

use App\Entity\Book;
use App\Db\Mysql;
use App\Tools\StringTools;

class BookRepository
{
  private $mysql;
  private $pdo;

  public function __construct()
  {
    // Appel bdd
    $this->mysql = Mysql::getInstance();    
    $this->pdo = $this->mysql->getPDO(); 
  }

  public function findAll(): array
  {
    $query = "
        SELECT b.*, t.*
        FROM book b
        JOIN type t ON b.type_id = t.id
    ";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  public function getBooksByParentType(): array
  {
    $parentCategorie = $_GET['action'];

    switch ($parentCategorie) {
      case 'livres':
        $parent_id = 1;
        break;
      case 'manga':
        $parent_id = 2;
        break;
      case 'bd':
        $parent_id = 3;
        break;
      default:
        $parent_id = 1;
        break;
    }

    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id 
        JOIN author ON author_id = author.id
        WHERE type.parent_id = :parent_id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':parent_id', $parent_id, $this->pdo::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  public function getBooksByType(string $categorie): array
  {
    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id 
        JOIN author ON author_id = author.id
        WHERE type.name = :categorie
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':categorie', $categorie, $this->pdo::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  // Requête pour la pagination
  public function getBooks(int $limit, int $offset): array 
  {
    $query = "
        SELECT b.*, t.*
        FROM book b
        JOIN type t ON b.type_id = t.id
        LIMIT :limit OFFSET :offset
    ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, $this->pdo::PARAM_INT);
    $stmt->bindValue(':offset', $offset, $this->pdo::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
}

// Requête pour la pagination
 public function getTotalBooks(): int 
 {
     $query = "
         SELECT COUNT(*)
         FROM book b
         ";
     $stmt = $this->pdo->prepare($query);
     $stmt->execute();
     return $stmt->fetchColumn();
 }
  
  public function findOneById(int $id)
  {
    $query = $this->pdo->prepare('SELECT * FROM book WHERE id = :id');
    $query->bindValue(':id', $id, $this->pdo::PARAM_INT);
    $query->execute();
    $book = $query->fetch($this->pdo::FETCH_ASSOC); 
    //FETCH_ASSOC pour renvoyer un tableau associatif avec uniquement les valeurs dont j'ai besoin.
  
    $bookEntity = new Book();

    // On passe les valeurs avec les setteurs en passant par une boucle foreach 
    foreach ($book as $key => $value) {
      $bookEntity->{'set'.StringTools::toPascalCase($key)}($value);
    }

    return $bookEntity; 
  }
}