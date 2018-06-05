<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $abstracts = $this->getAbstractsFromDatabase();

        return $this->render('default/index.html.twig', ['abstracts' => $abstracts]);
    }

    /**
     * @Route("/page/{page}")
     */
    public function pageAction($page)
    {
        $content = $this->getPageContentFromDatabase($page);

        if (empty($content)) {
            throw new NotFoundHttpException('No content found for this page');
        }

        return $this->render('default/defaultPage.html.twig', ['content' => $content]);
    }

    /**
     * @return string[]
     */
    private function getAbstractsFromDatabase(): array
    {
        $aboutMe = <<<OET
<p>Mijn naam is Marga Schoots.</p> 
<p>Ik heb 16 jaar gewerkt voor een vakbond op het Ministerie van Buitenlandse Zaken. 
In dat werk heb ik het belang geleerd van een persoonlijke benadering. 
Mensen die zich gezien en gehoord voelen, verzamelen eerder kracht om weer door te gaan, 
ze herstellen sneller van tegenslagen.</p>
OET;

        $whatIDoForYou = <<<OET
<p>Ik zorg voor u door dagelijkse beslommeringen van u over te nemen en door aandacht te hebben voor uw persoonlijk welzijn. 
De zorg die ik geef is <b>niet-medisch en betreft geen lijfsgebonden zorg</b>. 
Daarvoor kunt u de hulp van externe dienstverleners, bv. een thuiszorgorganisatie, inroepen. 
Thuiszorg en bezoek van uw huisarts en andere hulpverleners kan in de Herstelkamer plaatsvinden. 
Zij krijgen via een sleutelkluis rechtstreeks toegang tot de Herstelkamer.</p>
OET;

        $whatItCosts = <<<OET
<p>De Herstelkamer is een particulier bedrijf en ingeschreven bij de Kamer van Koophandel. U bent zelf verantwoordelijk voor betaling.</p> 
<p>Een verblijf in de Herstelkamer kost € 175,- per nacht inclusief BTW. Hierbij zijn 3 maaltijden, koffie- en thee inbegrepen. 
Gebruik van de minibar en het op uw verzoek draaien van een was wordt apart in rekening gebracht.</p>
OET;

        $questions = <<<OET
<p>Vragen kunt u stellen via <a href="mailto:info@herstelkamer.nl">info@herstelkamer.nl</a></p>
OET;

        $reviews = <<<OET

OET;

        $whatItIs = <<<OET
<p>De Herstelkamer is een overnachtings- en verblijfsgelegenheid die het midden houdt tussen 
een Bed en Breakfast met extra faciliteiten en logeren bij een goede bekende.</p>
OET;

        $facilities = <<<OET
<p>De Herstelkamer bestaat uit een slaapkamer met eigen badkamer. 
De kamer is verbonden aan het woonhuis. De ruimte is gelijkvloers, drempelloos en heeft een eigen uitgang naar buiten.</p>
OET;

        $other = <<<OET
<p>U kunt uw eigen bezoek ontvangen in de Herstelkamer. Zij kunnen daar niet overnachten. In overleg kan een logeermogelijkheid wel worden geboden.</p>
OET;

        $book = <<<OET
<p>Reserveren is op basis van beschikbaarheid van de kamer (link). Uw reservering is voor een vaste periode. 
Uw reservering is pas definitief na ontvangst van uw aanbetaling. U ontvangt een schriftelijke reserveringsbevestiging.</p>
OET;

        return [
            'aboutMe'       => $aboutMe,
            'whatIDoForYou' => $whatIDoForYou,
            'whatItCosts'   => $whatItCosts,
            'questions'     => $questions,
            'reviews'       => $reviews,
            'whatItIs'      => $whatItIs,
            'facilities'    => $facilities,
            'other'         => $other,
            'book'          => $book,
        ];
    }

    /**
     * @param string $page
     *
     * @return string[]|null
     */
    private function getPageContentFromDatabase(string $page): array
    {
        switch ($page) {
            case 'aboutMe':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'whatIDoForYou':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'whatItCosts':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'questions':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'reviews':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'whatItIs':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'facilities':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'other':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'book':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'privacy':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'contact':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'proclaimer':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
            case 'boardOfAdvice':
                $content = <<<OET

OET;

                return [
                    'title'   => '',
                    'content' => $content,
                ];
                break;
        }

        return [];
    }
}
