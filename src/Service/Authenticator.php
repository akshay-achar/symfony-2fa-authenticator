<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;

class Authenticator
{

    private $googleAuthenticator;

    private $entityManager;

    public function __construct(GoogleAuthenticatorInterface $googleAuthenticator, EntityManagerInterface $entityManager)
    {
        $this->googleAuthenticator = $googleAuthenticator;
        $this->entityManager = $entityManager;
    }

    public function generateGoogleSecret(User $user)
    {
        if (true || is_null($user->getGoogleAuthenticatorSecret())) {
            $secret = $this->googleAuthenticator->generateSecret();
            $user->setGoogleAuthenticatorSecret($secret);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $qrCodeContent = $this->googleAuthenticator->getQRContent($user);
            $qrCode = new QrCode($qrCodeContent);
            $qrCode->setWriterByName('png');
            $qrCode->setMargin(10);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));
            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
            $qrCode->setLogoWidth(120);
            $encodedQrCode = 'data:image/png;base64,'.base64_encode(($qrCode->writeString()));
            return  $encodedQrCode;
        } else {
            return  " Secret Already Generated";
        }
    }
}