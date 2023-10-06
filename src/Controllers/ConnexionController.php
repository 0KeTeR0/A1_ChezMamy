<?php

namespace App\Chezmamy\Controllers;


use App\Chezmamy\Model\Login;
use App\Chezmamy\Model\UserModel;
use DateTime;

/**
 * Login controller for connexions.
 */
class ConnexionController
{
    public function execute(?array $input)
    {




        require('templates/connexion.php');
    }


}
