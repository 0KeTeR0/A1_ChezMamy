<?php

namespace App\ChezMamy\tests;

use App\ChezMamy\models\Offres\OffresManager;
use PHPUnit\Framework\TestCase;


/**
 * Fichier de test nouvelles méthodes offres controlleur
 * @author Alice Carre
 */
class TestOffresController extends TestCase
{

    /**
     * @author Alice Carre
     */
    public function testgetByName(): void
    {

        $name = new OffresManager;

        $testnull = $name->getByName('AAAAAAAAA');

        $test1 = $name->getByName('Cimetierre');

        $this->assertCount(0,count($testnull));
        $this->assertCount(1,count($test1));
    }

}