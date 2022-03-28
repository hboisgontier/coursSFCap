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
        return $this->render('Default/home.html.twig');
    }
}
