<?php $id = $book->getId(); ?>

<div class="col-md-4 my-2 d-flex">
  <div class="card">
    <img src="upload/books/<?php echo $book->getImage(); ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <a href="./?controller=book&id=<?php print($id); ?>&action=show" class="btn btn-primary">Détails</a>
      </p>
    </div>
  </div>
</div>