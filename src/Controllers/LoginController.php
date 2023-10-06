<?php

namespace App\Chezmamy\Controllers;


use App\Chezmamy\Model\Login;
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
            $email = null;
            $password = null;

            /* we verify if both values are correct */
            if(!empty($input['email']) && !empty($input['password']))
            {
                if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){$message="email invalide";}
                else{ $email = filter_var(strip_tags($input['email']),FILTER_SANITIZE_EMAIL); }
                if(strlen($input['password'])<=8){$result="mot de passe invalide.";}
                else{ $password = strip_tags($input['password']); }

            }
            else $message=("Veuillez remplir tous les champs.");

            if($message==""){

                $login = new Login();
                $res = $login->execute(array($password,$email));
                if($res[0]==""){
                    $_SESSION['user_id'] = $res[1];
                    header('Location: index.php');
                    $message="succès de la connexion!";
                }
                else{
                    $message=$res[0];
                }
            }
        }


        require('templates/connexion.php');
    }


}
