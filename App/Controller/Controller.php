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
            break;
          case 'book':
            //charger controleur book 
            $pageController = new BookController();
            break;
          default:
            throw new \Exception("Le controller n'existe pas");
        }
        $pageController->route(); 
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
    $filePath = "templates/$path.php";

      try {
          if (!file_exists($filePath)) {
              throw new \Exception("Fichier non trouvé : ".$filePath);
          } else {
              // Extrait chaque ligne du tableau et créer des variables pour chacune
              extract($params);
              require_once $filePath;
          }
      } catch(\Exception $e) {
          $this->render('errors/default', [
              'error' => $e->getMessage()
          ]);
      }

  }

  // protected function render(string $path, array $params = []):void
  // {
  //   $filepath = "templates/$path.php";
  //   if(!file_exists($filepath)) {
  //     $this->render('template/errors/default.php', ['error' => "le fichier $filepath n'existe pas"]);
  //   }else{
  //     $params["header"] = file_get_contents("templates/header.php");
  //     $params["footer"] = file_get_contents("templates/footer.php");
  //     $code_html = file_get_contents($filepath);
  //     foreach($params as $key => $value) {
  //       // Dans le code html du template $path, on remplace "[$key]" par le code html de la clé du tableau $params. 
  //       $code_html = str_replace("[$key]", $value, $code_html);
  //     }
  //     print($code_html);
  //   }
  // }
}