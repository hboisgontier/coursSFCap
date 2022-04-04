<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use App\Services\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'serie_list')]
    public function list(SerieRepository $repo): Response
    {
        //$series = $repo->findAll();
        //$series = $repo->findBy([], ['id'=>'ASC'], 10, 20);
        $series = $repo->findWithSeasons();
        $page = 0;
        return $this->render('serie/list.html.twig', compact('series', 'page'));
    }

    #[Route('/serie/p/{page}', name: 'serie_list_page', requirements: ['page'=>'\d+'])]
    public function liste_page($page, SerieRepository $repo): Response {
        $series = $repo->findWithSeasons($page);
        return $this->render('serie/list.html.twig', compact('series', 'page'));
    }

    #[Route('/serie/{id}', name: 'serie_details', requirements:['id'=>'\d+'])]
    public function details($id, SerieRepository $repo): Response {
        $serie = $repo->find($id);
        if(!$serie)
            throw $this->createNotFoundException();
        return $this->render('serie/details.html.twig', ['serie'=>$serie]);
    }

    #[Route('/serie/add', name:'serie_add')]
    public function add(EntityManagerInterface $em, SerieRepository $repo, Request $request, Validator $validator): Response {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        //hydratation des données entre le formulaire et l'instance
        $form->handleRequest($request);
        $withoutTaboo = $validator->validate($serie->getOverview());
        if(!$withoutTaboo) {
            $this->addFlash('error', 'Overview contains taboo words');
        }
        if($form->isSubmitted() && $form->isValid() && $withoutTaboo) {
            //traitement
            $serie->setDateCreated(new \DateTime());
            $em->persist($serie);
            $em->flush();
            $this->addFlash('success', 'The serie '.$serie->getName().' has been added');
            //redirection toujours après le traitement
            return $this->redirectToRoute('serie_list');
        }
        $viewForm = $form->createView();
        return $this->render('serie/add.html.twig', compact('viewForm'));
        /*
        // ajout
        $serie = new Serie();
        $serie->setName('Le bureau des légendes')
            ->setTmdbId(125)
            ->setDateCreated(new \DateTime());
        $em->persist($serie);
        $em->flush();
        //$repo->add($serie);

        // modification
        $serie->setName('Tutu')
            ->setDateModified(new \DateTime());
        $em->flush();

        // suppression
        $em->remove($serie);
        $em->flush();
        return $this->render('serie/add.html.twig');
        */
    }

    #[Route('/serie/delete/{id}', name: 'serie_delete', requirements: ['id'=>'\d+'], methods: ['POST'])]
    public function delete($id, EntityManagerInterface $em, SerieRepository $repo): Response {
        $serie = $repo->find($id);
        $em->remove($serie);
        $em->flush();
        $this->addFlash('success', 'The serie '.$serie->getName().' has been removed!');
        return $this->redirectToRoute('serie_list_page', ['page'=>0]);
    }

    #[Route('/serie/good', name:'serie_good')]
    public function good(SerieRepository $repo) : Response {
        $series = $repo->findGoodSeries();
        return $this->render('serie/list.html.twig', compact('series'));
    }
}
