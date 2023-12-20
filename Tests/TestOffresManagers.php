<?php

namespace App\ChezMamy\tests;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\models\Offres\BesoinsOffresManager;
use App\ChezMamy\models\Offres\ImagesOffresManager;
use App\ChezMamy\models\Offres\InfosOffresManager;
use App\ChezMamy\models\Offres\OffresManager;
use App\ChezMamy\models\Offres\OffresSignaleesManager;
use App\ChezMamy\models\Utilisateurs\UtilisateurManager;
use PHPUnit\Framework\TestCase;


/**
 * Fichier de test nouvelles méthodes offres controlleur
 * @author Alice Carre
 */
class TestOffresManagers extends TestCase

{
    //l'id de l'offre temporaire crée pour les tests
    private ?int $idOffreTemp;

    /**
     * Créer une offre temporaire pour les tests
     * @return void
     * @author Valentin Colindre
     */
    private function creationOffreTemporaire():void{
        if(!isset($this->idOffreTemp)){
            $data=[
                "TitreDeLoffre"=>"test",
                "imagesOffres"=>array("null"),
                "surfaceChambre"=>15,
                "Housing"=>1,
                "needs"=>array(1,2,3),
                "adresseLogement"=>"2 rue du text",
                "descriptionOffre"=>"ceci est un test",
                "date_debut_offre"=>"2022-08-03",
                "date_fin_offre"=>"2023-08-03"
            ];
            //10 est un compte admin de test
            $idUtilisateur = 10;
            $offresController = new OffresController();
            $offresController->ajoutOffre($data,$idUtilisateur);
            $offreManager = new OffresManager();
            $this->idOffreTemp= $offreManager->getLast()->getIdOffre();
        }
    }

    /**
     * supprime une offre temporaire pour les tests
     * @return void
     * @author Valentin Colindre
     */
    private function suppressionOffreTemporaire():void{
        if(isset($this->idOffreTemp)){
            $offreManager = new OffresManager();
            $offreManager->deleteByIdOffre($this->idOffreTemp);
            $this->idOffreTemp=null;
        }
    }

    /**
     * @author Alice Carre
     */
    public function testOffresManager(): void
    {
        $this->creationOffreTemporaire();

        $name = new OffresManager;

        $testnull = $name->getByName('AAAAAAAAA');

        $test1 = $name->getByName('test');

        $this->assertNull($testnull);
        $this->assertTrue(Count($test1)>=1);

        $this->suppressionOffreTemporaire();
    }

    /**
     * @author Alice Carre
     */
    public function testImagesOffresManager(): void
    {
        $this->creationOffreTemporaire();

        $image = new ImagesOffresManager();

        $testnull = $image->getOneByIdOffres(20000);
        $test1 = $image->getOneByIdOffres($this->idOffreTemp);

        $this->assertNull($testnull);
        $this->assertNotNull($test1);

        $this->suppressionOffreTemporaire();
    }


    /**
     * @author Alice Carre
     */
    public function testBesoinsOffresManager(): void
    {
        $this->creationOffreTemporaire();

        $offres = new BesoinsOffresManager();

        $testnull = $offres->GetAllByIdInfosOffre(20000);
        $test1 = $offres->GetAllByIdInfosOffre((new InfosOffresManager())->getByIdOffres($this->idOffreTemp)->getIdInfosOffre());

        $this->assertNull($testnull);
        $this->assertCount(1,$test1);

        $this->suppressionOffreTemporaire();
    }

    /**
     * Tests du manager des offres signalées
     * @return void
     * @author Valentin Colindre
     */
    public function testOffresSignaleesManager(): void
    {
        $manager = new OffresSignaleesManager();
        $this->creationOffreTemporaire();

        $this->assertTrue($manager->creationSignalement(1,$this->idOffreTemp));
        $this->assertTrue($manager->deleteByIdOffre($this->idOffreTemp));

        $this->suppressionOffreTemporaire();
    }

}