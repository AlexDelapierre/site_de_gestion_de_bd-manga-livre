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
    $filepath = "templates/$path.php";
    if(!file_exists($filepath)) {
      render('template/errors/default.php', ['error' => "le fichier $filepath n'existe pas"]);
    }else{
      $params["header"] = file_get_contents("templates/header.php");
      $params["footer"] = file_get_contents("templates/footer.php");
      $code_html = file_get_contents($filepath);
      foreach($params as $key => $value) {
        $code_html = str_replace("[$key]", $value, $code_html);
      }
      print($code_html);
    }
  }
}