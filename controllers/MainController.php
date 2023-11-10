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
     * @author Valentin Colindre, Romain Card
     */
    public function SendMails(array $data):void{
        $annee = date("Y");
        $destinataires=array("romain.card9@gmail.com");
        $telephone = !empty($data['telephone']) ? "<a href='tel:{$data['telephone']}'>{$data["telephone"]}</a>" : "Non renseigné";
        $sujet = "Contact de ChezMamy - ".$data["sujet"];
        $contenu = nl2br(trim(htmlspecialchars($data["message"])));
        $contenu = "
            <!DOCTYPE html>
            <html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='fr'>
            
            <head>
                <title></title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                <style>
                    * {
                        box-sizing: border-box;
                    }
            
                    body {
                        margin: 0;
                        padding: 0;
                    }
            
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: inherit !important;
                    }
            
                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                    }
            
                    p {
                        line-height: inherit
                    }
            
                    .desktop_hide,
                    .desktop_hide table {
                        mso-hide: all;
                        display: none;
                        max-height: 0px;
                        overflow: hidden;
                    }
            
                    .image_block img+div {
                        display: none;
                    }
            
                    @media (max-width:520px) {
                        .desktop_hide table.icons-inner {
                            display: inline-block !important;
                        }
            
                        .icons-inner {
                            text-align: center;
                        }
            
                        .icons-inner td {
                            margin: 0 auto;
                        }
            
                        .mobile_hide {
                            display: none;
                        }
            
                        .row-content {
                            width: 100% !important;
                        }
            
                        .stack .column {
                            width: 100%;
                            display: block;
                        }
            
                        .mobile_hide {
                            min-height: 0;
                            max-height: 0;
                            max-width: 0;
                            overflow: hidden;
                            font-size: 0px;
                        }
            
                        .desktop_hide,
                        .desktop_hide table {
                            display: table !important;
                            max-height: none !important;
                        }
                    }
                </style>
            </head>
            
            <body style='margin: 0; background-color: #ed4c59; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
                <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ed4c59;'>
                    <tbody>
                        <tr>
                            <td>
                                <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ed4c59; border-radius: 0; color: #000; width: 500px; margin: 0 auto;' width='500'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                                <div class='spacer_block block-1' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; border-radius: 0; color: #000; width: 500px; margin: 0 auto;' width='500'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                                <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                    <tr>
                                                                        <td class='pad' style='padding-bottom:25px;padding-top:25px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                            <div class='alignment' align='center' style='line-height:10px'><img src='https://media.discordapp.net/attachments/1149322185811443742/1172192918354809043/logo.png?ex=655f6cba&is=654cf7ba&hm=e466ef1a652d8e688f765a655b13283087ce551f31507a6d406e81bf6bf0bca4&=' style='display: block; height: auto; border: 0; max-width: 250px; width: 100%;' width='250'></div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class='heading_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                    <tr>
                                                                        <td class='pad' style='padding-bottom:25px;padding-left:40px;padding-right:40px;padding-top:10px;text-align:center;width:100%;'>
                                                                            <h1 style='margin: 0; color: #460b4a; direction: ltr; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 25px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>Message reçu de ChezMamy</span></h1>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class='paragraph_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                    <tr>
                                                                        <td class='pad' style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                            <div style='color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                                <p style='margin: 0;'>Bonjour, {$data['prenom']} {$data['nom']} vous a envoyé un message de contact depuis le site.</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class='paragraph_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                    <tr>
                                                                        <td class='pad' style='padding-bottom:20px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                                                                            <div style='color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                                <p style='margin: 0; margin-bottom: 16px;'><strong>Envoyé par :</strong> {$data['prenom']} {$data['nom']}, {$data['mail']}</p>
                                                                                <p style='margin: 0; margin-bottom: 16px;'><strong>Numéro de téléphone :</strong> {$telephone}</p>
                                                                                <p style='margin: 0; margin-bottom: 16px;'><strong>Sujet :</strong> {$data['sujet']}</p>
                                                                                <p style='margin: 0;'><strong>Message :</strong> $contenu</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class='paragraph_block block-5' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                    <tr>
                                                                        <td class='pad' style='padding-bottom:40px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                            <div style='color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:13px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:15.6px;'>
                                                                                <p style='margin: 0;'>Transférez ce mail à l'adresse email donnée pour répondre au message.</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ed4c59; border-radius: 0; color: #000; width: 500px; margin: 0 auto;' width='500'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                                <table class='paragraph_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                    <tr>
                                                                        <td class='pad'>
                                                                            <div style='color:#fff;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:12px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;'>
                                                                                <center><p style='margin: 0;'>© $annee  ChezMamy</p></center>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><!-- End -->
                            </td>
                        </tr>
                    </tbody>
                </table><!-- End -->
            </body>
            
            </html>
        ";

        $mail = new Mail($destinataires, $sujet, $contenu);

        unset($_POST);

        if(!$mail->Envoyer()) $this->Contact(new Message("Une erreur est survenue lors de l'envoi du mail", "Erreur d'envoi"));
        else $this->Contact(new Message("Votre message a bien été envoyé", "Message envoyé", "success"));
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