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
          case 'home':
            $this->home();  
            break;
          case 'livres':
            $this->books();
            break;
          case 'bd':
            $this->bd();  
            break;
          case 'manga':
            $this->manga();  
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
    $books = $bookPaginationService->findBooksPaginated(6);

    // echo '<pre>';
    //     var_dump($books);
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
  index.php?controller=page&action=books
  */
  protected function books()
  {
    $template = 'page/books.php'; 
    $bookRepository = new BookRepository;
    $books = $bookRepository->findAll();

    // echo '<pre>';
    //   var_dump($books);
    // echo '</pre>';
    
    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('base', [
      'template' => $template,
      'books' => $books
    ]);
  }   
  
  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=bd
  */
  protected function bd()
  {
    $template = 'page/bd.php'; 
    
    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('base', [
      'template' => $template,
    ]);
  
  } 
  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=about
  */
  protected function manga()
  {
    $template = 'page/manga.php';
     
    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('base', [
      'template' => $template,
    ]);
  
  } 
}