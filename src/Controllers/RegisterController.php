<?php

namespace App\Chezmamy\Controllers;


use App\ChezMamy\Model\Register;


class RegisterController
{
    public function execute(?array $input)
    {
        if(count($input) > 0) {

        }

        require('templates/Register.php');
    }
}