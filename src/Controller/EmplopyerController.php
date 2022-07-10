<?php

namespace App\Controller;

use App\Entity\Emplopyer;
use App\Form\EmplopyerType;
use App\Repository\EmplopyerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmplopyerController extends AbstractController
{
   
    /**
     * @Route("/conf", name="app_emmplopyer_conf", methods={"GET"})
     */
    public function conf(EmplopyerRepository $emplopyerRepository): Response
    {
        return $this->render('findemp/renvoie.html.twig');
    }

    /**
     * @Route("/ApplyJob", name="app_employer_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        EmplopyerRepository $emplopyerRepository,
        \Swift_Mailer $mailer
    ): Response {
        $emplopyer = new Emplopyer();
        $form = $this->createForm(EmplopyerType::class, $emplopyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $to = $emplopyer->getEmail();
            $name = $emplopyer->getNom();
            $objet = 'Registration';
            
            // return $this->redirectToRoute('app_emplopyer_index', [], Response::HTTP_SEE_OTHER);
            $file = $form->get('cv')->getData();
            $Filename = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('cv'), $Filename);
            } catch (FileException $e) {
            }
            $emplopyer->setCv($Filename);
            $emplopyerRepository->add($emplopyer);
            $this->SendMail($mailer, $to, $objet);
            $request
                ->getSession()
                ->getFlashBag()
                ->add(
                    'registration',
                    'Thank you for registering on our platform,
                 you will receive a confirmation email, and we will reply to you as soon as possible'
                );
            return $this->redirectToRoute('app_employer_new');
        }

        return $this->render('emplopyer/new.html.twig', [
            'emplopyer' => $emplopyer,
            'form' => $form->createView(),
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
                'emplopyer/confirmation.html.twig'),
                'text/html'
                );

        // you can remove the following code if you don't define a text version for your emails

        $mailer->send($message);
        return new Response("<script>alert('Mail envoyee')</script>");
    }

    /**
     * @Route("/{id}/edit", name="app_emplopyer_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Emplopyer $emplopyer,
        EmplopyerRepository $emplopyerRepository
    ): Response {
        $form = $this->createForm(EmplopyerType::class, $emplopyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emplopyerRepository->add($emplopyer);
            return $this->redirectToRoute(
                'app_emplopyer_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('emplopyer/edit.html.twig', [
            'emplopyer' => $emplopyer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_emplopyer_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Emplopyer $emplopyer,
        EmplopyerRepository $emplopyerRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $emplopyer->getId(),
                $request->request->get('_token')
            )
        ) {
            $emplopyerRepository->remove($emplopyer);
        }

        return $this->redirectToRoute(
            'app_emplopyer_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
