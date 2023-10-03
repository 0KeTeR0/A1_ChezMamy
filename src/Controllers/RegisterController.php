<?php

namespace App\Chezmamy\Controllers;


use App\ChezMamy\Model\Register;


class RegisterController
{
    public function execute(?array $input)
    {
        if(count($input) > 0) {
            $username = null;
            $password = null;
            $passwordRepeat = null;

            if(!empty($input['username']) && !empty($input['password']) && !empty($input['passwordRepeat']))
            {
                $username = htmlspecialchars(strip_tags($input['username']));
                $password = $input['password'];
                $passwordRepeat = $input['passwordRepeat'];
            }
            else throw new \Exception("Veuillez remplir tous les champs.");

            $register = new Register($username, $password, $passwordRepeat);
            $res = $register->execute();
            if(!$res['success']) throw new \Exception($res['message']);
            else {
                header('Location: index.php?action=login');
            }
        }

        require('templates/Register.php');
    }
}