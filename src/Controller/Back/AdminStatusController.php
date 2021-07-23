<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Entity\Status;
use App\Form\Back\AdminTaskAddType;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Status\AdminStatusAddType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Back\Status\AdminStatusModifyType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStatusController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/statut/", name="status_list_admin")
     */
    public function listStatus(StatusRepository $statutAdmin): Response
    {
        return $this->render('back/status/list.html.twig', [
            'status' => $statutAdmin->findBy(array(), array('name' => 'ASC')),
        ]);
    }
    /**
     * @Route("/admin/statut/ajouter", name="status_add_admin")
     */
    public function addStatus(Request $request): Response {
        $statutModify = new Status();
        $form = $this->createForm(AdminStatusAddType::class, $statutModify);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $statutModify = $form->getData();
            $this->entityManager->persist($statutModify);
            $this->entityManager->flush();
            $notification = 'Le statut a bien été ajouté !';
            $statutModify = new Status();
            $form = $this->createForm(AdminStatusAddType::class, $statutModify);
        }
        return $this->render('back/status/add.html.twig', [
            'form_admin_statut_add' => $form->createView(),
            'notification' => $notification
        ]);
    }

    /**
     * @Route("/admin/statut/{id}/modifier", name="status_modify_admin")
     */
    public function modifyQuote(Request $request, Status $statusModify): Response
    {
        $form = $this->createForm(AdminStatusModifyType::class, $statusModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statusModify = $form->getData();
            $this->entityManager->persist($statusModify);
            $this->entityManager->flush();
            $notification = 'Le statut a bien été mise à jour !';
            $form = $this->createForm(AdminStatusModifyType::class, $statusModify);
        }
        return $this->render('back/status/modify.html.twig', [
            'form_status_modify_admin' => $form->createView(),
            'notification' => $notification,
            'status' => $statusModify
        ]);
    }

    /**
     * @Route("/admin/statut/{id}/supprimer", name="status_detete_admin")
     * @param Status $statutDelete
     * return RedirectResponse
     */
    public function deleteStatus(Status $statutDelete): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($statutDelete);
        $em->flush();
        return $this->redirectToRoute("status_list_admin");
    }

}
