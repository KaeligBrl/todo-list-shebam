<?php

namespace App\Controller\Back;

use App\Entity\Changelog;
use App\Repository\ChangelogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Back\Changelog\AdminChangelogAddType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChangelogController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/historique-des-changements", name="changelog")
     */
    public function index(ChangelogRepository $changelog): Response
    {
        return $this->render('back/changelog/list.html.twig',[
            'changelogList' => $changelog->findBy(array(), array('created_at' => 'DESC'))
        ]);
    }
    /**
     * @Route("/admin/historique-des-changements/ajouter", name="add_changelog_back")
     */
    public function changelogAdd(Request $request,ChangelogRepository $changelogAdd): Response
    {
        $changelogAdd = new Changelog();
        $form = $this->createForm(AdminChangelogAddType::class, $changelogAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($changelogAdd);
            $this->entityManager->flush();
            $notification = 'L`historique a bien été ajouté';
            $changelogAdd = new Changelog();
            $form = $this->createForm(AdminChangelogAddType::class, $changelogAdd);
        }
        return $this->render('back/changelog/add.html.twig', [
            'form_changelog_add_back' => $form->createView(),
            'notification' => $notification
        ]);
    }

    /**
     * @Route("/admin/changelog/{id}/supprimer", name="delete_changelog_back")
     * @param Changelog $changelogDelete
     * return RedirectResponse
     */
    public function deleteChangelog(Changelog $changelogDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($changelogDelete);
        $em->flush();

        return $this->redirectToRoute("changelog");
    }
}
