<?php

namespace App\Repository;

use App\Entity\Book;
use App\Db\Mysql;
use App\Tools\StringTools;
use PDOException;

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

  // public function findBookPaginated(int $page, string $slug, int $limit = 6): array
  // {
  //     //Pour avoir toujours une $limit positive
  //     $limit = abs($limit);

  //     $result = [];

  //     $query = $this->getEntityManager()->createQueryBuilder()
  //         ->select('c', 'p')
  //         ->from('App\Entity\Products', 'p')
  //         ->join('p.categories', 'c')
  //         ->where("c.slug = '$slug'")
  //         ->setMaxResults($limit)
  //         ->setFirstResult(($page * $limit) - $limit);

  //     $paginator = new Paginator($query);
  //     $data = $paginator->getQuery()->getResult();

  //     //On vérifie qu'un a des données
  //     if (empty($data)) {
  //         return $result;
  //     }    

  //     //On calcule le nombre de pages
  //     $pages = ceil($paginator->count() / $limit);

  //     //On remplit le tableau
  //     $result['data'] = $data;
  //     $result['pages'] = $pages;
  //     $result['page'] = $page;
  //     $result['limit'] = $limit;

  //     return $result;
  // }

  public function getBooks(int $limit, int $offset): array 
  {
    // // Appel bdd
    // $mysql = Mysql::getInstance();    
    // $pdo = $mysql->getPDO();

    $query = "
        SELECT b.*, t.*
        FROM book b
        JOIN type t ON b.type_id = b.id
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
 
  public function findBooksPaginated(int $page, int $limit = 6): array 
  {
    $limit = abs($limit);
    $offset = ($page * $limit) - $limit;

    $result = [];

    try {
        $data = $this->getBooks($limit, $offset);
        if (empty($data)) {
            return $result;
        }

        $total = $this->getTotalBooks();
        $pages = ceil($total / $limit);

        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;

    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        error_log($e->getMessage());
        // Vous pouvez également lever une exception personnalisée ici
    }

    return $result;
}
  
  
  public function findOneById(int $id)
  {
    // Appel bdd
    $mysql = Mysql::getInstance();    
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('SELECT * FROM book WHERE id = :id');
    $query->bindValue(':id', $id, $pdo::PARAM_INT);
    $query->execute();
    $book = $query->fetch($pdo::FETCH_ASSOC); //FETCH_ASSOC pour renvoyer un tableau associatif avec uniquement les valeurs dont j'ai besoin.
  
    $bookEntity = new Book();

    // On passe les valeurs avec les setteurs en passant par une boucle foreach 
    foreach ($book as $key => $value) {
      $bookEntity->{'set'.StringTools::toPascalCase($key)}($value);
    }

    return $bookEntity; 
  }
}