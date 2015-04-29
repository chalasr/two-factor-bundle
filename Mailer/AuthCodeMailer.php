<?php
namespace Scheb\TwoFactorBundle\Mailer;

use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;

class AuthCodeMailer implements AuthCodeMailerInterface
{

    /**
     * SwiftMailer
     *
     * @var object $mailer
     */
    private $mailer;

    /**
     * Sender email address
     *
     * @var string $senderEmail
     */
    private $senderEmail;

    /**
     * Sender name
     *
     * @var string $senderName
     */
    private $senderName;

    /**
     * Initialize the auth code mailer with the SwiftMailer object
     *
     * @param object $mailer
     * @param string $senderEmail
     * @param string $senderName
     */
    public function __construct($mailer, $senderEmail, $senderName)
    {
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    /**
     * Send the auth code to the user via email
     *
     * @param \Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface $user
     */
    public function sendAuthCode(TwoFactorInterface $user)
    {
        $message = new \Swift_Message();
        $message
            ->setTo($user->getEmail())
            ->setFrom($this->senderEmail, $this->senderName)
            ->setSubject("Authentication Code")
            ->setBody($user->getEmailAuthCode())
        ;
        $this->mailer->send($message);
    }

}
