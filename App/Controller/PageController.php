<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\BookPaginationService;

Class PageController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'about':
            $this->about();
            break;
          case 'accueil':
            $this->home();  
            break;
          case 'livre':
            $this->books();
            break;
          case 'BD':
            $this->books();  
            break;
          case 'manga':
            $this->books();  
            break;
          default:
            http_response_code(404);
            throw new \Exception("<h2>Erreur 404</h2>Cette page n'existe pas (action <strong>$_GET[action]</strong>)");
            break; 
        }
      } else {
        throw new \Exception("Aucune action détectée");
      }
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }

  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=home
  */
  protected function home()
  {
    $template = 'page/home.php'; 
    $bookRepository = new BookRepository;
    $bookPaginationService = new BookPaginationService($bookRepository);
    $books = $bookRepository->findAll();

    // echo '<pre>';
    // var_dump($books);
    // echo '</pre>';
        
    $this->render('base', [
      'template' => $template,
      'books' => $books
    ]);
  }

  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=about
  */
  protected function about()
  {
    $template = 'page/about.php'; 

    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('base', [
      'template' => $template,
    ]);
  
  } 

  /*
  Exemple d'appel depuis l'url
  index.php?controller=page&action=livres
  index.php?controller=page&action=bd
  index.php?controller=page&action=manga
  */
  protected function books()
  {
    $template = 'page/books.php'; 
    $bookRepository = new BookRepository;
    // $books = $bookRepository->getBooksByType();
    $books = $bookRepository->findAll();

    // Type des livres
    $type = $_GET['action'];

    // Tableau qui va contenir les livres suivant le type récupéré par $_GET
    $booksByType = array();

    foreach ($books as $book) {
      if ($book->getType()->getName() == $type) {
        $booksByType[] = $book;
      }
    }

    // Tableau pour stocker les différentes catégories de livres
    $categories = array();

    // Parcourir le tableau des livres
    foreach ($booksByType as $bookByType) {
      $category = $bookByType->getCategory();
      if (isset($category) && !in_array($category->getName(), $categories)) {
        // Ajouter la catégorie au tableau $categories si elle n'existe pas déjà
        $categories[] = $category->getName();
      }
    }

    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('base', [
      'template' => $template,
      'type' => $type,
      'categories' => $categories,
      'books' => $booksByType
    ]);
  }   
}