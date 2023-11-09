<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\Mail;
use App\ChezMamy\Views\View;

/**
 * Classe MainController
 * Contrôleur principal
 */
class MainController
{
    /**
     * Affiche la page d'accueil
     * @return void
     * @author Romain Card
     */
    public function Index(): void
    {
        // affichage de la vue
        $indexView = new View('Index');
        $indexView->generer([]);
    }

    /**
     * Affiche la page contact
     * @param Message|null $message Message éventuel à afficher
     * @return void
     * @author Valentin Colindre
     */
    public function Contact(?Message $message = null): void
    {
        // affichage de la vue
        $contactView = new View('Contact');
        $contactView->generer(["message" => $message]);
    }

    /**
     * envoi les mails de la page contact
     * @return void
     * @param array $data données du mail
     * @author Valentin Colindre
     */
    public function SendMails(array $data):void{
        $destinataires=array("romain.card9@gmail.com");
        $content = "[Mail envoyé depuis la page Contact de ChezMamy]\n Prenom:".$data["prenom"]."\nNom:".$data["nom"]."\nMail:".$data["mail"]."\nContenu:\n".$data["message"];
        $mail = new Mail($destinataires,"<ChezMamy> Mail Contact",$content);
        $mail->Envoyer();
    }


    /**
     * Affiche la page d'exception
     * @param array|null $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    public function Exception(?array $params = null): void
    {
        $notFoundView = new View('Exception');
        $notFoundView->generer($params);
    }
}