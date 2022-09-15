<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PotentielClient;
use App\Form\FormPotentielClientType;
use APY\DataGridBundle\Grid\Grid;
use Doctrine\Persistence\ManagerRegistry;
use APY\DataGridBundle\Grid\Source\Entity;


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

            $this->addFlash('success', 'Client potentiel ajouté avec succès !');
            return $this->redirectToRoute('app_home');

        }   

        return $this->render('views/index.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/potentielClient/{id<[0-9]+>}/edit', name:'app_home_edit', methods:['GET', 'PUT'])]
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $client = $em->getRepository(PotentielClient::class)->find($id);

        $form = $this->createForm(FormPotentielClientType::class, $client, [
            'method' => 'PUT'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($client);
            $em->flush();

            $this->addFlash('success', 'Modification réalisée avec succès !');
            return $this->redirectToRoute('app_home');

        }   

        return $this->render('clients/edit.html.twig', [
            'clients' => $client,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/potentielClient/{id<[0-9]+>}/delete', name:'app_home_delete', methods:['GET', 'DELETE'])]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $client = $em->getRepository(PotentielClient::class)->find($id);
        if($client){
            $em->remove($client);
            $em->flush();
            $this->addFlash('info', 'Potentiel client supprimé !');
            
            return $this->redirectToRoute('app_home');
        }

 
        return $this->redirectToRoute('app_home');
    }

    #[Route('/potentielClient/filter/', name:'app_home_filter')]
    public function filterController(EntityManagerInterface $em, Request $request){

        $filter = $request->get('filtre');
        $clients = $em->getRepository(PotentielClient::class)->filter($filter);
        dd($clients);
        return $this->render('clients/table/table.html.twig', [
            'clients' => $clients
        ]);
    }
}
