<?php


namespace App\Controller;


use App\Service\Authenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{

    public function homepage(Request $request)
    {
        return $this->render('admin/homepage.html.twig');
    }

    public function generateGoogleSecret(Request $request, Authenticator $authenticator)
    {
        return $this->render('admin/qrCode.html.twig', ['qrCode' => $authenticator->generateGoogleSecret($this->getUser())]);
    }

}