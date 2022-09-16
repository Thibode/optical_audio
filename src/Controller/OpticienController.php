<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Opticiens;
use App\Form\AddOpticienType;
use Doctrine\Persistence\ManagerRegistry;

class OpticienController extends AbstractController
{

    #[Route('/opticien/new', name: 'app_register_opticien')]
    public function newOpticien(Request $request, EntityManagerInterface $em, ManagerRegistry $doctrine): Response
    {
        $newOpticien = new Opticiens;
        $form = $this->createForm(AddOpticienType::class, $newOpticien);
        $opticiens = $doctrine->getRepository(Opticiens::class)->findAll();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($newOpticien);
            $em->flush();

            return $this->redirectToRoute('app_register_opticien');
        }   
        
        return $this->render('opticiens/form.html.twig', [
            'opticiens' => $opticiens,
            'formOpticien' => $form->createView()
        ]); 
    }

    #[Route('/opticien/new/{id<[0-9]+>}/delete', name:'app_register_opticien_delete', methods:['GET', 'DELETE'])]
    public function deleteOpticien(EntityManagerInterface $em, int $id): Response
    {
        $opticien = $em->getRepository(Opticiens::class)->find($id);
        if($opticien){
            $em->remove($opticien);
            $em->flush();
            $this->addFlash('info', 'Collaborateur supprimé avec succès !');
            
            return $this->redirectToRoute('app_register_opticien');
        }
    }

}
