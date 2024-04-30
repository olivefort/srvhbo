<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    // READ
    #[Route('/membre', name:'membre.index', methods:['GET'])]
    public function index(
        UserRepository $repository
    ): Response
    {
        $members = $repository->findAll();
        return $this->render('pages/user/index.html.twig', [
            'members' => $members,
        ]);
    }

    //CREATE
    #[Route('/membre/nouveau', name:'membre.new', methods:(['GET','POST']))]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $member = new User();
        $form = $this->createForm(UserType::class,$member);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $member = $form->getData();
            $manager->persist($member);
            $manager->flush();

            $this->addFlash(
                'success',
                'Nouveau membre ajouté !'
            );

            return $this->redirectToRoute('member.index');
        }
        return $this->render('pages/user/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    
    // UPDATE
    #[Route('/membre/edition/{id}','membre.edit',methods: ['GET','POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        User $membre
    ) : Response {
        $form = $this->createForm(UserType::class,$membre);
        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $membre = $form->getData();
            $manager->persist($membre);
            $manager->flush();
            $this->addFlash(
                'success',
                'Membre modifié !'
            );
            return $this->redirectToRoute('membre.index');
        }
        return $this->render('pages/membre/edit.html.twig', ['form' => $form->createView()]);
    }

    // DELETE
    #[Route('membre/suppression/{id}', 'membre.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        User $membre
    ):Response{
        // if ($membre->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException();        
        // }else{
            $manager->remove($membre);
            $manager->flush();
        // }

        $this->addFlash(
            'success',
            'La presta a été supprimé avec succès !'
        );

        return $this->redirectToRoute('prestation.index');
    }

    // READ (one)
    #[Route('/p/{id}','membre.show',methods:['GET'])]
    public function show(
        User $membre,
        Request $request
    ): Response
    {
        return $this->render('pages/membre/show.html.twig', [
            'membre' => $membre,
            
        ]);
    }
}
