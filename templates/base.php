<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="public/assets/css/style.css">
  <?php
    if ($template === 'page/books.php') {
      echo '<link rel="stylesheet" href="public/assets/css/carousel.css">';
    }
  ?>
</head>

<body>
  <div class="container">
    <?php
        require_once('templates/_partials/_header.php');
      ?>

    <main>
      <?php 
          require_once($template); 
        ?>
    </main>

    <?php
        require_once('templates/_partials/_footer.html');
      ?>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <?php
    if ($template === 'page/books.php') {
      echo '<script src="public/assets/js/carousel.js"></script>';
    }
  ?>
</body>

</html>