<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\IdeaBam\ModifyIdeaBamType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/idebam/modifier/{id}", name="modify_ideabam")
     */
    public function index(IdeaBam $ideaBamModify, Request $request): Response
    {

        $notification = null;
        $form = $this->createForm(ModifyIdeaBamType::class, $ideaBamModify);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ideaBamModify = $form->getData();
            $this->entityManager->persist($ideaBamModify);
            $this->entityManager->flush();
            $notification = "L'idée a bien été modifiée";
            return $this->redirectToRoute("ideabam");
        }

        return $this->render('front/ideabam/modify.html.twig', [
            'form_idea_modify' => $form->createView(),
            'notification' => $notification,
            'idea' => $ideaBamModify
        ]);
    }


}
