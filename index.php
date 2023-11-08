<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\ChezMamy\controllers\Router\Router;

session_start();

// Définition des constantes
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

// Si aucune langue n'est définie dans l'url, on redirige sur le français par défaut
if(!isset($_GET['lang'])) header("Location: fr/" . $_GET['action'] ?? 'accueil');

// Routeur
$routeur = new Router();
$routeur->routing($_GET, $_POST);