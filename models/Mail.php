<?php

namespace App\ChezMamy\models;

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
        $headers = "From: ChezMamy <noreply@chezmamy.fr>";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        $destinataires = implode(',', $this->destinataires);

        return mail($destinataires, $this->sujet, $this->contenu, $headers);
    }
}