<?php

namespace App\EventListener;

use App\Entity\Contact;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

class ContactCreationListener
{
    private $mailer;
    private $texter;
    private $toEmail;
    private $toPhone;

    public function __construct(
        MailerInterface $mailer, 
        TexterInterface $texter, 
        string $toEmail, 
        ?string $toPhone = null
    ) {
        $this->mailer = $mailer;
        $this->texter = $texter;
        $this->toEmail = $toEmail;
        $this->toPhone = $toPhone;

    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $contact = $args->getObject();
        if (!$contact instanceof Contact) {
            return;
        }

        $articleLink = 'http://artdesfils.fr/#/produit/' . basename($contact->getReferenceArticle());


        // Send email
        $email = (new Email())
        ->from($this->toEmail)
        ->to($this->toEmail)
        ->subject( " Demande d'information concernant ". $contact->getNomArticle() )
        ->html("
            <html>
                <body style='font-family: Arial, sans-serif; color: #333;'>
                    <table style='width: 100%; max-width: 600px; margin: auto; border-collapse: collapse;'>
                        <tr style='background-color: #f8f8f8;'>
                            <td style='padding: 20px; text-align: center;'>
                                <h2 style='color: #0056b3;'>Demande d'informations</h2>
                            </td>
                        </tr>
                        <tr>
                            <td style='padding: 20px;'>
                                <p>Bonjour,</p>
                                <p>Vous avez reçu une nouvelle demande d'informations concernant l'article suivant :</p>
                                <p><strong>Nom de l'article :</strong> {$contact->getNomArticle()}</p>
                                <p><strong>Référence de l'article :</strong> {$contact->getReferenceArticle()}</p>
                                <p><strong>Voir l'article :</strong> <a href='{$articleLink}'>Lien</a></p>
                                <p><strong>Adresse mail du contact :</strong> {$contact->getEmail() }</p>
                                <hr style='border: none; border-top: 1px solid #ddd; margin: 20px 0;' />
                                <p><strong>Message :</strong></p>
                                <p style='white-space: pre-line;'>{$contact->getMessage()}</p>
                                <hr style='border: none; border-top: 1px solid #ddd; margin: 20px 0;' />
                                <p>Bien cordialement,</p>
                                <p><em>L'art des Fils </em></p>
                            </td>
                        </tr>
                        <tr style='background-color: #f8f8f8;'>
                            <td style='padding: 10px; text-align: center; font-size: 12px; color: #888;'>
                                <p>&copy; 2024 L'art des fils. Tous droits réservés.</p>
                            </td>
                        </tr>
                    </table>'
                </body>
            </html>
        ");
    


        $this->mailer->send($email);

     // Send SMS if phone number is set
        $sms = new SmsMessage(
        $this->toPhone,
        // Contenu du SMS
        "Vous avez reçu une nouvelle demande concernant l'article : " . $contact->getNomArticle() .
        "\nRéférence : " . $contact->getReferenceArticle() .
        "\n\nMessage : " . $contact->getMessage() .
        "\n\n- L'art des fils",
        // Optionnel : numéro "from" si besoin d'un envoi spécifique
        // '+1422222222',
        // Possibilité d'ajouter des options supplémentaires
        // $options
    );
    
    $this->texter->send($sms);
        
    }
}