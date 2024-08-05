<?php 


foreach ($categories as $categorie) {?>

  <div class="container text-center my-3">
    <a href="index.php?controller=book&action=list&type=<?php echo urlencode($type); ?>&categorie=<?php echo urlencode($categorie); ?>">
      <h2 class="font-weight-light"><?php echo htmlspecialchars($categorie); ?> </h2>
    </a>
    <div class="row mx-auto my-auto">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
          <?php 
            $first = true;
            foreach ($books as $book) {
              if ($book->getCategory()->getName() === $categorie) { ?>
                <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>">
                  <div class="col-md-4">
                    <div class="card card-body">
                      <img class="img-fluid" src="upload/books/<?php echo $book->getImage() ?>" alt="<?php echo $book->getImage() ?>">
                    </div>
                  </div>
                </div> 
          <?php }} ?>
        </div>
          <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#" role="button" data-slide="next">
            <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
      </div>
    </div>
  </div>

<?php } 


/*
 foreach ($categories as $categorie) {
  // Générer un identifiant unique pour chaque carrousel
  $carouselId = "recipeCarousel_" . str_replace(' ', '_', $categorie);
?>

  <div class="container text-center my-3">
    <h2 class="font-weight-light"><?php echo $categorie ?> </h2>
    <div class="row mx-auto my-auto">
      <div id="<?php echo $carouselId; ?>" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
          
          <?php 
          $first = true;
          foreach ($books as $book) {
            if ($book->getCategory()->getName() === $categorie) { ?>
              <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>">
                <div class="col-md-4">
                  <div class="card card-body">
                    <img class="img-fluid" src="upload/books/<?php echo $book->getImage() ?>" alt="<?php echo $book->getImage() ?>">
                  </div>
                </div>
              </div> 
          <?php }} ?>

        </div>
          <a class="carousel-control-prev" href="#<?php echo $carouselId; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#<?php echo $carouselId; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
      </div>
    </div>
  </div>

<?php }
*/

?>
