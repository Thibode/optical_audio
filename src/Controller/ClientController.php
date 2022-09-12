<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PotentielClient;
use App\Form\FormPotentielClientType;
use App\Repository\PotentielClientRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientController extends AbstractController
{
    #[Route('/', name:'app_home', methods:['GET'])]
    
    public function index()
    {
        return $this->render('views/index.html.twig');
    }

    #[Route('/', name: 'app_home')]
    public function potentielClient(Request $request, EntityManagerInterface $em, ManagerRegistry $doctrine): Response
    {
        $potentielClient = new PotentielClient;
        $form = $this->createForm(FormPotentielClientType::class, $potentielClient);
        $clients = $doctrine->getRepository(PotentielClient::class)->findAll();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($potentielClient);
            $em->flush();
        }   

        return $this->render('views/index.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    public function showPotentielClient(ManagerRegistry $doctrine, int $id): Response
    {
        $clients = $doctrine->getRepository(PotentielClient::class)->find($id);

        return $this->render('clients/table.html.twig', [
            
        ]);
    }
}
