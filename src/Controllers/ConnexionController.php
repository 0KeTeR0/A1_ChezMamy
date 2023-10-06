<?php

namespace App\Chezmamy\Controllers;


use App\Chezmamy\Model\Connexion;
use App\Chezmamy\Model\UserModel;
use DateTime;

/**
 * Connexion controller for connexions.
 */
class ConnexionController
{
    public function execute(?array $input)
    {




        require('templates/connexion.php');
    }


}
