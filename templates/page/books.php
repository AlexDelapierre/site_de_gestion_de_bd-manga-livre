<?php foreach ($categories as $categorie) {?>

  <div class="container text-center my-3">

    <a href="index.php?controller=book&action=list&type=<?php echo urlencode($type); ?>&categorie=<?php echo urlencode($categorie); ?>">
      <h2 class="font-weight-light"><?php echo htmlspecialchars($categorie); ?> </h2>
    </a>

    <?php include('templates/_partials/_carousel.php') ?> 

    

  </div>
<?php } ?>   

