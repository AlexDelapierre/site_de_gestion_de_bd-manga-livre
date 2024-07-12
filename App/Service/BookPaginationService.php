<?php

namespace App\Service;

use App\Repository\BookRepository;
use PDOException;

class BookPaginationService {
    private $bookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    function findBooksPaginated(int $limit = 6): array {
        // Pour avoir toujours une $limit positive
        $limit = abs($limit);

        //On va chercher le numéro de page dans l'url
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
    
        // Calculer l'offset pour la pagination
        $offset = ($page * $limit) - $limit;

        $result = [];

        try {
                // On récupère tous les livres depuis BookRepository avec la limite et l'offset
            $data = $this->bookRepository->getBooks($limit, $offset);
        
            // On vérifie qu'on a des données
            if (empty($data)) {
                return $result;
            }
        
            // On récupère le nombre total de livre depuis BookRepository
            $total = $this->bookRepository->getTotalBooks();
        
            // On calcule le nombre de pages
            $pages = ceil($total / $limit);
        
            // On remplit le tableau
            $result['data'] = $data;
            $result['pages'] = $pages;
            $result['page'] = $page;
            $result['limit'] = $limit;
            $result['path'] = 'index.php?controller=page&action=home';


} catch (PDOException $e) {
// Gérer les erreurs de la base de données
error_log($e->getMessage());
// Vous pouvez également lever une exception personnalisée ici
}

return $result;
}
}