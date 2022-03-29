<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'serie_list')]
    public function list(): Response
    {
        return $this->render('serie/list.html.twig');
    }

    #[Route('/serie/{id}', name: 'serie_details', requirements:['id'=>'\d+'])]
    public function details($id): Response {
        dd($id);
        return $this->render('serie/details.html.twig', ['id'=>$id]);
    }

    #[Route('/serie/add', name:'serie_add')]
    public function add(EntityManagerInterface $em): Response {
        // ajout
        $serie = new Serie();
        $serie->setName('Le bureau des légendes')
            ->setTmdbId(125)
            ->setDateCreated(new \DateTime());
        $em->persist($serie);
        $em->flush();
        // modification
        $serie->setName('Tutu')
            ->setDateModified(new \DateTime());
        $em->flush();
        // suppression
        $em->remove($serie);
        $em->flush();
        return $this->render('serie/add.html.twig');
    }
}
