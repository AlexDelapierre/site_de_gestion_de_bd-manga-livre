<?php if ($books['pages'] > 1) { ?>
<nav>
  <ul class="pagination">
    <?php if ($books['page'] > 1) { ?>
    <li class="page-item">
      <a href="<?php print($books['path'].'&page='.($books['page'] -1)) ?>" class="page-link">&lt;</a>
    </li>
    <?php } else { ?>
    <li class="page-item disabled">
      <a class="page-link">&lt;</a>
    </li>
    <?php } ?>

    <?php for ($page=1; $page <= $books['pages'] ; $page++) { ?>
    <li class="page-item <?= ($page == $books['page']) ? 'active' : '' ?>">
      <a href="<?php print($books['path'].'&page='.$page) ?>" class="page-link">
        <?php print($page) ?>
      </a>
    </li>
    <?php } ?>

    <?php if ($books['page'] < $books['pages']) { ?>
    <li class="page-item">
      <a href="<?php print($books['path'].'&page='.($books['page'] +1)) ?>" class="page-link">&gt;</a>
    </li>
    <?php } else { ?>
    <li class="page-item disabled">
      <a class="page-link">&gt;</a>
    </li>
    <?php } ?>





  </ul>
</nav>
<?php } ?>