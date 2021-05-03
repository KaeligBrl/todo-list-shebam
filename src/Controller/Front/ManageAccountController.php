<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManageAccountController extends AbstractController
{
    /**
     * @Route("/compte/gestion-du-compte", name="gestion_compte")
     */
    public function index()
    {
        return $this->render('front/account/manage_account/manage_account.html.twig');
    }
}
