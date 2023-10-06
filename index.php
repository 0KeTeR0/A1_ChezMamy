<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Chezmamy\Controllers\HomepageController;
use App\Chezmamy\Controllers\RegisterController;
use App\Chezmamy\Controllers\LoginController;

session_start();

// We catch any error that could happen
try {
    // Configuration of the router to redirect to the right page
    if (!empty($_GET['p'])) {
        $action = $_GET['p'];
        switch ($action) {
            // Register page
            case 'inscription':
                if (!array_key_exists('id_user',$_SESSION))(new RegisterController())->execute($_POST);
                else{header('Location: index.php');}
                break;
            // Login page
            case 'connexion':
                if (!array_key_exists('id_user',$_SESSION))(new LoginController())->execute($_POST);
                else{header('Location: index.php');}
                break;
            // Logout
            case 'deconnexion':
                session_destroy();
                header('Location: index.php');
                break;
            default:
                throw new Exception("404 - La page demandée n'existe pas");
                break;
        }
    }
    else
        (new HomepageController())->execute();
}
catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}