<?php

namespace App\Controller;

use App\Entity\BookedDayRepository;
use App\Service\MailerWrapper;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected function mailer(): MailerWrapper
    {
        /** @var MailerWrapper $mailer */
        $mailer = $this->container->get(MailerWrapper::class);
        return $mailer;
    }

    protected function addToDB(EntityManager $entityManager, $entity, $detach = null): void
    {
        if ($detach) {
            $entityManager->detach($detach);
        }
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    protected function removeFromDB(EntityManager $entityManager, $entity): void
    {
        $entityManager->remove($entity);
        $entityManager->flush();
    }

    protected function bookedDayRepository(BookedDayRepository $bookedDayRepository): BookedDayRepository
    {
        return $bookedDayRepository;
    }
}
