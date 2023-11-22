<?php

namespace App\ChezMamy\tests;

use App\ChezMamy\models\Offres\BesoinsOffresManager;
use App\ChezMamy\models\Offres\ImagesOffresManager;
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

        $this->assertNull($testnull);
        $this->assertCount(1,$test1);
    }

    /**
     * @author Alice Carre
     */
    public function testoneIdOffre(): void
    {

        $image = new ImagesOffresManager();

        $testnull = $image->getOneByIdOffres(20000);
        $test1 = $image->getOneByIdOffres(1);

        $this->assertNull($testnull);
        $this->assertNotNull($test1);
    }


    /**
     * @author Alice Carre
     */
    public function testgetAllByIdInfosOffre(): void
    {

        $offres = new BesoinsOffresManager();

        $testnull = $offres->GetAllByIdInfosOffre(20000);
        $test1 = $offres->GetAllByIdInfosOffre(1);

        $this->assertNull($testnull);
        $this->assertCount(1,$test1);
    }

}