<?php

namespace App\Controller;

Class Controller
{
  public function route(): void
  {
    if (isset($_GET['controller'])) {
      switch ($_GET['controller']) {
        case 'page':
          //charger controleur page
          $pageController = new PageController();
          $pageController->route();
          break;
        case 'book':
          //charger controleur book 
          var_dump('On charge BookController');  
          break;
        default:
          //Erreur
          break; 
      }
    } else {
      //Charger la page d'accueil
    }
  }

  protected function render(string $path, array $params = []):void
  {
    $filepath = _ROOTPATH_.'/templates/'.$path.'.php ';

    try {
      if(!file_exists($filepath)) {
        throw new \Exception("Fichier non trouvé : ".$filepath);
      } else {
        // Extrait chaque ligne du tableau et créer des variables pour chacunes
        extract($params);
        require_once $filepath;
      }
    } catch(\Exception $e) {
      echo $e->getMessage();
    }
  }
}