<?php

namespace App\Controller;

use App\Entity\Enclos;
use App\Entity\Espaces;

use App\Form\EnclosSupprimerType;
use App\Form\EnclosType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnclosController extends AbstractController
{



    /**
     * @Route("/enclos/{idEspaces}", name="app_enclos_voir")
     */
    public function index($idEspaces, ManagerRegistry $doctrine): Response
    {
        $espaces = $doctrine->getRepository(Espaces::class)->find($idEspaces );
        if (!$espaces) {
            throw $this->createNotFoundException("Aucun espaces avec l'id $idEspaces");
        }



        return $this->render('enclos/index.html.twig', [
            'espaces' => $espaces,
            "enclos"=>$espaces->getEnclos()
        ]);
    }

    /**
     * @Route("/enclo/ajouter", name="app_enclos_ajouter")
     */
    public function ajouter(ManagerRegistry $doctrine, Request $request):Response
    {
        $enclos= new Enclos();

        $form = $this->createForm(EnclosType::class, $enclos);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($enclos);
            $em->flush();

            //retour à l'accueil
            return $this->redirectToRoute("app_enclos_voir", ["idEspaces" => $enclos->getEspaces()->getId()]);

        }

        return $this->render("enclos/ajouter.html.twig", [
            'formulaire' => $form->createView()
        ]);

    }
    /**
     * @Route("/enclos/modifier/{id}", name="app_enclos_modifier")
     */
    public function modifier($id , ManagerRegistry $doctrine, Request $request): Response{

        $enclos = $doctrine->getRepository(Enclos::class)->find($id );




        if (!$enclos){
            throw $this->createNotFoundException("Pas de catégorie avec l'id $id");
        }


        $form=$this->createForm(EnclosType::class, $enclos);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){


            $em=$doctrine->getManager();

            $em->persist($enclos);


            $em->flush();


            return $this->redirectToRoute("app_enclos_voir",["idEspaces" => $enclos->getEspaces()->getId()]);
        }

        return $this->render("enclos/modifier.html.twig",[
            "enclos"=>$enclos,
            "formulaire"=>$form->createView(),
        ]);
    }

    /**
     * @Route("/enclos/supprimer/{id}", name="app_enclos_supprimer")
     */
    public function supprimer($id, ManagerRegistry $doctrine, Request $request): Response{


        $enclos = $doctrine->getRepository(Enclos::class)->find($id );

        if (!$enclos){
            throw $this->createNotFoundException("Pas denclos catégorie avec l'id $id");
        }


        $form=$this->createForm(EnclosSupprimerType::class, $enclos);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->remove($enclos);


            $em->flush();

            return $this->redirectToRoute("app_enclos_voir",["idEspaces" => $enclos->getEspaces()->getId()]);
        }

        return $this->render("enclos/supprimer.html.twig",[


            "enclos"=>$enclos,

            "formulaire"=>$form->createView()
        ]);
    }
}
