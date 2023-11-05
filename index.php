<?php
declare(strict_types=1);

session_start();

require_once('vendor/autoload.php');

use App\ChezMamy\controllers\Router\Router;

// Routeur
$routeur = new Router();
$routeur->routing($_GET, $_POST);