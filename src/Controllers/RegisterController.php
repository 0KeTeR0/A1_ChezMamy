<?php

namespace App\Chezmamy\Controllers;


use App\ChezMamy\Model\Register;


class RegisterController
{
    public function execute()
    {
        require('templates/Register.php');
    }
}