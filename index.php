<?php
// Ajouter la racine du site au chemin d'accès des fichiers à inclure
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);

// Fonction pour charger les fichiers avec le système de namespace grâce au mot clé use.
function autoloader($class) {
  include_once(str_replace("\\","/","$class.php"));
}
spl_autoload_register('autoloader');

// Chargement de la classe controller
use App\Controller\Controller;
$controller = new Controller();
$controller->route();