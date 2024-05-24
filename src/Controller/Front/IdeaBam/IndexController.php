<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
use App\Repository\IdeaBamRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\IdeaBam\AddIdeaBamType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/idebam", name="ideabam")
     */
    public function index(IdeaBamRepository $ideaBamList, Request $request): Response
    {

        $ideaBamAdd = new IdeaBam();
        $form = $this->createForm(AddIdeaBamType::class, $ideaBamAdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($ideaBamAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("ideabam");
        }

        return $this->render('front/ideabam/index.html.twig', [
            'ideas' => $ideaBamList->findBy([], ['subject' => 'ASC']),
            'form_idea_add' => $form->createView(),
        ]);
    }


}
