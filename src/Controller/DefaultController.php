<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'app_default_home')]
    public function home(): Response
    {
        $series = ['Game of Thrones', 'Le bureau des légendes', 'Serviteur du peuple'];
        $titre = 'Series';
        return $this->render('Default/home.html.twig', compact('series', 'titre'));
    }

    #[Route('/test/yo', name: 'app_default_yo')]
    public function yo(): Response {
        $h1 = 'Titre de la page avec compact';
        return $this->render(
            'Default/yo.html.twig',
            //['titre1'=>$h1]
            compact('h1')
        );
    }
}
