<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Entity\Enclos;
use App\Form\AnimalType;
use App\Form\AnimauxSupprimerType;
use App\Form\EnclosType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnimauxController extends AbstractController
{



    /**
     * @Route("/animaux/{idEnclos}", name="app_animaux_voir")
     */
    public function index($idEnclos, ManagerRegistry $doctrine): Response
    {
        $enclos = $doctrine->getRepository(Enclos::class)->find($idEnclos );
        if (!$enclos) {
            throw $this->createNotFoundException("Aucun espaces avec l'id $idEnclos");
        }



        return $this->render('animaux/index.html.twig', [
            'enclos' => $enclos,
            "animaux"=>$enclos->getAnimaux()
        ]);
    }

    /**
     * @Route("/animal/ajouter", name="app_animaux_ajouter")
     */
    public function ajouter(ManagerRegistry $doctrine, Request $request):Response
    {
        $animaux= new Animaux();

        $form = $this->createForm(AnimalType::class, $animaux);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($animaux);
            $em->flush();


            return $this->redirectToRoute("app_animaux_voir", ["idEnclos" => $animaux->getEnclos()->getId()]);

        }

        return $this->render("animaux/ajouter.html.twig", [
            'formulaire' => $form->createView()
        ]);

    }

    /**
     * @Route("/animaux/modifier/{id}", name="app_animaux_modifier")
     */
    public function modifier($id, ManagerRegistry $doctrine, Request $request): Response{

        $animaux = $doctrine->getRepository(Animaux::class)->find($id);


        if (!$animaux){
            throw $this->createNotFoundException("Pas de catégorie avec l'id $id");
        }


        $form=$this->createForm(AnimalType::class, $animaux);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->persist($animaux);


            $em->flush();


            return $this->redirectToRoute("app_animaux_voir", ["idEnclos" => $animaux->getEnclos()->getId()]);
        }

        return $this->render("animaux/modifier.html.twig",[
            "animaux"=>$animaux,
            "formulaire"=>$form->createView()
        ]);
    }

    /**
     * @Route("/animaux/supprimer/{idEnclos}", name="app_animaux_supprimer")
     */
    public function supprimer($id,$idEnclos, ManagerRegistry $doctrine, Request $request): Response{

        $animaux = $doctrine->getRepository(Animaux::class)->find($id);
        $enclos = $doctrine->getRepository(Enclos::class)->find($idEnclos );

        if (!$animaux){
            throw $this->createNotFoundException("Pas de catégorie avec l'id $id");
        }


        $form=$this->createForm(AnimauxSupprimerType::class, $animaux);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->remove($animaux);


            $em->flush();


            return $this->redirectToRoute("app_animaux_voir");
        }

        return $this->render("animaux/supprimer.html.twig",[
            "animaux"=>$animaux,
            'enclos' => $enclos,
            "animau"=>$enclos->getAnimaux(),
            "formulaire"=>$form->createView()
        ]);
    }
}
