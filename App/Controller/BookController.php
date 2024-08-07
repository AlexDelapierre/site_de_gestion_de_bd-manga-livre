<?php

namespace App\Controller;

use App\Repository\BookRepository;

Class BookController extends Controller
{
  private $bookRepository;

  public function __construct()
  { 
    $this->bookRepository = new BookRepository;
  }

  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'list':
            $this->index();
            break;
          case 'show':
            $this->show();
            break;
          case 'edit':
            // Appeler méthode edit() 
            break;
          case 'add':
            // Appeler méthode add() 
            break;
          case 'delete':
            // Appeler méthode delete() 
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

  protected function index()
  {
    $template = 'book/index.php'; 

    // On récupère le type s'il est passé dans l'URL
    if (isset($_GET['type'])) {
      $type = htmlspecialchars($_GET['type']); // Récupère et échappe la variable pour éviter les injections XSS
    } else {
      // Gérer le cas où la variable n'est pas définie
      $type = 'default'; // ou toute autre valeur par défaut
    }

    // On récupère la catégorie si elle est passée dans l'URL
    if (isset($_GET['categorie'])) {
      $categorie = htmlspecialchars($_GET['categorie']); // Récupère et échappe la variable pour éviter les injections XSS
    } else {
        // Gérer le cas où la variable n'est pas définie
        $categorie = 'default'; // ou toute autre valeur par défaut
    }

    //On récupère tous les livres en BDD
    $books = $this->bookRepository->findAll();

    // Tableau qui va contenir les livres filtrés suivant le type et la catégorie récupéré par $_GET
    $booksByTypeAndCategory = array();
    
    foreach ($books as $book) {
      if ($book->getType()->getName() == $type && $book->getCategory()->getName() == $categorie) {
        $booksByTypeAndCategory[] = $book;
      }
    }

    // echo '<pre>';
    //  var_dump($booksByTypeAndCategory);
    // echo '</pre>';

    $this->render('base', [
      'template' => $template,
      'books' => $booksByTypeAndCategory
    ]);
  }

  /*
    Exemple d'appel depuis l'url
    index.php?controller=book&action=show&id=1
  */
  protected function show()
  {
    $template = 'book/show.php'; 

    try {
      if (isset($_GET['id'])) {

        $id = (int)$_GET['id'];
        // Charger le livre par un appel au repository
        // $bookRepository = new BookRepository;
        $book = $this->bookRepository->findOneById($id); 

        // echo '<pre>';
        //   var_dump($book);
        // echo '</pre>';

        $this->render('base', [
          'template' => $template,
          'title' => $book->getTitle(),
          'description' => $book->getDescription(),
          'image' => $book->getImage()
        ]);
      } else {
        throw new \Exception("L'id est manquant en paramètres");
      }
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}