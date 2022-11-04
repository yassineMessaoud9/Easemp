<?php

namespace App\Controller;

use App\Entity\Emplopyer;
use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Flex\Response as FlexResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(FeedbackRepository $feedbackRepository,TranslatorInterface $translator)
    {
        $translated = $translator->trans('welcome');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'feedback' => $feedbackRepository->findAll(),
        ]);
 
}
}
