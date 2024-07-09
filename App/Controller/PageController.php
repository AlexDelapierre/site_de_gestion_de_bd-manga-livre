<?php

namespace App\Controller;

use App\Repository\BookRepository;

Class PageController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'about':
            //Appeler la méthode about()
            $this->about();
            break;
          case 'home':
            //Appeler la méthode home() 
            $this->home();  
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
    $bookRepository = new BookRepository;
    $books = $bookRepository->getBooks(3,5);
    
    echo '<pre>';
        var_dump($books);
    echo '</pre>';
    
    $this->render('page/home', [
      'books' => $books
    ]);
  }

  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=about
  */
  protected function about()
  {
    /* on passe en premier paramètre la page à charger et en 2ème un tableau associatif de paramètres*/
    $this->render('page/about', [
      'test' => 'abc',
      'test2' => 'abc2'
    ]);
  
  } 
}