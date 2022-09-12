<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Opticiens;
use App\Form\AddOpticienType;


class OpticienController extends AbstractController
{

    #[Route('/opticien/new', name: 'app_register_opticien')]
    public function newOpticien(Request $request, EntityManagerInterface $em): Response
    {
        $newOpticien = new Opticiens;
        $form = $this->createForm(AddOpticienType::class, $newOpticien);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($newOpticien);
            $em->flush();
        }   
        
        return $this->render('opticiens/form.html.twig', [
            'formOpticien' => $form->createView()
        ]); 
    }

}
