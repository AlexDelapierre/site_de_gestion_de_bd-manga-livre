<div class="carousel-container">
  <div class="inner-carousel">
    <div class="track">

      <?php foreach ($books as $book) { 
        if ($book->getCategory()->getName() === $categorie) { ?>
        
        <div class="card-container">
          <div class="card">
            <img class="img-fluid" src="upload/books/<?php echo $book->getImage() ?>" alt="<?php echo $book->getImage() ?>">
          </div>
        </div>

      <?php }} ?>  
      
    </div>
    <div class="nav">
      <button class="prev"><i class="fas fa-arrow-left fa-2x"></i></button>
      <button class="next"><i class="fas fa-arrow-right fa-2x"></i></button>
    </div>
  </div>
</div>