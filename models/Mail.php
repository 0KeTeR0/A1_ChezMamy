<?php

namespace App\ChezMamy\models;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Classe permettant d'envoyer un mail
 */
class Mail
{
    private array $destinataires;
    private string $sujet;
    private string $contenu;

    /**
     * Construit un mail
     * @param array $destinataires Tableau contenant les adresses mail des destinataires
     * @param string $sujet Sujet du mail
     * @param string $contenu Contenu du mail
     * @author Romain Card
     */
    public function __construct (array $destinataires, string $sujet, string $contenu)
    {
        $this->destinataires = $destinataires;
        $this->sujet = $sujet;
        $this->contenu = $contenu;
    }

    /**
     * Envoie le mail
     * @return bool true si le mail a été envoyé, false sinon
     * @author Romain Card
     */
    public function Envoyer(): bool
    {
        // Configuration du mail
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "noreplychezmamy@gmail.com";
        $mail->Password   = "qkic swzr aqre xqwf";
        $mail->IsHTML(true);

        // Ajout des destinataires
        foreach ($this->destinataires as $dest){
            $mail->AddAddress($dest);
        }

        // Ajout de l'objet
        $mail->Subject = $this->sujet;

        // Définition de l'encodage
        $mail->CharSet = 'UTF-8';

        // Envoyeur
        $mail->SetFrom("noreplychezmamy@gmail.com", "ChezMamy");

        // Ajout du contenu
        $mail->MsgHTML($this->contenu);

        // Envoi du mail
        return $mail->Send();
    }
}