<?php require_once 'templates/header.php'; 
  // Pour indiquer à PHP que la variable $book est de type Entity. 
  /* @var $book \App\Entity\Book */
?>

<h1><?=$book->getTitle(); ?></h1>
<p><?=$book->getDescription(); ?></p>

<?php require_once 'templates/footer.php'; ?>