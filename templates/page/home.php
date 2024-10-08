<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <div class="col-10 col-sm-8 col-lg-6">
    <img src="public/assets/images/logo-bookeo.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes"
      width="400" loading="lazy">
  </div>
  <div class="col-lg-6">
    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Découvrez ma collection</h1>
    <p class="lead">J'ai le plaisir de vous présenter ma magnifique collection de Livres, de BD et de Manga.</p>
    <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-start">
      <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Primary</button>
      <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
    </div> -->
  </div>
</div>

<div class="row text-center">
  <?php foreach ($books as $key => $book) {
    include('templates/_partials/_card.php');
  } ?>
</div>

<!-- <?php include_once('templates/_partials/_pagination.php') ?> -->