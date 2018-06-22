<?php

namespace AppBundle\Controller;

use AppBundle\Service\MailerWrapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    public function mailer()
    {
        /** @var MailerWrapper $mailer */
        $mailer = $this->container->get(MailerWrapper::class);
        return $mailer;
    }
}
