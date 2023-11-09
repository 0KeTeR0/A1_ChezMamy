<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\ChezMamy\controllers\Router\Router;

session_start();

// Définition des constantes
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

// Si aucune langue n'est définie dans l'url ou choisie par l'utilisateur, on redirige sur le français par défaut
if (isset($_SESSION['lang']) &&  (!isset($_GET['lang']) || $_GET['lang'] !== $_SESSION['lang'])) {
    $action = $_GET['action'] ?? 'accueil';
    header("Location: ../{$_SESSION['lang']}/" . $action);
} else {
    if (!isset($_GET['lang'])) header("Location: fr/" . $_GET['action'] ?? 'accueil');
}

if(!str_ends_with($_SERVER['REQUEST_URI'], '/') && !strpos($_SERVER['REQUEST_URI'], "accueil") && empty($_GET['action'])) header("Location: {$_SERVER['REQUEST_URI']}/");

// Routeur
$routeur = new Router();
$routeur->routing($_GET, $_POST);