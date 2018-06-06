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
     * @Route("/page/{page}", name="infoPage")
     */
    public function infoPageAction($page)
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
In dat werk heb ik het belang geleerd van een persoonlijke benadering. </p>
OET;

        $whatIDoForYou = <<<OET
<p>Ik zorg voor u door dagelijkse beslommeringen van u over te nemen en door aandacht te hebben voor uw persoonlijk welzijn.</p>
OET;

        $whatItCosts = <<<OET
<p>De Herstelkamer is een particulier bedrijf en ingeschreven bij de Kamer van Koophandel. U bent zelf verantwoordelijk voor betaling.</p> 
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
De kamer is verbonden aan het woonhuis.</p>
OET;

        $other = <<<OET
<p>U kunt uw eigen bezoek ontvangen in de Herstelkamer. Zij kunnen daar niet overnachten.</p>
OET;

        $book = <<<OET
<p>Reserveren is op basis van beschikbaarheid van de kamer (link). Uw reservering is voor een vaste periode.</p>
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
<p>Mijn naam is Marga Schoots.</p> 
<p>Ik heb 16 jaar gewerkt voor een vakbond op het Ministerie van Buitenlandse Zaken. 
In dat werk heb ik het belang geleerd van een persoonlijke benadering. Mensen die zich gezien en gehoord voelen, 
verzamelen eerder kracht om weer door te gaan, ze herstellen sneller van tegenslagen.</p>
<p>Vanuit die ervaring en betrokkenheid ben ik begonnen met mijn Herstelkamer. 
Ik wil mensen graag het gevoel geven dat ze in een veilige, huiselijke omgeving kunnen herstellen zonder dat ze 
zich zorgen hoeven te maken over eten koken, boodschappen doen en schoonmaken. Ik hoop te bereiken dat mijn gasten 
na een kort verblijf gesterkt en met nieuwe moed weer zelfstandig verder kunnen.</p>
OET;

                return [
                    'title'   => 'Wie ben ik?',
                    'content' => $content,
                ];
                break;
            case 'whatIDoForYou':
                $content = <<<OET
<p>Ik zorg voor u door dagelijkse beslommeringen van u over te nemen en door aandacht te hebben voor uw persoonlijk welzijn. 
De zorg die ik geef is <b>niet-medisch en betreft geen lijfsgebonden zorg</b>. 
Daarvoor kunt u de hulp van externe dienstverleners, bv. een thuiszorgorganisatie, inroepen. 
Thuiszorg en bezoek van uw huisarts en andere hulpverleners kan in de Herstelkamer plaatsvinden. Zij krijgen via een sleutelkluis rechtstreeks toegang tot de Herstelkamer.</p>
<p>In beginsel ben ik van 08.00 uur tot 18.00 uur voor u bereikbaar. 
Buiten de genoemde tijden kunt u <b>alleen bij nood</b> via een alarmsysteem mijn hulp inroepen.</p>
OET;

                return [
                    'title'   => 'Wat kan ik voor u doen?',
                    'content' => $content,
                ];
                break;
            case 'whatItCosts':
                $content = <<<OET
<p>De Herstelkamer is een particulier bedrijf en ingeschreven bij de Kamer van Koophandel. U bent zelf verantwoordelijk voor betaling.</p> 
<p>Een verblijf in de Herstelkamer kost € 175,- per nacht inclusief BTW. Hierbij zijn 3 maaltijden, koffie- en thee inbegrepen. 
Gebruik van de minibar en het op uw verzoek draaien van een was wordt apart in rekening gebracht.</p>
<p>Bij reservering wordt een aanbetaling van 50% gevraagd. Het eindbedrag dient op de dag van vertrek te worden voldaan.</p>
<p>Voor niet-inwoners van de gemeente Pijnacker-Nootdorp ben ik verplicht toeristenbelasting in rekening te brengen. Deze bedraagt € 2,12 per nacht.</p>
OET;

                return [
                    'title'   => 'Wat kost het?',
                    'content' => $content,
                ];
                break;
            case 'questions':
                $content = <<<OET
<p>Vragen kunt u stellen via <a href="mailto:info@herstelkamer.nl">info@herstelkamer.nl</a></p>
OET;

                return [
                    'title'   => 'Heeft u nog vragen?',
                    'content' => $content,
                ];
                break;
            case 'reviews':
                $content = <<<OET

OET;

                return [
                    'title'   => 'Reviews',
                    'content' => $content,
                ];
                break;
            case 'whatItIs':
                $content = <<<OET
<p>De Herstelkamer is een overnachtings- en verblijfsgelegenheid die het midden houdt tussen een Bed en Breakfast met extra faciliteiten en logeren bij een goede bekende.</p>
<p>Bij de inrichting van de ruimte is rekening gehouden met personen die herstellende zijn na bv. een ziekenhuisopname. 
Een verblijf in de Herstelkamer is niet bedoeld voor personen met een beperking of voor personen die doorlopend medische zorg behoeven. 
De Herstelkamer is ook niet bedoeld voor mensen met een geestelijke aandoening (o.a. dementie).</p>
<p>Het verblijf is op basis van volpension (ontbijt, lunch, diner). De maaltijden worden vers bereid en in overleg met u samengesteld.</p>
<p>Het verblijf is gericht op herstel en de verhuurperiode is kort. De minimale verblijfsduur is 4 dagen, de maximale verblijfsduur is 10 dagen.</p>
OET;

                return [
                    'title'   => 'Wat is het?',
                    'content' => $content,
                ];
                break;
            case 'facilities':
                $content = <<<OET
<p>De Herstelkamer bestaat uit een slaapkamer met eigen badkamer. De kamer is verbonden aan het woonhuis. 
De ruimte is gelijkvloers, drempelloos en heeft een eigen uitgang naar buiten. Kamer en badkamer zijn voorzien van vloerverwarming. 
Voor de warme zomerdagen is er een airco. Er zijn voorzieningen die een veilig gebruik van douche en toilet bevorderen. 
Indien u dit wenst wordt een alarmknop ter beschikking gesteld waarmee u bij nood hulp kunt inroepen.</p>
<p>U slaapt in een verstelbaar ziekenhuisbed.</p>
<p>Koffie- en theefaciliteiten zijn in de kamer aanwezig, evenals een mini-bar.</p>
<p>Er is een TV op de kamer en u kunt gratis gebruik maken van Wifi.</p>
OET;

                return [
                    'title'   => 'Inrichting',
                    'content' => $content,
                ];
                break;
            case 'other':
                $content = <<<OET
<p>U kunt uw eigen bezoek ontvangen in de Herstelkamer. Zij kunnen daar niet overnachten. 
In overleg kan een logeermogelijkheid wel worden geboden.</p>
<p>Ons hondje (een dwergteckel) is dol op bezoek en laat dat ook merken. Hij is vriendelijk en speels. 
<b>Als u allergisch bent voor honden of als u geen affiniteit met ze hebt raad ik u een verblijf in de herstelkamer af.</b></p>
<p>U mag geen eigen huisdieren meenemen naar de herstelkamer.</p>
<p>Ik voer een strikt <b>niet-roken beleid</b> binnenshuis. Overtreding van deze regel leidt tot beëindiging van het verblijf.</p>
OET;

                return [
                    'title'   => 'Tenslotte',
                    'content' => $content,
                ];
                break;
            case 'book':
                $content = <<<OET
<p>Reserveren is op basis van beschikbaarheid van de kamer. Uw reservering is voor een vaste periode. 
Uw reservering is pas definitief na ontvangst van uw aanbetaling. U ontvangt een schriftelijke reserveringsbevestiging.</p>
<p>U kunt uw aanvraag indienen via <a href="mailto:info@herstelkamer.nl">info@herstelkamer.nl</a>.</p>
OET;

                return [
                    'title'   => 'Reserveren?',
                    'content' => $content,
                ];
                break;
            case 'privacy':
                $content = <<<OET

OET;

                return [
                    'title'   => 'Privacy en Cookies',
                    'content' => $content,
                ];
                break;
            case 'contact':
                $content = <<<OET
<p>Herstelkamer Nootdorp<br>
Hof van Koningsveld 39<br>
2631 WJ Nootdorp<br>
Mail: <a href="mailto:info@herstelkamer.nl">info@herstelkamer.nl</a><br>
Telefoon (bij voorkeur tussen 19.00 en 23.00 uur):06-18434805.<br>
</p>
OET;

                return [
                    'title'   => 'Contact',
                    'content' => $content,
                ];
                break;
            case 'proclaimer':
                $content = <<<OET
<p>Marga Meijerman is verantwoordelijk voor de inhoud van deze website en doet er alles aan deze juist en actueel te houden. 
Als u vragen heeft of als u meent dat er informatie op staat die (niet meer) correct is, mail naar mij.</p>
<p>Alle informatie die u verstrekt wordt vertrouwelijk door mij behandeld volgens mijn privacyverklaring. 
Ik gebruik uw persoons- of adresgegevens uitsluitend voor het doel waarvoor u ze heeft verstrekt. 
Uw persoonlijke gegevens worden niet door mij ter beschikking van derden gesteld.</p>

OET;

                return [
                    'title'   => 'Proclaimer',
                    'content' => $content,
                ];
                break;
            case 'boardOfAdvice':
                $content = <<<OET

OET;

                return [
                    'title'   => 'Raad van advies',
                    'content' => $content,
                ];
                break;
        }

        return [];
    }
}
