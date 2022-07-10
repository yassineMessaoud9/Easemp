<?php

namespace App\Controller;

use App\Entity\Findemp;
use App\Form\FindempType;
use App\Repository\FindempRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FindempController extends AbstractController
{
    /**
     * @Route("/emp/list", name="app_findemp_index", methods={"GET"})
     */
    public function index(FindempRepository $findempRepository): Response
    {
        return $this->render('findemp/index.html.twig', [
            'findemps' => $findempRepository->findAll(),
        ]);
    }
    public function SendMail(\Swift_Mailer $mailer, $to, $objet)
    {
        $message = (new \Swift_Message($objet))

            ->setFrom('easemploy@outlook.com')
            ->setTo($to)
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'emplopyer/confirmation.html.twig'
                ),
                'text/html'
            );

        // you can remove the following code if you don't define a text version for your emails

        $mailer->send($message);
        return new Response("<script>alert('Mail envoyee')</script>");
    }

    /**
     * @Route("/emp/Find", name="app_findemp_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        FindempRepository $findempRepository,
        \Swift_Mailer $mailer
    ): Response {
        $findemp = new Findemp();
        $form = $this->createForm(FindempType::class, $findemp);
        $form->handleRequest($request);
        $to = $findemp->getEmail();
        $objet = 'Searching for employees  ';

        if ($form->isSubmitted() && $form->isValid()) {
            $findempRepository->add($findemp);
            $request
                ->getSession()
                ->getFlashBag()
                ->add(
                    'registration',
                    'Thank you for registering on our platform,
             you will receive a confirmation email, and we will reply to you as soon as possible'
                );
            $this->SendMail($mailer, $to, $objet);

            return $this->redirectToRoute(
                'app_findemp_new',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('findemp/new.html.twig', [
            'findemp' => $findemp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emp/{id}", name="app_findemp_show", methods={"GET"})
     */
    public function show(Findemp $findemp): Response
    {
        return $this->render('findemp/show.html.twig', [
            'findemp' => $findemp,
        ]);
    }

    /**
     * @Route("/emp/{id}/email", name="app_findemp_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Findemp $findemp,
        FindempRepository $findempRepository,
        \Swift_Mailer $mailer

    ): Response {
        $form = $this->createFormBuilder()
            ->add('to',EmailType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'À: ',
            ])
            ->add('objet', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Objet: ',
            ])
            ->add('body', TextareaType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Sujet: ',
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $to = $form['to']->getData();
            $objet = $form['objet']->getData();
            $body = $form['body']->getData();

            //  dd( $to, $objet, $body);
            $this->SendMail($mailer, $to, $objet, $body);
        }

        return $this->render('findemp/edit.html.twig', [
            'findemp' => $findemp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emp/{id}", name="app_findemp_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Findemp $findemp,
        FindempRepository $findempRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $findemp->getId(),
                $request->request->get('_token')
            )
        ) {
            $findempRepository->remove($findemp);
        }

        return $this->redirectToRoute(
            'app_findemp_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
