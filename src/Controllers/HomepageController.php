<?php
namespace App\ChezMamy\Controllers;

use App\ChezMamy\Model\Homepage;

class HomepageController
{
    public function execute()
    {
        require('templates/homepage.php');
    }
}