<?php

namespace App\Controller;

use App\Entity\Emplopyer;
use App\Repository\EmplopyerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security as SecurityCore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(EmplopyerRepository $emplopyerRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'emplopyers' => $emplopyerRepository->findBy(array('archived' =>0)),
        ]);
    }
     /**
     * @Route("/archive", name="app_archive")
     */
    public function archive(EmplopyerRepository $emplopyerRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'emplopyers' => $emplopyerRepository->findBy(array('archived' =>1)),
        ]);
    }
    /**
     * @Route("/dashboard/{id}", name="app_emplopyer_show")
     */
    public function show(
        Emplopyer $emplopyer,
        Request $request,
        \Swift_Mailer $mailer,
        EmplopyerRepository $emplopyerRepository
    ): Response {
        $form = $this->createFormBuilder()
            ->add('to', EmailType::class, [
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
            ->add('etat', ChoiceType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Etat: ',
                'choices' => [
                    'Accepter' => 'Accepter',
                    'Refuser' => 'Refuser',
                ],
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $to = $form['to']->getData();
            $objet = $form['objet']->getData();
            $body = $form['body']->getData();
            $etat = $form['etat']->getData();
            if ($etat == 'Accepter') {
                $emplopyer->setEtat($etat);
                $emplopyerRepository->add($emplopyer);

                $render = 'confirmation';
                $this->SendMail($mailer, $to, $objet, $render, $body);
            } elseif ($etat == 'Refuser') {
                $emplopyer->setEtat($etat);
                $emplopyerRepository->add($emplopyer);

                $render = 'sorry';
                $this->SendMail($mailer, $to, $objet, $render, $body);
            }
            //  dd( $to, $objet, $body);
        }

        return $this->render('emplopyer/show.html.twig', [
            'emplopyer' => $emplopyer,
            'form' => $form->createView(),
        ]);
    }

    public function SendMail(\Swift_Mailer $mailer, $to, $objet, $render, $body)
    {
        $message = (new \Swift_Message($objet))

            ->setFrom('contact@easemploy.com')
            ->setTo($to)
            ->setBody(
                $this->renderView('dashboard/' . $render . '.html.twig', [
                    'text' => $body,
                ]),
                // templates/emails/registration.html.twig
                //     'emplopyer/confirmation.html.twig'),
                'text/html'
            );

        // you can remove the following code if you don't define a text version for your emails

        $mailer->send($message);
        return new Response("<script>alert('Mail envoyee')</script>");
    }
}
