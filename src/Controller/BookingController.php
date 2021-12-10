<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\FailedNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\IsTrue;
use Twig\Environment;

final class BookingController extends BaseController
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @Route("/booking/form", name="bookingForm")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bookingFormAction(Request $request)
    {
        //todo: Betere validatie toevoegen
        //todo: form id opslaan in database (is dit nodig?)

        $booking = new Booking();

        $form = $this->createFormBuilder($booking)
            ->add('name', TextType::class, ['label' => 'Naam:'])
            ->add(
                'streetNumber',
                TextType::class,
                ['label' => 'Straat + nr.:']
            )
            ->add('zipCode', TextType::class, ['label' => 'Postcode:'])
            ->add('city', TextType::class, ['label' => 'Plaats:'])
            ->add(
                'phoneNumber',
                TextType::class,
                ['label' => 'Telefoonnummer:']
            )
            ->add(
                'emailAddress',
                TextType::class,
                ['label' => 'Email adres:']
            )
            ->add(
                'bookingStart',
                DateType::class,
                [
                    'label'  => 'Gewenste periode van:',
                    'widget' => 'single_text',
                    'attr'   => ['placeholder' => 'dd-mm-jjjj'],
                ]
            )
            ->add(
                'bookingEnd',
                DateType::class,
                ['label' => 'Gewenste periode:', 'widget' => 'single_text', 'attr' => ['placeholder' => 'dd-mm-jjjj']]
            )
            ->add(
                'remarks',
                TextareaType::class,
                ['label' => 'Opmerkingen:', 'required' => false, 'attr' => ['class' => 'textarea']]
            )
            ->add(
                'agreeTerms',
                CheckboxType::class,
                [
                    'label'       => 'Ik ga akkoord met de algemene voorwaarden',
                    'mapped'      => false,
                    'constraints' => new IsTrue(),
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                ['label' => 'Verstuur formulier']
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->sendMail(
                'Reserveringsverzoek ontvangen',
                $booking->getEmailAddress(),
                'mails/booking_to_applicant.html.twig',
                ['name' => $booking->getName()]
            );

            $this->sendMail(
                'Nieuw reserveringsverzoek',
                $this->getParameter('mailer_user'),
                'mails/booking_to_company.html.twig',
                [
                    'name'         => $booking->getName(),
                    'streetNumber' => $booking->getStreetNumber(),
                    'zipCode'      => $booking->getZipCode(),
                    'city'         => $booking->getCity(),
                    'phone'        => $booking->getPhoneNumber(),
                    'email'        => $booking->getEmailAddress(),
                    'startDate'    => $booking->getBookingStart()->format('d-m-Y'),
                    'endDate'      => $booking->getBookingEnd()->format('d-m-Y'),
                    'remarks'      => $booking->getRemarks() ?: 'geen',
                ]
            );

            $this->addFlash('success', 'Uw reserveringsverzoek is ontvangen');

            return $this->redirectToRoute('index');
        }

        return $this->render('booking/booking_form.html.twig', ['form' => $form->createView()]);
    }

    private function sendMail(
        string $subject,
        string $to,
        string $templateLocation,
        array $parameters = []
    ): void {
        try {
            $message = (new Email())
                ->subject($subject)
                ->from($this->getParameter('mailer_user'))
                ->to($to)
                ->html(
                    $this->twig->render(
                        $templateLocation,
                        $parameters
                    )
                );

            $this->mailer->send($message);
        } catch (\Exception $exception) {
            $failedNotification = FailedNotification::create(
                $subject,
                $to,
                $templateLocation,
                $parameters,
                $exception->getMessage()
            );

            $this->entityManager->persist($failedNotification);
            $this->entityManager->flush();
        }
    }
}
