<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Required;

class SendmailController extends AbstractController
{
    /**
     * @Route("/sendmail", name="app_sendmail")
     */
    public function SendMail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message("test"))

            ->setFrom('contact@easemploy.com')
            ->setTo('yassine.messaoud98@gmail.com')
            ->setBody(
                'teeeeeeeeeeest'
            );

        // you can remove the following code if you don't define a text version for your emails

        $mailer->send($message);
        return new Response("<script>alert('Mail envoyee')</script>");
    }


   
}
