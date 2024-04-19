<?php

namespace App\Controller;

Class PageController extends Controller
{
  public function route(): void
  {
    try {
      //code...
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
            throw new \Exception("Cette action n'existe pas :".$_GET['action']);
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

  /*
    Exemple d'appel depuis l'url
    index.php?controller=page&action=home
  */
  protected function home()
  {
    $this->render('page/home', [
    ]);
  }
}