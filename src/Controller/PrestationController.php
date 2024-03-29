<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;

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
