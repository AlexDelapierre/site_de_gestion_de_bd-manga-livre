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
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id
    ";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  public function findAllWithLimit(int $limit): array
  {
    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id
        LIMIT :limit
    ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, $this->pdo::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  public function getBooksByType(): array
  {
    $type = $_GET['action'];

    switch ($type) {
      case 'livres':
        $type_id = 1;
        break;
      case 'manga':
        $type_id = 2;
        break;
      case 'bd':
        $type_id = 3;
        break;
      default:
        $type_id = 1;
        break;
    }

    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id 
        JOIN category ON book.category_id = category.id 
        JOIN author ON author_id = author.id
        WHERE type_id = :type
        ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':type', $type_id, $this->pdo::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  // Version avec tableau d'objet
  // public function getBooksByType(): array
  // {
  //   $type = $_GET['action'];

  //   switch ($type) {
  //     case 'livres':
  //       $type_id = 1;
  //       break;
  //     case 'manga':
  //       $type_id = 2;
  //       break;
  //     case 'bd':
  //       $type_id = 3;
  //       break;
  //     default:
  //       $type_id = 1;
  //       break;
  //   }

  //   $query = "
  //       SELECT *
  //       FROM book 
  //       JOIN type ON book.type_id = type.id 
  //       JOIN category ON book.category_id = category.id 
  //       JOIN author ON author_id = author.id
  //       WHERE type_id = :type
  //       ";
  //   $stmt = $this->pdo->prepare($query);
  //   $stmt->bindValue(':type', $type_id, $this->pdo::PARAM_INT);
  //   $stmt->execute();
  //   $booksData = $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  //   $books = [];

  //   foreach ($booksData as $bookData) {
  //     $bookEntity = new Book();
  //     // On passe les valeurs avec les setteurs
  //     $bookEntity->setId($bookData['id']);
  //     $bookEntity->setTitle($bookData['title']);
  //     $bookEntity->setDescription($bookData['description']);
  //     $bookEntity->setImage($bookData['image']);
  //     $bookEntity->setTypeId($bookData['type_id']);
  //     $bookEntity->setCategoryId($bookData['category_id']);
  //     $bookEntity->setAuthorId($bookData['author_id']);

  //     $books[] = $bookEntity;
  //   }
    
  //   return $books;
  // }

  public function getBooksByCategory(string $type,string $categorie, int $limit, int $offset): array
  {
    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id 
        JOIN category ON book.category_id = category.id 
        JOIN author ON book.author_id = author.id
        WHERE type.name = :type
        AND category.name = :categorie
        LIMIT :limit OFFSET :offset
        ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(':type', $type, $this->pdo::PARAM_STR);
    $stmt->bindValue(':categorie', $categorie, $this->pdo::PARAM_STR);
    $stmt->bindValue(':limit', $limit, $this->pdo::PARAM_INT);
    $stmt->bindValue(':offset', $offset, $this->pdo::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  }

  // Version avec tableau d'objet
  // public function getBooksByCategory(string $type,string $categorie): array
  // {
  //   $query = "
  //       SELECT *
  //       FROM book 
  //       JOIN type ON book.type_id = type.id 
  //       JOIN category ON book.category_id = category.id 
  //       JOIN author ON book.author_id = author.id
  //       WHERE type.name = :type
  //       AND category.name = :categorie
  //       ";
  //   $stmt = $this->pdo->prepare($query);
  //   $stmt->bindValue(':type', $type, $this->pdo::PARAM_STR);
  //   $stmt->bindValue(':categorie', $categorie, $this->pdo::PARAM_STR);
  //   $stmt->execute();
  //   $booksData = $stmt->fetchAll($this->pdo::FETCH_ASSOC);
  //   $books = [];

  //   foreach ($booksData as $bookData) {
  //     $bookEntity = new Book();
  //     // On passe les valeurs avec les setteurs
  //     $bookEntity->setId($bookData['id']);
  //     $bookEntity->setTitle($bookData['title']);
  //     $bookEntity->setDescription($bookData['description']);
  //     $bookEntity->setImage($bookData['image']);
  //     $bookEntity->setTypeId($bookData['type_id']);
  //     $bookEntity->setCategoryId($bookData['category_id']);
  //     $bookEntity->setAuthorId($bookData['author_id']);

  //     $books[] = $bookEntity;
  //   }
    
  //   return $books;
  // }

  // Requête pour la pagination
  public function getBooks(int $limit, int $offset): array 
  {
    $query = "
        SELECT *
        FROM book 
        JOIN type ON book.type_id = type.id
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