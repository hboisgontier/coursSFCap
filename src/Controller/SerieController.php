<?php

namespace App\Controller;

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
        return $this->render('serie/details.html.twig', ['id'=>$id]);
    }
}
