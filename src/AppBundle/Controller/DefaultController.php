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
<p>Ik heb 16 jaar voor een vakbond gewerkt. 
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
<p>Reserveren is op basis van beschikbaarheid van de kamer. Uw reservering is voor een vaste periode.</p>
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
<p>Ik heb 16 jaar voor een vakbond gewerkt. 
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
<p>HERSTELKAMER NOOTDORP hecht veel waarde aan het beschermen van uw privacy en de persoonlijke gegevens die u aan ons verstrekt. 
Daarom leggen we u in dit privacy statement uit welke gegevens we van u verwerken en waarom we dat doen. 
We houden ons hierbij aan de Algemene Verordening Gegevensbescherming. Wij raden u aan om ons privacy statement zorgvuldig door te lezen.</p>

<p><b>Wie verwerkt uw persoonsgegevens?</b><br>
HERSTELKAMER NOOTDORP is gevestigd aan Hof van Koningsveld 39, 2631 WJ Nootdorp ingeschreven onder handelsregisternummer 71244360. 
Herstelkamer Nootdorp is de verwerkingsverantwoordelijke voor alle in dit privacy statement genoemde verwerkingen van uw persoonsgegevens.</p>

<p><b>Wat zijn persoonsgegevens?</b><br>
Informatie over personen die hen (direct of in combinatie met andere gegevens) identificeerbaar maakt, noemen we persoonsgegevens. 
Voorbeelden van persoonsgegevens zijn: uw naam, adres, woonplaats, geboortedatum, telefoonnummer en e-mailadres. 
Maar ook uw IP-adres is een persoonsgegeven.</p>

<p><b>Van wie verzamelt HERSTELKAMER NOOTDORP persoonsgegevens?</b><br>
HERSTELKAMER NOOTDORP verkrijgt en verwerkt persoonsgegevens van personen die de website bezoeken en een dienst willen afnemen. 
Bijvoorbeeld indien u uw gegevens invult op het contact- of reserveringsformulier.</p> 

<p><b>Contact met HERSTELKAMER NOOTDORP kan plaatsvinden via:</b>
<ul>
<li>telefoon;</li> 
<li>schriftelijke correspondentie;</li>
<li>het contactformulier op HERSTELKAMER.nl, bijvoorbeeld voor het stellen van vragen</li>
<li>per e-mail;</li> 
<li>het reserveringsformulier</li> 
<li>een link die is opgenomen in een elektronische boodschap of e-mailbericht.</li>
</ul><p></p>

<p><b>Welke persoonsgegevens verzamelt HERSTELKAMER NOOTDORP?</b>
HERSTELKAMER NOOTDORP verzamelt in elk geval de volgende persoonsgegevens:
<ul>
<li>Personalia: uw naam, adres, woonplaats, geslacht, (mobiel) telefoonnummer, e-mailadres en leeftijd;</li>
</ul></p> 

<p>Op basis van welke grondslag verwerkt HERSTELKAMER NOOTDORP persoonsgegevens?</p>

<p>HERSTELKAMER NOOTDORP verwerkt persoonsgegevens op basis van de noodzaak daarvan voor de uitvoering van de overeenkomst met haar klanten, 
bijvoorbeeld gegevens die nodig zijn om de dienst die geleverd wordt (een verblijf in de Herstelkamer) zo optimaal mogelijk te kunnen leveren.</p>

<p>Ten slotte kan HERSTELKAMER NOOTDORP persoonsgegevens verwerken op grond van een wettelijke plicht.</p>

<p><b>Voor welke doeleinden verwerkt HERSTELKAMER NOOTDORP persoonsgegevens?</b><br>
HERSTELKAMER NOOTDORP verwerkt persoonsgegevens voor het geven van uitvoering aan de overeenkomst tussen HERSTELKAMER NOOTDORP en haar klanten</p>

<p><b>Bewaartermijnen</b><br>
HERSTELKAMER NOOTDORP bewaart uw persoonsgegevens niet langer dan nodig is om u een goede en zorgvuldige dienstverlening te kunnen bieden en 
te kunnen voldoen aan uw wensen. Als wij uw gegevens niet meer nodig hebben, worden deze vernietigd.</p>

<p><b>Verstrekking van gegevens aan derden</b><br>
Wij verstrekken uw persoonsgegevens niet aan andere partijen tenzij dit noodzakelijk is in het kader van de uitvoering van onze 
dienstverlening/de overeenkomst, of wanneer HERSTELKAMER NOOTDORP hiertoe verplicht is op grond van een wettelijk voorschrift.</p>

<p>In geval van een medische noodsituatie kunnen uw gegevens worden verstrekt aan medische hulpverleners. 
Dit betreft ook de door u beschikbaar gestelde gegevens van een door u aangewezen contactpersoon.</p>

<p>HERSTELKAMER NOOTDORP verkoopt uw persoonlijke gegevens niet aan derden.</p>

<p><b>HERSTELKAMER NOOTDORP en andere websites</b><br>
Op onze website kunt u links naar andere websites aantreffen. Dit privacy statement is niet van toepassing op deze andere websites. 
HERSTELKAMER NOOTDORP is niet verantwoordelijk voor de wijze waarop deze websites met uw persoonlijke informatie omgaan. 
Lees hiervoor het privacy statement, indien aanwezig, van de website die u bezoekt.</p>

<p><b>Cookieverklaring</b><br>
HERSTELKAMER NOOTDORP maakt geen gebruik van cookies.</p>

<p><b>Beveiliging</b><br>
HERSTELKAMER NOOTDORP hecht veel waarde aan het beveiligen van persoonsgegevens. HERSTELKAMER NOOTDORP neemt verschillende technische en 
organisatorische maatregelen om uw gegevens te beschermen. HERSTELKAMER NOOTDORP neemt onder meer maatregelen zoals het versleutelen van 
gegevens op ingevulde formulieren en door gebruik te maken van firewalls en veilige servers.</p>

<p><b>Uw rechten</b><br>
Als wij uw persoonsgegevens verwerken, dan kunt u een verzoek doen tot inzage van deze gegevens, de gegevens te wijzigen, te verwijderen of 
de verwerking hiervan te beperken. Ook kunt u bezwaar maken tegen het ontvangen van informatie van HERSTELKAMER NOOTDORP via telefoon, post of e-mail, 
tenzij deze informatie noodzakelijk is in het kader van onze dienstverlening aan u. Daarnaast bent u gerechtigd uw toestemming voor het verwerken van 
uw persoonsgegevens in te trekken.</p>

<p>Dergelijke verzoeken kunt u indienen door een e-mail te richten aan <a href="mailto:info@herstelkamer.nl">info@herstelkamer.nl</a></p>


<p><b>Wat als het privacybeleid van HERSTELKAMER NOOTDORP wijzigt?</b><br>
De regels rondom de bescherming van persoonsgegevens en de diensten van HERSTELKAMER NOOTDORP kunnen veranderen. 
Wij behouden ons dan ook het recht voor om wijzigingen aan te brengen in deze privacyverklaring. De meeste actuele privacyverklaring 
vindt u altijd op <a href="https://www.herstelkamer.nl">https://www.herstelkamer.nl</a>. Deze verklaring is voor het laatst gewijzigd op 1 juni 2018.
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
<p>De raad van Advies kan gevraagd en ongevraagd advies geven met betrekking tot de bedrijfsvoering en de inrichting van de herstelkamer.</p>
<p>De raad van Advies bestaat uit personen die geen persoonlijk belang hebben bij het bedrijf.</p>
<p>Voorzitter: <a href="https://www.linkedin.com/in/karel-kamperman-1638066/" target="_blank">Karel Kamperman, Pyschogeriater</a></p>
OET;

                return [
                    'title'   => 'Raad van Advies',
                    'content' => $content,
                ];
                break;
            case 'conditions':
                $content = <<<OET
<p>Herstelkamer Nootdorp hanteert onderstaande algemene voorwaarden. 
<br>Deze zijn van kracht vanaf het moment van reservering tot en met het verblijf in Herstelkamer Nootdorp.<p>
 
<p><b>1. Algemeen</b>
<ol>
<li>Algemene Voorwaarden zijn van toepassing op alle overeenkomsten tot gebruik van Herstelkamer Nootdorp, Hof van Koningsveld 39, Nootdorp.</li>
<li>Met het aangaan van een huurovereenkomst worden deze Algemene Voorwaarden van kracht.</li>
<li>Deze Algemene Voorwaarden zijn opgenomen op de website https://www.herstelkamer.nl en worden met de reserveringsbevestiging aan gebruikers verzonden.</li>
<li>De eigenaar kan de gebruiker bij aankomst vragen om een identiteitsbewijs te tonen. Gebruikers dienen een vaste woon- of verblijfplaats te hebben.</li>
<li>De eigenaar is niet aansprakelijk voor schade, verlies of diefstal van eigendommen van de gebruikers. Bij geschillen hierover zijn alle (juridische) kosten voor rekening van de gebruikers.</li>
<li>Herstelkamer Nootdorp is niet aansprakelijk voor de gevolgen van handelingen verricht door vanwege gebruiker ingehuurde zorg- of dienstverleners.</li>
<li>Alle risico's met betrekking tot een verblijf in Herstelkamer Nootdorp zijn voor rekening van de gebruiker.</li>
<li>Beschadigingen en vermissingen van roerende en onroerende goederen van de eigenaar dienen door de gebruiker onmiddellijk te worden gemeld en vergoed aan de eigenaar. </li>
<li>Gebruikers dienen instructies van de eigenaar met betrekking tot de huur en het gebruik van de Herstelkamer op te volgen.</li>
<li>De eigenaar kan gebruikers, bij overtreding van deze Algemene Voorwaarden en bij ongepast gedrag, met onmiddellijke ingang de toegang tot Herstelkamer Nootdorp ontzeggen en/of weigeren, zonder restitutie van verblijfskosten.</li>
<li>De administratie van de eigenaar is in beginsel bepalend bij onderling meningsverschil tenzij de gebruikers het tegendeel kunnen bewijzen.</li>
<li>Gebruikers van Herstelkamer Nootdorp dienen zich te houden aan het onderstaande Huishoudelijk Reglement.</li>
<li>Marga Meijerman-Schoots is eigenaar en beheerder van Herstelkamer Nootdorp. De eigenaar kan zich laten vervangen door Bert Meijerman. Vervanging door een andere persoon zal in overleg met gebruiker plaatsvinden.</li>
</ol></p>

<p><b>2. Reservering en bevestiging</b>
<ol>
<li>Het minimale verblijf in Herstelkamer Nootdorp is 4 dagen (3 nachten). Het maximale verblijf is 10 dagen (9 nachten).</li>
<li>Voor het reserveren van een verblijf in De Herstelkamer worden geen extra reserveringskosten in rekening gebracht.</li>
<li>Na ontvangst van uw reserveringsverzoek ontvangt u van Herstelkamer Nootdorp een schriftelijke bevestiging (mits plaats beschikbaar).</li>
<li>De huurovereenkomst wordt schriftelijk aangegaan. Na ontvangst van uw aanbetaling is de reservering definitief.</li>
<li>Een reserveringsverzoek kan worden afgewezen zonder opgaaf van redenen.</li>
<li>In onze reserveringsbevestiging wordt verwezen naar deze Algemene Voorwaarden. Door te reserveren bevestigt u dat u kennis heeft genomen van deze Algemene Voorwaarden.</li>
</ol></p>

<p><b>3. Betaling</b>
<ol>
<li>Bij reservering dient een aanbetaling van 50% van de totale huursom te worden voldaan. Het restant dient te worden betaald op de laatste dag van het verblijf. U ontvangt een factuur met de eindafrekening.</li>
<li>De dag van aankomst en dag van vertrek worden bij een herstelverblijf berekend als volledige verblijfsdagen</li>
<li>Extra faciliteiten zoals het draaien van een was op verzoek en het gebruik van de minibar worden apart in rekening gebracht. Een tarievenlijst wordt u bij aankomst ter hand gesteld. </li>
<li>Voor het gebruik van het seniorenalarm (optioneel) wordt een borgsom van € 50,- gevraagd. Na teruggave van het alarm in ongeschonden staat wordt deze borgsom verrekend met de eindafrekening.</li>
<li>Het schoonmaken van ernstige vervuiling of het herstel van beschadigingen aan het interieur zullen separaat in rekening worden gebracht.</li>
<li>De eigenaar kan in overleg met de gebruiker van deze voorwaarden afwijken.</li>
<li>De tarieven vindt u op onze website.</li>
</ol>
 
<p><b>4. Annulering en no show (niet komen zonder annulering)</b>
<ol>
<li>Indien u onverhoopt niet in staat bent om de aangegane huurovereenkomst na te komen, verzoeken wij u dit zo spoedig mogelijk bij ons te melden zodat wij de daardoor vrijgevallen datum alsnog aan derden kunnen aanbieden.</li>
<li>Bij annulering en no show betaalt de contractant een vergoeding aan de eigenaar. Deze vergoeding bestaat uit:
<ol type="a">
<li>Tot 1 week voor ingangsdatum is de annulering kosteloos.</li>
<li>Bij annulering binnen 1 week voor ingangsdatum is 50% van het bedrag als vergoeding verschuldigd. Een uitzondering op deze regel kan worden gemaakt indien er sprake is van overmacht. Dit ter beoordeling van de eigenaar.</li>
</ol>
</li>
</ol>
</p>

<p><b>5. Sleutel</b>
<ol>
<li>Als gebruiker ontvangt u een sleutel van Herstelkamer Nootdorp. Deze mag niet worden doorgegeven aan derden. De sleutel levert u weer in bij vertrek. Als gebruiker bent u zelf verantwoordelijk voor het correct afsluiten van de toegangsdeur van Herstelkamer Nootdorp.</li>
<li>Verlies van de sleutel is voor kosten van contractant (€ 100,-) en dient bij uitchecken cash door contractant te worden voldaan.</li>
</ol></p>
 
<br><br>
<h1>Huishoudelijk reglement</h1>
<p><b>Aankomst en vertrek</b>
<ol>
<li>Op de dag van aankomst kunt u vanaf 11.00 uur uw verblijf gebruiken.</li>
<li>Op de dag van vertrek dient het verblijf om 15.00 uur vrij te zijn.</li>
<li>Alleen in overleg kan van bovengenoemde tijden afgeweken worden.</li>
<li>Bij voortijdig vertrek vindt geen restitutie plaats.</li>
</ol></p>
 
<p><b>Maaltijden</b>
<ol>
<li>Het verblijf is op basis van volpension</li>
<li>Het ontbijt wordt in overleg tussen 08.00 en 09.00 uur geserveerd.</li>
<li>De lunch wordt in overleg tussen 12.30-14.00 uur geserveerd</li>
<li>Het diner wordt in overleg tussen 17.00 en 18.00 uur geserveerd</li>
<li>De samenstelling van de maaltijden is in beginsel de keuze van de eigenaar.
Er wordt rekening gehouden met een medisch voorgeschreven dieet.
Verder wordt, binnen de mogelijkheden, geprobeerd rekening te houden met de wensen van de gebruiker.</li>
</ol></p>

<p><b>Gebruik apparatuur</b>
<ol>
<li>Gebruik van de aanwezige apparatuur in de herstelkamer is voor eigen risico. De eigenaar is niet aansprakelijk voor eventuele nadelige gevolgen voor de gebruiker van het gebruik van de apparatuur.</li>
<li>De apparatuur dient alleen te worden gebruikt voor het daarvoor bestemde doel. De eigenaar is niet aansprakelijk voor een onvoorzien technisch mankement aan de apparatuur waardoor gebruik (tijdelijk) niet mogelijk is. De gebruiker is aansprakelijk voor defecten of beschadigingen die het gevolg zijn van een verkeerd gebruik van de apparatuur.</li>
</ol></p>
 
<p><b>Uw verblijf</b>
<ol>
<li>Geluidsoverlast, met name tussen 22.00 en 07.00 uur, dient te worden voorkomen.</li>
<li>Het meebrengen van huisdieren is niet toegestaan.</li>
<li>Roken is niet toegestaan in Herstelkamer Nootdorp.</li>
<li>Bezoekers zijn toegestaan maar mogen niet overnachten in Herstelkamer Nootdorp. In overleg kan een logeermogelijkheid worden geboden. </li>
<li>Er kan een voertuig worden geparkeerd op de parkeerplaats op het eigen terrein voor Herstelkamer Nootdorp. Als deze parkeerplaats bezet is dient op een openbare parkeerplaats elders te worden geparkeerd.</li>
</ol></p>
OET;

                return [
                    'title'   => 'Algemene voorwaarden  ',
                    'content' => $content,
                ];
                break;
        }

        return [];
    }
}
