<?php

namespace App\Controller;

Class PageController extends Controller
{
  public function route(): void
  {
    if (isset($_GET['action'])) {
      switch ($_GET['action']) {
        case 'about':
          //Appeler la méthode about()
          $this->about();
          break;
        case 'home':
          //Appeler la méthode home() 
          var_dump('On appel la méthode home');  
          break;
        default:
          //Erreur
          break; 
      }
    } else {
      //Charger la page d'accueil
    }
  }

  protected function about()
  {
    // On peut passer directement le tableau dans les paramètres de render() sans passer par une variable intermédiaire.
    // $params = [
    //   'test' => 'abc',
    //   'test2' => 'abc2'
    // ];

    $this->render('page/about', [
      'test' => 'abc',
      'test2' => 'abc2'
    ]);
  }
}