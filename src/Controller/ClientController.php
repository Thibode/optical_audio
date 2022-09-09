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

class ClientController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('views/index.html.twig');
    }

    #[Route('/', name: 'app_home')]
    public function potentielClient(Request $request, EntityManagerInterface $em): Response
    {
        $potentielClient = new PotentielClient;
        $form = $this->createForm(FormPotentielClientType::class, $potentielClient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($potentielClient);
            $em->flush();
        }   

        return $this->render('views/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function afficheClient(PotentielClientRepository $repo): Response
    {
        return $this->render('cliens/table.html.twig',compact('clients'));
    }
}
