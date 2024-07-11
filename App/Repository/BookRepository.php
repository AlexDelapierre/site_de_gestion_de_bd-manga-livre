<?php

namespace App\Repository;

use App\Entity\Book;
use App\Db\Mysql;
use App\Tools\StringTools;
use PDO;

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

//   function findBooksPaginated(int $page, int $limit = 6): array {
//     // Pour avoir toujours une $limit positive
//     $limit = abs($limit);

//     $result = [];

//     // Calculer l'offset pour la pagination
//     $offset = ($page * $limit) - $limit;

//     // Préparer et exécuter la requête SQL pour obtenir les livres et leurs catégories
//     $query = "
//         SELECT b.*, t.*
//         FROM book b
//         JOIN type t ON b.type_id = t.id
//         LIMIT :limit OFFSET :offset
//     ";

//     $stmt = $this->pdo->prepare($query);
//     $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//     $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//     $stmt->execute();

//     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // On vérifie qu'on a des données
//     if (empty($data)) {
//         return $result;
//     }

//     // Préparer et exécuter la requête SQL pour compter le nombre total de résultats
//     $query = "
//          SELECT COUNT(*)
//          FROM book b
//          ";

//     $stmt = $this->pdo->prepare($query);
//     $stmt->execute();
//     $total = $stmt->fetchColumn();

//     // On calcule le nombre de pages
//     $pages = ceil($total / $limit);

//     // On remplit le tableau
//     $result['data'] = $data;
//     $result['pages'] = $pages;
//     $result['page'] = $page;
//     $result['limit'] = $limit;

//     return $result;
// }


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