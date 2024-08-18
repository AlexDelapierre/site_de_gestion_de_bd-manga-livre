<div id="carousel-<?php echo uniqid(); ?>" class="carousel-container">
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
      <button class="prev"><img src="public/assets/icons/PNG/back.png" alt=""></button>
      <button class="next"><img src="public/assets/icons/PNG/next.png" alt=""></button>
    </div>
  </div>
</div>