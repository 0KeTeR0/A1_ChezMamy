<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Chezmamy\Controllers\HomepageController;
use App\Chezmamy\Controllers\RegisterController;

try {
    if (!empty($_GET['p'])) {
        $action = $_GET['p'];
        switch ($action) {
            case 'inscription':
                (new RegisterController())->execute($_POST);
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