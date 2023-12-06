<?php

namespace App\Controller;

Class Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['controller'])) {
        switch ($_GET['controller']) {
          case 'page':
            //charger controleur page
            $pageController = new PageController();
            $pageController->route();
            break;
          case 'book':
            //charger controleur book 
            $pageController = new BookController();
            $pageController->route();  
            break;
          default:
            throw new \Exception("Le controller n'existe pas");
            break; 
        }
      } else {
        //Charger la page d'accueil si pas de controller dans l'url  
        $pageController = new PageController();
            $pageController->home();
      }
    } catch (\Exception $e) {
        $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
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
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}