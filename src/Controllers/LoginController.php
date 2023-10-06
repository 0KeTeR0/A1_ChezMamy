<?php

namespace App\Chezmamy\Controllers;


use App\Chezmamy\Model\Connexion;
use App\Chezmamy\Model\UserModel;
use DateTime;

/**
 * Connexion controller for connexions.
 */
class LoginController
{
    public function execute(?array $input)
    {
        $message="";
        if(count($input) > 0) {
            $username = null;
            $password = null;

            if(!empty($input['username']) && !empty($input['password']))
            {
                $username = htmlspecialchars(strip_tags($input['username']));
                $password = $input['password'];
            }
            else throw new \Exception("Veuillez remplir tous les champs.");

            $login = new Login($username, $password);
            $success = $login->checkLogin();
            if(!$success) throw new \Exception("Nom d'utilisateur ou mot de passe incorrect.");
            else {
                $_SESSION['username'] = $username;
                header('Location: index.php');
            }
        }

        require('templates/connexion.php');
    }


}
