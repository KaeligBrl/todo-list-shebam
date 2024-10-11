<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\User\ModifyUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ModifyController extends AbstractController
{
    private $entityManager;
    private $parameterBag;

    public function __construct(EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag)
    {
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @Route("/admin/utilisateurs/{id}/modifier", name="user_modify")
     */
    public function modifyUser(User $userTitle, Request $request): Response
    {
        // Charger les rôles depuis le fichier YAML
        $rolesData = $this->getRolesData();
        $rolesChoices = $this->getRolesChoices($rolesData);

        $form = $this->createForm(ModifyUserType::class, $userTitle, [
            'roles_choices' => $rolesChoices // Passer les choix au formulaire
        ]);

        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Assurez-vous que les rôles sont stockés au format correct
            $roles = $form->get('roles')->getData(); // Récupère les rôles au format tableau
            $user->setRoles($roles); // La méthode setRoles doit accepter un tableau de chaînes

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $notification = 'Informations mises à jour !';
        }

        return $this->render('back/user/modify.html.twig', [
            'form_user_modify_admin' => $form->createView(),
            'notification' => $notification,
            'user' => $userTitle,
        ]);
    }

    private function getRolesData(): array
    {
        // Chemin vers le fichier roles.yaml
        $rolesFilePath = $this->parameterBag->get('kernel.project_dir') . '/config/roles.yaml';
        return Yaml::parseFile($rolesFilePath);
    }

    private function getRolesChoices(array $rolesData): array
    {
        $choices = [];
        foreach ($rolesData['roles'] as $roleKey => $roleConfig) {
            if (isset($roleConfig['label'])) {
                $choices[$roleConfig['label']] = $roleKey; // Utilise la clé comme valeur
            }
        }
        return $choices;
    }
}
