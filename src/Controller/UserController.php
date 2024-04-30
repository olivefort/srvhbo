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
    #[Route('/membre', name:'member.index', methods:['GET'])]
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
}
