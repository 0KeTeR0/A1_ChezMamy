<?php
namespace App\Chezmamy\Controllers;

use App\ChezMamy\Model\Homepage;

class HomepageController
{
    public function execute()
    {
        require('templates/homepage.php');
    }
}