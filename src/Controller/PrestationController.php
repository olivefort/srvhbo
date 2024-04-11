<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'prestation.index', methods:['GET'])]
    public function index(
        PrestationRepository $repository,
        Request $request
    ): Response
    {
        $prestations = $repository->findAll();
        return $this->render('pages/prestation/index.html.twig', [
            'prestations' => $prestations,
        ]);
    }

    #[Route('/prestation/creation', name:'prestation.new', methods:['GET','POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response 
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prestation = $form->getData();
            $manager->persist($prestation);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre presta a été ajouté avec succès!'
            );

            return $this->redirectToRoute('prestation.index');
        }
        return $this->render('pages/prestation/new.html.twig', 
        [
            'form' => $form->createView()
        ]);
    }

    #[Route('/prestation/edition/{id}','prestation.edit',methods: ['GET','POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        Prestation $prestation
    ) : Response {
        $form = $this->createForm(PrestationType::class,$prestation);
        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prestation = $form->getData();
            $manager->persist($prestation);
            $manager->flush();
            $this->addFlash(
                'success',
                'Presta modifié !'
            );
            return $this->redirectToRoute('prestation.index');
        }
        return $this->render('pages/prestation/edit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('prestation/suppression/{id}', 'prestation.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Prestation $prestation
    ):Response{
        // if ($prestation->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException();        
        // }else{
            $manager->remove($prestation);
            $manager->flush();
        // }

        $this->addFlash(
            'success',
            'La presta a été supprimé avec succès !'
        );

        return $this->redirectToRoute('prestation.index');
    }

    #[Route('/prestation/{id}','prestation.show',methods:['GET'])]
    public function show(
        Prestation $prestation,
        Request $request
    ): Response
    {
        return $this->render('pages/prestation/show.html.twig', [
            'prestation' => $prestation,
            
        ]);
    }
    
}
