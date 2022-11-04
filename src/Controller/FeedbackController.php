<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("feeDbacck/", name="app_feedback_index", methods={"GET"})
     */
    public function index(FeedbackRepository $feedbackRepository): Response
    {
        return $this->render('feedback/index.html.twig', [
            'feedback' => $feedbackRepository->findAll(),
        ]);
    }
  
    /**
     * @Route("/Contact/", name="app_feedback_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        FeedbackRepository $feedbackRepository
    ): Response {
        $feedback = new Feedback();
        $form = $this->createFormBuilder($feedback)
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('rate', RatingType::class, [
                //...
                'stars' => 5,
                //...
            ])
            //->add('submit',SubmitType::class,['attr'=>['class'=>'form-contol mb-3']])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feedbackRepository->add($feedback);
            $request
                ->getSession()
                ->getFlashBag()
                ->add(
                    'feedback',
                    'Thank you so much ' .
                        $form['name']->getData() .
                        ' for taking the time to send this! 
                Everyone here at Easemploy loves to know that our customers enjoy what we do.
                '
                );
        }

        return $this->render('feedback/new.html.twig', [
            'feedback' => $feedback,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/feedback/{id}", name="app_feedback_show", methods={"GET"})
     */
    public function show(Feedback $feedback): Response
    {
        return $this->render('feedback/show.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    /**
     * @Route("/dashboard/feedback/{id}/edit", name="app_feedback_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Feedback $feedback,
        FeedbackRepository $feedbackRepository
    ): Response {
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feedbackRepository->add($feedback);
            return $this->redirectToRoute(
                'app_feedback_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('feedback/edit.html.twig', [
            'feedback' => $feedback,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/feedback/{id}", name="app_feedback_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Feedback $feedback,
        FeedbackRepository $feedbackRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $feedback->getId(),
                $request->request->get('_token')
            )
        ) {
            $feedbackRepository->remove($feedback);
        }

        return $this->redirectToRoute(
            'app_feedback_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
