<?php

namespace App\Controller;

use App\Entity\Findemp;
use App\Repository\FindempRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrController extends AbstractController
{
   
    /**
     * @Route("/emplist", name="app_findemp_index", )
     */
    public function index(FindempRepository $findempRepository): Response
    {
        return $this->render('liste_entr/index.html.twig', [
            'findemps' => $findempRepository->findAll(),
        ]);
    }

    

}
