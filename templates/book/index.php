<div class="row text-center">
  <?php foreach ($books as $key => $book) {
    include('templates/_partials/book_partial.php');
  } ?>
</div>

<?php include_once('templates/_partials/_pagination.php') ?>