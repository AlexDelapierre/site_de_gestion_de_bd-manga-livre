<?php

namespace App\Service;

use App\Repository\BookRepository;
use PDOException;

class BookPaginationService {
    private $bookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    public function findBooksPaginated(int $page, int $limit = 6): array {
        $limit = abs($limit);
        $offset = ($page * $limit) - $limit;

        $result = [];

        try {
            $data = $this->bookRepository->getBooks($limit, $offset);
            if (empty($data)) {
                return $result;
            }

            $total = $this->bookRepository->getTotalBooks();
            $pagination = $this->paginate($total, $page, $limit);

            $result['data'] = $data;
            $result = array_merge($result, $pagination);

        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            error_log($e->getMessage());
            // Vous pouvez également lever une exception personnalisée ici
        }

        return $result;
    }

    private function paginate(int $total, int $page, int $limit): array {
        $pages = ceil($total / $limit);
        return [
            'page' => $page,
            'limit' => $limit,
            'pages' => $pages,
        ];
    }
}