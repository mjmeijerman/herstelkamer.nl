<?php

namespace AppBundle\Controller;

use AppBundle\Service\MailerWrapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    protected function mailer(): MailerWrapper
    {
        /** @var MailerWrapper $mailer */
        $mailer = $this->container->get(MailerWrapper::class);
        return $mailer;
    }

    protected function addToDB($entity, $detach = null): void
    {
        $em = $this->getDoctrine()->getManager();
        if ($detach) {
            $em->detach($detach);
        }
        $em->persist($entity);
        $em->flush();
    }

    protected function removeFromDB($entity): void
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();
    }
}
