<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\Mail;
use App\ChezMamy\Views\View;
use PHPMailer\PHPMailer\PHPMailer;

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
        $content = "[Mail envoyé depuis la page Contact de ChezMamy]<br> Prenom:".$data["prenom"]."<br>Nom:".$data["nom"]."<br>Mail:".$data["mail"]."<br>Contenu:<br>".$data["message"];

        $mail = new PHPMailer(); $mail->IsSMTP(); $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "noreplychezmamy@gmail.com";
        $mail->Password   = "qkic swzr aqre xqwf";

        $mail->IsHTML(true);
        foreach ($destinataires as $dest){
            $mail->AddAddress($dest);
        }
        $mail->SetFrom("noreplychezmamy@gmail.com", "ChezMamyContact");

        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            throw new \Exception("Email failed");
        }
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