<?php

namespace App\Controller\Front\Auth\Register;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SuccessRegisterController extends AbstractController
{
    /**
     * @Route("/inscription/tu-es-bien-inscris", name="register_message_success")
     */
    public function registerOk(): Response
    {
        return $this->render('front/register/register_message_success.twig');
    }
    
}
