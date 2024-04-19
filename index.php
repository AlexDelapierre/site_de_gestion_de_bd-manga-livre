<?php
  
  define('_ROOTPATH_', __DIR__);

  // Fonction pour charger les fichiers avec le système de namespace grâce au mot clé use.
  spl_autoload_register();

  use App\Controller\Controller;

  $controller = new Controller();
  $controller->route();

?>