<?php

namespace App\Controller;

use App\Entity\Espaces;
use App\Form\EspacesType;
use App\Form\EspaceSupprimerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class EspacesController extends AbstractController
{
    /**
     * @Route("/", name="app_espaces")
     */
    public function index(ManagerRegistry $doctrine): Response
    {


        $repo = $doctrine->getRepository(Espaces::class);
        $espaces=$repo->findAll();

        return $this->render('espaces/index.html.twig', [
            'espaces'=>$espaces
        ]);
    }

    /**
     * @Route("/espaces/ajouter", name="app_espaces_ajouter")
     */
    public function ajouter(ManagerRegistry $doctrine, Request $request): Response
    {

        $espaces=new Espaces();

        $form=$this->createForm(EspacesType::class, $espaces);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->persist($espaces);


            $em->flush();


            return $this->redirectToRoute("app_espaces");
        }

        return $this->render("espaces/ajouter.html.twig",[
            "formulaire"=>$form->createView()
        ]);
    }

    /**
     * @Route("/espaces/modifier/{id}", name="app_espaces_modifier")
     */
    public function modifier($id, ManagerRegistry $doctrine, Request $request): Response{

        $espaces = $doctrine->getRepository(Espaces::class)->find($id);


        if (!$espaces){
            throw $this->createNotFoundException("Pas de catégorie avec l'id $id");
        }


        $form=$this->createForm(EspacesType::class, $espaces);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->persist($espaces);


            $em->flush();


            return $this->redirectToRoute("app_espaces");
        }

        return $this->render("espaces/modifier.html.twig",[
            "espaces"=>$espaces,
            "formulaire"=>$form->createView()
        ]);
    }

    /**
     * @Route("/espaces/supprimer/{id}", name="app_espaces_supprimer")
     */
    public function supprimer($id, ManagerRegistry $doctrine, Request $request): Response{

        $espaces = $doctrine->getRepository(Espaces::class)->find($id);


        if (!$espaces){
            throw $this->createNotFoundException("Pas de catégorie avec l'id $id");
        }


        $form=$this->createForm(EspaceSupprimerType::class, $espaces);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em=$doctrine->getManager();

            $em->remove($espaces);


            $em->flush();


            return $this->redirectToRoute("app_espaces");
        }

        return $this->render("espaces/supprimer.html.twig",[
            "espaces"=>$espaces,
            "formulaire"=>$form->createView(),
        ]);
    }
}
