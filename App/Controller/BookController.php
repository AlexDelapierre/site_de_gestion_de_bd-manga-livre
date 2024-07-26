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
    if (isset($_GET['categorie'])) {
      $categorie = htmlspecialchars($_GET['categorie']); // Récupère et échappe la variable pour éviter les injections XSS
    } else {
        // Gérer le cas où la variable n'est pas définie
        $categorie = 'default'; // ou toute autre valeur par défaut
    }

    $books = $this->bookRepository->getBooksByType($categorie);

    $this->render('base', [
      'template' => $template,
      'books' => $books
    ]);
  }

  /*
    Exemple d'appel depuis l'url
    index.php?controller=book&action=show&id=1
  */
  protected function show()
  {
    try {
      if (isset($_GET['id'])) {

        $id = (int)$_GET['id'];
        // Charger le livre par un appel au repository
        // $bookRepository = new BookRepository;
        $book = $this->bookRepository->findOneById($id); 

        $this->render('book/show', [
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