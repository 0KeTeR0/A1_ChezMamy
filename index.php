<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Chezmamy\Controllers\HomepageController;

(new HomepageController())->execute();