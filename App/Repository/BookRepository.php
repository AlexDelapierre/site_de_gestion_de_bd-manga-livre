<?php

namespace App\Repository;

use App\Entity\Book;
use App\Db\Mysql;

class BookRepository
{
  public function findOneById(int $id)
  {
    // Appel bdd
    $mysql = Mysql::getInstance();
    var_dump($mysql);
    $book = ['id' => 1, 'title' => 'titre test', 'description' => 'description test'];

    $bookEntity = new Book();
    $bookEntity->setId($book['id']); 
    $bookEntity->setTitle($book['title']); 
    $bookEntity->setDescription($book['description']);
    
    // foreach ($book as $key => $value) {
    //   $bookEntity->{'set'}($value);
    // }

    return $bookEntity; 
  }
}