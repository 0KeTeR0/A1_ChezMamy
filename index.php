<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\ChezMamy\controllers\Router\Router;

session_start();

// Définition des constantes
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

// Si aucune langue n'est définie dans l'url, on redirige sur le français par défaut
if(!isset($_GET['lang'])) header("Location: fr/" . $_GET['action'] ?? 'accueil');

// Récupération des traductions liées à la langue choisie
if(file_exists("views/langs/{$_GET['lang']}.php")) $traductions = require_once("views/langs/{$_GET['lang']}.php");
else $traductions = require_once('views/langs/fr.php');

//récupérer le nom du fichier courant
var_dump($_GET);

// Routeur
$routeur = new Router();
$routeur->routing($_GET, $_POST);