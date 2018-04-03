<?php

use Illuminate\Database\Seeder;
use App\Competence;

class CompetencesTableSeeder extends Seeder
{
    /*'description' => *
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		$data = [

		//A

		['competence' => 'Aanpassingsvermogen ',

		'description' => 'Je kan doeltreffend blijven handelen door je aan te passen aan veranderende taken, mensen, verantwoordelijkheden en/of omgeving.'],

		['competence' => 'Aanspreken op gedrag ',

		'description' => 'Je spreekt de ander aan op gemaakte afspraken over gewenst gedrag in diens taak, rol of functie.'],

		['competence' => 'Aansturen ',

		'description' => 'Je kan leiding geven aan zowel individuen als groepen en bent goed in het voorzien van heldere instructies en richtlijnen voor anderen. Ingeval van problemen, onderneem je tijdig actie.'],

		['competence' => 'Accuraat',

		'description' => 'Je kan gedurende lange tijd en doeltreffend omgaan met gedetailleerde informatie.'],

		['competence' => 'Actieve houding ',

		'description' => 'Je kan actief deelnemen aan een arbeidsprestatie en daarbij een energieke en ijverige houding vertonen.'],

		['competence' => 'Adviseren ',

		'description' => 'Je kan wijzigingen of verbeteringen suggereren waarmee de ander geholpen is.'],

		['competence' => 'Afstand bewaren',

		'description' =>  'Je kan problemen bekijken/oplossen op nodige afstand zonder emotioneel betrokken te raken.'],

		['competence' => 'Ambitie ',

		'description' => 'Je streeft ernaar door te groeien in de organisatie; uit je gedrag blijkt dat je carrière wil maken en succes boeken.'],

		['competence' => 'Analytisch vermogen ',

		'description' => 'Je kan een situatie, probleem of proces ontrafelen en de oorsprong en het verband tussen de verschillende elementen begrijpen.'],

		['competence' => 'Anticiperen ',

		'description' => 'Je bent in staat om kritische situaties tijdig te onderscheiden en hier op gepaste wijze op in te spelen. Je onderneemt tijdig maatregelen om te voorkomen dat de zaken uit de hand lopen.'],

		['competence' => 'Argumenteren ',

		'description' => 'Je bent in staat om anderen van je mening of standpunt te overtuigen door deze met feiten te onderbouwen.'],


		['competence' => 'Assertiviteit ',

		'description' => 'Je komt op voor je eigen mening, noden of belangen, op een niet kwetsende, tactvolle manier.'],

		//B

		['competence' => 'Beargumenteren ',

		'description' => 'Je weet anderen te overtuigen van de juistheid van bepaalde inzichten. Je kan draagvlak en betrokkenheid creëren voor standpunten en plannen om deze door te voeren.'],

		['competence' => 'Beheersing operaties ',

		'description' => 'Binnen een gegeven doel kan je op effectieve wijze prioriteiten bepalen. Je kan aangeven welke middelen, handelingen en tijd nodig zijn om deze doelen te kunnen behalen en je behoudt het overzicht van de voortgang.'],

		['competence' => 'Besluitvaardigheid ',

		'description' => 'Je komt tot beslissingen door middel van het stellen van handelingen of het kenbaar maken van meningen.'],

		['competence' => 'Bestuurssensitiviteit ',

		'description' => 'Je bent in staat om proactief te reageren en relevantie van gebeurtenissen te herkennen die een invloed hebben op het geldende beleid en de positie van de bewindspersoon.'],

		['competence' => 'Betrokkenheid ',

		'description' => 'Je bent in staat je betrokkenheid te tonen met de taak en het beroep en kunt anderen op basis hiervan stimuleren.'],

		['competence' => 'Betrouwbaarheid',

		'description' => 'Je komt gemaakte afspraken na en aanvaardt de	consequenties ervan.'],

		// C

		['competence' =>'Coachen', 

		'description' => 'Door de ontwikkeling van kennis, competenties en talenten kun je anderen stimuleren tot het bereiken van persoonlijke doelen. Als	leidinggevende kun je bovendien, door middel van het geven van feedback, de nodige stimulans bieden voor het bereiken van functie- of organisatiedoelen.'],

		['competence' => 'Collegialiteit ',

		'description' => 'Je houdt rekening met de behoeften en verlangens van collega’s en je kunt hen helpen en ondersteunen.'],

		['competence' => 'Commercieel inzicht ',

		'description' => 'Je bent in staat de omzet van de organisatie te verhogen door het voortdurend evalueren en inspelen op de positie van concurrenten en marktveranderingen, de wensen en behoeften van klanten.'],


		['competence' => 'Commitment ',

		'description' => 'Je hecht belang aan de missie en belangen van de organisatie of het vakgebied.'],

		['competence' => 'Communicatie ',

		'description' => 'Je bent in staat om effectief te communiceren met	verschillende doelgroepen door middel van passende communicatietechnieken en -middelen. Andere competenties zoals onder andere coaching, presenteren, rapporteren en vergadertechnieken maken hier deel van uit.'],

		['competence' => 'Computervaardigheid ',

		'description' => 'Je hebt de nodige basiskennis en -vaardigheid van	de meest gebruikte computerprogramma’s om met de computer te kunnen omgaan.'],

		['competence' => 'Conceptueel denken ',

		'description' => 'Je kan een situatie of probleem beter doorgronden	door het onderscheiden van patronen binnen een conceptueel kader en het leggen van verbindingen tussen deze verschillende patronen. Een erg	abstracte definitie voor een abstracte competentie die vooral veel creativiteit	vraagt.'],

		['competence' => 'Conflicthantering ',

		'description' => 'Je kan tactvol omgaan met tegengestelde belangen met	een grote emotionele lading en deze oplossen.'],

		['competence' => 'Confronteren ',

		'description' => 'Je kan op een directe manier de ander aanspreken op zijngedrag, zodat deze bewust wordt van zijn gedrag en het effect ervan op
		anderen.'],

		['competence' => 'Consciëntieuze houding ',

		'description' => 'Je weet je zorgvuldig en nauwgezet op te stellen bij het uitvoeren van je taken.'],

		['competence' => 'Coördineren van werkzaamheden ',

		'description' => 'Je bent goed in het organiseren van en zorgen voor een aangename en doeltreffende samenwerking tussen	verschillende mensen en (delen van) organisaties.'],

		['competence' => 'Creativiteit ',

		'description' => 'Je vindt originele oplossingen voor problemen die verband	houden met de functie. Je bent in staat nieuwe methodes te bedenken om oude te vervangen.'],

		['competence' => 'Cultureel bewustzijn ',

		'description' => 'Je schat creativiteit, ideeën, emoties, kunst, literatuur, beeldende kunst en andere uitdrukkingsvormen naar waarde en respecteert ze.'],

		//D

		['competence' => 'Delegeren ',

		'description' => 'Je bent in staat eigen beslissingsbevoegdheden en	verantwoordelijkheden op een duidelijke manier toe te wijzen aan de juiste medewerkers.'],

		['competence' => 'Demonstreren ',

		'description' => 'Je kan op een eenvoudige en nauwkeurige wijze laten zien hoe iets werkt of aangepakt dient te worden.'],

		['competence' => 'Detailgericht ',

		'description' => 'Je hebt een nauwgezet oog voor detail. Bijvoorbeeld de interpunctie in de schriftelijke communicatie of rekening houden met alle kleine variabelen bij het nemen van beslissingen.'],

		['competence' => 'Didactische vaardigheden ',

		'description' => 'Je bent in staat te bepalen wat een ander	moet leren en op welke manier deze het beste leert en kan dit in praktijk omzetten.'],

		['competence' => 'Discipline ',

		'description' => 'Je kan je schikken naar het beleid en de procedures van de organisatie. Je gaat bij veranderingen confirmatie zoeken bij de juiste autoriteit.'],

		['competence' => 'Discussiëren ',

		'description' => 'Je probeert een ander te overtuigen van je eigen mening onder je af te sluiten voor de meningen van anderen.'],

		['competence' => 'Diversiteit hanteren ',

		'description' => 'Je kan goed samenwerken met verschillende	individuen. Je accepteert en waardeert de verschillende culturen en	achtergronden van mensen.'],

		['competence' => 'Doelen stellen ', 

		'description' => 'Je kan een te bereiken doel concreet en meetbaar aangeven, welke de deadline is die ervoor opgesteld werd en op welke	manier het doel bereikt moet worden.'],

		['competence' => 'Dominantie ',

		'description' => 'Je oefent van nature invloed uit op anderen en wil als autoriteit aanvaard worden.'],

		['competence' => 'Doorvragen ',

		'description' => 'Wanneer je een onvolledig antwoord hebt gekregen, zal je vragen stellen ter verduidelijking.'],

		['competence' => 'Doorzettingsvermogen ',

		'description' => 'Je kan je gedurende langere tijd intensief met een taak bezig houden, ook bij tegenslag. Je houdt vol totdat het vooropgestelde doel bereikt is.'],


		['competence' => 'Draagvlak creëren ',

		'description' => 'Je weet mensen te motiveren voor een doel of verandering. Je herkent eventuele weerstand van mensen en bent in staat dit verzet om te buigen tot een positief standpunt.'],

		['competence' => 'Durf ',

		'description' => 'Je bent bereid risico’s aan te gaan om uiteindelijk een herkenbaar voordeel te behalen.'],

		['competence' => 'Duurzaam ondernemen ',

		'description' => 'De sociaal georiënteerde betrachting om naast	het benutten van kansen voor een beter milieu, een hogere bedrijfswinst te
		realiseren.'],


		//E

		['competence' => 'Effectief ',

		'description' => 'Je bent in staat handelingen te stellen waardoor nagestreefde	doelen verwezenlijkt worden. Je hebt weinig tijd en pogingen nodig om een		taak te vervullen.'],

		['competence' => 'Empathie ',

		'description' => 'Je kan je goed inleven in de gevoelens of gedachtegang van anderen.'],

		['competence' => 'Energie ',

		'description' => 'Je kan gedurende een lange periode in hoge mate actief zijn wanneer dit nodig is. Je kan hard werken en beschikt over het nodige uithoudingsvermogen.'],

		['competence' => 'Expertise ',

		'description' => 'Je zorgt voor het verwerven, toepassen en ontwikkelen van	kennis en vaardigheden voor eigen gebruik of om deze door te geven aan anderen.'],


		//F

		['competence' => 'Feedback geven ',

		'description' => 'Je kan het gedrag of werk van een ander positief beïnvloeden door dit gedrag of werk aan de ander te beschrijven.'],

		['competence' => 'Feedback ontvangen ',

		'description' => 'Je staat open voor de beschrijving van een ander op jouw gedrag of werk met het doel dit positief te beïnvloeden.'],

		['competence' => 'Flexibel gedrag ',

		'description' => 'Je bent in staat je eigen gedragsstijl te veranderen om een bepaald doel te bereiken indien zich problemen of opportuniteiten	voordoen.'],


		['competence' => 'Flexibiliteit ',

		'description' => 'Je kan je gemakkelijk aanpassen aan veranderende omgeving, werktijden, taken, werkwijzen, verantwoordelijkheden, beleidswijzigingen en gedragingen van anderen.'],

		['competence' => 'Formuleren ',

		'description' => 'Je kan je gedachten onder woorden brengen op een manier dat er voor de ander een duidelijk en eenduidig beeld ontstaat.'],

		//G

		['competence' => 'Gespreksvaardigheid ',

		'description' => 'Je weet je gesprekken zodanig te structureren, op	te treden en in te grijpen/bemiddelen dat het beoogde resultaat op een doeltreffende manier bereikt wordt.'],

		['competence' => 'Groepsgericht leiderschap ',

		'description' => 'Je weet richting en sturing te geven aan een groep. Je creëert samenwerkingsverbanden en weet ze in stand te houden.'],

		['competence' => 'Gunstige sfeer ',

		'description' => 'Om een persoon en/of groep in een goede stemming te krijgen weet je ze te prijzen en kan je vriendelijk of behulpzaam zijn.'],

		//H

		['competence' => 'Helikopterview ',

		'description' => 'Je behoudt het overzicht over de delen en het geheel van gegevens, een project of een vraagstuk.'],

		//]I

		['competence' => 'Impact hebben ',

		'description' => 'Je maakt een betrouwbare en positieve, krachtige indruk op anderen.'],

		['competence' => 'Impressie ',

		'description' => 'Je weet een goede indruk te maken en deze indruk in stand te houden. Je komt gepast en verzorgd over naar de normen van de organisatie.'],

		['competence' => 'Individugericht leiderschap ',

		'description' => 'Je kan richting en sturing geven aan een medewerker in het kader van diens werkzaamheden.'],

		['competence' => 'Informatieanalyse ',

		'description' => 'Je herkent en merkt belangrijke informatie op in een informatierijke omgeving. Je bent in staat verbanden te leggen tussen gegevens.'],

		['competence' => 'Initiatief ',

		'description' => 'Je bent in staat problemen of belemmeringen op te merken en zo snel mogelijk op te lossen. Je bent alert en anticipeert op opportuniteiten,		nieuwe situaties of problemen en kan er in een vroeg stadium naar handelen.'],

		['competence' => 'Inlevingsvermogen/sensitiviteit ',

		'description' => 'Je bent je bewust van de gevoelens en	behoeften van anderen en houdt hier rekening mee.'],

		['competence' => 'Innoveren',

		'description' => 'Je bestudeert en bent geïnteresseerd in toekomstige vernieuwing van producten, diensten, markten, producten en strategieën.'],

		['competence' => 'Integriteit ',
		
		'description' => 'Je houdt algemeen aanvaarde sociale en ethische normen aan in activiteiten die met de functie te maken hebben.'],

		['competence' => 'Interpersoonlijke sensitiviteit ',

		'description' => 'Uit je gedrag blijkt dat je de gevoelens en behoeften van anderen erkent. Je bent in staat je te verplaatsen in anderen en bent je bewust van de invloed van je eigen gedrag op anderen.'],

		['competence' => 'Interpretatie',

		'description' => 'De invulling en verklaring die je geeft aan een situatie of gedrag. Je hebt een goed inzicht in situaties en bent in staat de juiste betekenis toe te kennen aan de verschillende factoren in deze situatie. Je kan een situatie goed ‘lezen’.'],

		['competence' => 'Intrinsiek gemotiveerd',

		'description' => 'Jouw interesses en de persoonlijke voldoening die	je beleeft aan het uitvoeren van een taak zorgen voor een motivatie die	vanuit jezelf komt. Dit staat tegenover een motivatie die voortvloeit uit een (geldelijke) beloning, ofwel een motivatie door een te ontvangen vergoeding of salaris.'],

		['competence' => 'Inzet (Prestatiemotivatie) ',

		'description' => 'Je stelt hoge eisen aan je eigen werk en verbergt niet dat je niet tevreden bent met een gemiddelde prestatie.'],

		//K

		['competence' => 'Klantgerichtheid',

		'description' => 'Je gaat handelen naar het onderzoek dat je hebt gedaan naar de wensen en behoeften van de klant.'],

		['competence' => 'Kostenbewust handelen ',

		'description' => 'Je denkt en handelt in functie van de optimale benutting van tijd, geld en andere middelen. Je weegt de financiële consequenties af en hebt aandacht voor de beperking van kosten.'],

		['competence' => 'Kritisch denken',

		'description' => 'Je analyseert en beoordeelt informatie onafhankelijk van anderen.'],

		['competence' => 'Kwaliteitsgericht', 

		'description' => 'Je stelt hoge eisen aan kwaliteit en streeft naar	verbetering van producten of prestaties.'],


		//L

		['competence' => 'Leervermogen ',

		'description' => 'Je kan nieuwe informatie en ideeën snel opnemen, analyseren en verwerken en deze doeltreffend toepassen in de werksituatie.'],

		['competence' => 'Lef tonen ',

		'description' => 'Je bezit de eigenschap om veel dingen te durven. Je bent niet	bang om voor je eigen standpunten op te komen en deze actief na te streven.'],

		['competence' => 'Leiderschap ',

		'description' => 'Je durft initiatief en verantwoordelijkheid op je te nemen om	zo, met je draagvlak (een groep mensen die jouw leiderschap aanvaarden) strategische veranderingen te realiseren. Zie ook impact.'],

		['competence' => 'Leidinggeven ',

		'description' => 'Om je plannen te realiseren en doelen te bereiken ga je anderen aansturen.'],

		['competence' => 'Lobbyen ',

		'description' => 'Je gaat op een tactisch georganiseerde manier trachten om	spelers, die meedingen in belangrijke beslissingen, uit te leggen wat voor jou de belangen zijn en zo proberen de besluitvorming te beïnvloeden.'],

		['competence' => 'Loyaliteit ',

		'description' => 'Je schikt je naar de normen, waarden, procedures, afspraken en het beleid van de organisatie en de eigen functie / rol.'],

		['competence' => 'Luisteren ',

		'description' => 'Je kan interesse tonen en belangrijke informatie destilleren uit onderlinge gesprekken.'],

		//M

		['competence' => 'Marktgerichtheid ',

		'description' => 'Je bent in staat om actie te ondernemen om voordeel tehalen uit kansen en vernieuwingen die je opmerkt in de markt.'],

		['competence' => 'Mensenkennis ',

		'description' => 'Je hebt inzicht in de attitude, de drijfveren en verlangens en behoeften van anderen.'],

		['competence' => 'Mensgericht leiderschap ',

		'description' => 'Je bent in staat om op een stimulerende wijze	richting en begeleiding te geven aan medewerkers. Je past je stijl en manier van leidinggeven aan aan betrokken individuen. Je stimuleert de samenwerking tussen de medewerkers.'],

		['competence' => 'Milieubewustzijn ',

		'description' => 'Je interpreteert tijdens je werkzaamheden voorschriften op gebied van milieu.'],

		['competence' => 'Mondelinge presentatie ',

		'description' => 'Je kan ideeën en feiten op een heldere manier	voorstellen, gebruikmakend van juiste middelen en handelt er naar.'],

		['competence' => 'Mondelinge uitdrukkingsvaardigheid ',

		'description' => 'Je kan op een eenvoudige manier je meningen, ideeën, conclusies en standpunten aan anderen duidelijk	maken, afgestemd op het niveau van je gesprekspartner.'],

		['competence' => 'Motiveren ',

		'description' => 'Je kan anderen bewegen tot actie en betrokkenheid om een	bepaalde uitkomst te bereiken.'],

		['competence' => 'Multicultureel bewustzijn ',

		'description' => 'Je kan je in te leven in, en aanpassen aan de	normen en waarden van een andere cultuur. Je kan je goed in een ander etnisch kader inleven en erop inspelen tijdens de communicatie en indien nodig je gedrag aanpassen. Je bezit een hoge mate van interculturele flexibiliteit.'],

		['competence' => 'Multitasken ',

		'description' => 'Je kan meerdere taken tegelijk uit te kunnen voeren zonder dat de effectiviteit van je werk hieronder lijdt.'],

		//N

		['competence' => 'Netwerkvaardigheid ',

		'description' => 'Je bent goed in het leggen en onderhouden van	contacten, allianties en coalities binnen en buiten de eigen organisatie. Je weet deze te benutten voor het verwerven van informatie, steun en medewerking.'],

		//O

		['competence' => 'Observeren ',

		'description' => 'Je kan een deskundig oordeel vellen door een situatie of een persoon van een afstand te bekijken.'],

		['competence' => 'Omgaan met details ',

		'description' => 'Je kan langdurig en effectief omgaan met details, ziet het geheel en werkt zonder veel fouten.'],

		['competence' => 'Omgaan met werkdruk ',

		'description' => 'Je weet de rust te bewaren bij drukte en voelt geen stress door te veel of te weinig werk.'],

		['competence' => 'Omgevingsbewustzijn ',

		'description' => 'Je beschikt over een goede kennis van	ontwikkelingen op organisatorisch, maatschappelijk en politiek vlak of andere omgevingsfactoren (inherent of adherent aan de organisatie).'],

		['competence' => 'Onafhankelijkheid ',

		'description' => 'Bij het vormen van een oordeel of mening, of het	ondernemen van een actie ga je je niet laten beïnvloeden door anderen. Je bepaalt zelfstandig je koers.'],

		['competence' => 'Onderhandelen ',

		'description' => 'In gesprekken waar de belangen tegenstrijdig zijn, ga jetrachten een zo goed mogelijk resultaat te bekomen, zowel op inhoudelijk vlak als op het vlak van de goede verstandhouding.'],

		['competence' => 'Ondernemerschap ',

		'description' => 'Je merkt kansen in de markt op, zowel voor bestaande als nieuwe diensten of producten. Je handelt naar de nieuwe mogelijkheden die je ziet en durft risico’s te nemen met het oog op uiteindelijk voordeel voor het geheel.'],

		['competence' => 'Ontwikkelen van medewerkers',

		'description' => 'Je bent in staat de nood aan ontplooiing van medewerkers te analyseren en laat hen taken uitvoeren die bijdragen aan deze ontwikkeling. Je kan medewerkers ondersteunen in hun groei. Je geeft je feedback op een gerichte en opbouwende manier zodat	medewerkers zelf aan de slag kunnen om zich te verbeteren.'],

		['competence' => 'Oordeelsvorming ',

		'description' => 'Je weegt gegevens en methodes tegen elkaar af in het kader van relevante normen en komt tot een gemotiveerde evaluatie.'],

		['competence' => 'Opbouwend bekritiseren ',

		'description' => 'Je bent in staat een andere persoon te helpen	groeien in het verbeteren van de uitgevoerde functie door het geven van een	goed onderbouwde feedback of mening. Je begrijpt dat opbouwende kritiek	correct geformuleerd moet zijn om een positieve boodschap te brengen.'],

		['competence' => 'Oplossingsgericht ',

		'description' => 'Je werkt vastberaden naar een oplossing toe, rekening	houdend met eventuele achterliggende problemen.'],

		['competence' => 'Organisatiegericht aansturen ',

		'description' => 'Je kan de lange termijn visie omzetten in	duidelijke operationele doelen en deze vervullen door richting en sturing te geven aan de organisatie.'],

		['competence' => 'Organisatiesensitiviteit ',

		'description' => 'Je toont je bewust van de draagwijdte en de uitwerking van beslissingen en handelingen van mensen in een organisatie.'],

		['competence' => 'Organisatietalent ',

		'description' => 'Je kan problemen detecteren en een passende oplossing er voor vinden. Je beschikt over een uitstekend	probleemoplossend vermogen.'],

		['competence' => 'Oriëntatievermogen ',

		'description' => 'Je bent goed in het opzoeken en verzamelen van relevante informatie om zo tot een onderbouwde mening te komen. Je kan	het één met het ander relateren in een abstracte context.'],

		['competence' => 'Overtuigingskracht ',

		'description' => 'Je beschikt over vaardigheden die nodig zijn om anderen te overreden van een bepaalde visie en om goedkeuring te krijgen voor bepaalde ideeën, zaken of plannen.'],


		//P

		['competence' => 'Plannen en organiseren ',

		'description' => 'Je kan op een doeltreffende wijze doelen en prioriteiten bepalen en aangeven welke tijd, acties, middelen en mensen nodig zijn om je vervolgens efficiënt te organiseren om deze doelen te kunnen bereiken.'],

		['competence' => 'Positief',

		'description' => 'Je bent optimistisch ingesteld, vaak opgewekt en pakt issues aan met een positieve houding waarin je vooral aandacht hebt voor de positieve 	zaken. Uit je levenshouding blijkt dat je bewust kiest om positiviteit de boventoon te laten voeren.'],

		['competence' => 'Presenteren ',

		'description' => 'Je kan je eigen mening, ideeën of standpunt helder, duidelijk	en zonodig boeiend of begeesterend overbrengen op anderen.'],

		['competence' => 'Prestatiemotivatie (Inzet) ',

		'description' => 'Je gedrag bewijst dat je hoge eisen stelt aan je eigen werk. Je laat duidelijk zien dat je niet tevreden bent met gemiddelde prestaties.'],

		['competence' => 'Proactief ',

		'description' => 'Je kijkt vooruit, zoekt naar kansen of vernieuwing en onderneemt de nodige actie om hier voordeel uit te halen.'],

		['competence' => 'Probleemanalyse ',

		'description' => 'Je komt tot een goed inzicht door het onderzoeken van	belangrijke gegevens. Je ziet de samenhang tussen gegevens om de oorzaak van problemen te vinden.'],

		['competence' => 'Probleemoriëntatie ',

		'description' => 'Je bent in staat om zaken vanuit verschillende perspectieven te bekijken, gaat dieper op onderzoek en weet de juiste
		vragen te stellen.'],


		//R

		['competence' => 'Reflectief ',

		'description' => 'Je bent goed in het overdenken van je eigen gedachten,
		gevoelens, herinneringen en gedragingen en hier lessen uit te trekken.'],


		['competence' => 'Resoluut zijn ',

		'description' => 'Je bent iemand die vastbesloten handelt en kent geen
		terughoudendheid.'],

		['competence' => 'Resultaatgerichtheid ',

		'description' => 'Je blijft, ondanks tegenslag, problemen of afleiding,
		gericht op het bereiken van je doel.'],


		//S

		['competence' => 'Samenbindend leiderschap ',

		'description' => 'Je kan, onder andere door het stellen van
		doelen, richting en sturing geven. Je organiseert efficiënte
		samenwerkingsverbanden en helpt deze in stand te houden.'],

		['competence' => 'Samenwerken ',

		'description' => 'Je werkt mee aan een collectief resultaat door een optimale
		afstemming tussen je eigen talenten en belangen én die van de groep / de
		ander.'],

		['competence' => 'Schriftelijke uitdrukkingsvaardigheid ',

		'description' => 'Je kan je ideeën, visies, meningen, en conclusies correct en begrijpelijk neerschrijven, afgestemd op de lezer.'],

		['competence' => 'Sensitiviteit ',

		'description' => 'Je bent je bewust van je omgeving, van andere mensen, je eigen invloed erop. Uit je gedrag blijkt dat je de gevoelens en behoeften van anderen erkent.'],

		['competence' => 'Signaalgevoeligheid ',

		'description' => 'Je pikt de signalen om je heen snel op, weet ze te nuanceren en hier effectief mee om te gaan. Deze competentie isv oornamelijk van groot belang voor leidinggevenden.'],


		['competence' => 'Snel schakelen',

		'description' => 'Je kan je in een informatierijk milieu focussen op snel wisselende onderwerpen en gebeurtenissen en er doelmatig naar handelen.'],


		['competence' => 'Sociaal',

		'description' => 'Je hebt geen moeite om je tussen mensen te mengen of er naar toe te stappen. Je mengt je met gemak in een gezelschap en hebt geen	moeite om nieuwe contacten te leggen en relaties op te bouwen.'],

		['competence' => 'Stressbestendigheid ',

		'description' => 'Je hebt geen moeite met blijven presteren onder tijdsdruk,spanning van moeilijke of een veelvoud aan taken, sociale druk of bij tegenslag, teleurstelling, weerwerk of noodsituaties.'],

		['competence' => 'Synergie creëren ',

		'description' => 'Je kan groepen leiden en coördineren op een dusdanige	manier dat de productiviteit die voortkomt uit deze samenwerking groter is dan de individuele productiviteit van elke werknemer bij elkaar opgeteld.'],

		//T

		['competence' => 'Taakgericht leiderschap ',

		'description' => 'Je kan richting en sturing geven aan medewerkers op een resultaatgerichte en doelgerichte wijze. Je stelt	afdelings- en functiedoelen op, maakt taakverdelingen, instrueert mensen, maakt afspraken, je houdt een overzicht over de vorderingen en stelt bij waar	nodig.'],

		['competence' => 'Tactisch gedrag ',

		'description' => 'Je kan je eigen tactiek, strategie of gedragsstijl aanpassen indien zich problemen of kansen voordoen om een gesteld doel	te bereiken. Je bent creatief en beschikt over een hoog	improvisatievermogen en flexibiliteit.'],

		['competence' => 'Teambuilding ',

		'description' => 'Je bent in staat de onderlinge betrokkenheid van teamleden en de daarmee samenhangende samenwerking te bevorderen door het ontwikkelen van gemeenschappelijke doelstellingen en uitgangspunten.'],

		['competence' => 'Toekomstvisie ',

		'description' => 'Je weet afstand te nemen van de dagelijkse praktijk. Je kan hoofdlijnen formuleren en een langetermijnbeleid uitzetten.'],


		// V

		['competence' => 'Vasthoudendheid ',

		'description' => 'Je houdt je aan een vooraf bepaald actieplan of blijft bij bepaalde opvatting. Je laat je door obstakels of weerstand niet weerhouden	om iets tot stand te brengen.'],

		['competence' => 'Verantwoordelijk ',

		'description' => 'Je vindt je eigen taken en plichten, die van collega’s en	van de organisatie belangrijk.'],

		['competence' => 'Vergaderen ',

		'description' => 'Je kan met anderen overleggen over bepaalde materies om opinies te verzamelen, de stand van zaken bediscussiëren of tot oplossingenvan problemen komen.'],

		['competence' => 'Vernieuwingsinzicht ',

		'description' => 'Je ziet kansen in nieuwe ontwikkelingen en hebt inzicht in de toekomstige verlangens en noden van anderen.'],

		['competence' => 'Visie ',

		'description' => 'Je kan een inspirerend toekomstbeeld voor de organisatie, bepaalde afdelingen, diensten en producten uitstippelen en uiten, afstand nemen van		de dagelijkse praktijk.'],


		['competence' => 'Visie ontwikkelen ',

		'description' => 'Je kan een idee vormen waar een persoon of organisatie zich in de toekomst naar kan ontwikkelen op basis van informatie, analyse en intuïtie.'],

		['competence' => 'Voortgangsbewaking ',

		'description' => 'Je kan inspelen en houdt toezicht op de vorderingen van gemaakte plannen en afspraken.'],

		['competence' => 'Voortgangscontrole ',

		'description' => 'Je kan procedures opstellen, bewaken en uitvoeren	om het goede verloop van processen, taken of activiteiten van medewerkers en van jezelf zeker te stellen.'],

		['competence' => 'Voortgang controleren ',

		'description' => 'Je bent op de hoogte van de geplande vooruitgang en ontwikkelingen en je kan er op toezien of deze effectief	behaald worden.'],

		//Z

		['competence' => 'Zelfbeheersing ',

		'description' => 'Je kan voorkomen dat dingen uit de hand lopen en houdt controle over je eigen emoties.'],

		['competence' => 'Zelfkennis ',

		'description' => 'Je hebt inzicht in je eigen identiteit, je sterke en zwakke kanten, waarden, meningen, kwaliteiten, bekwaamheid, interesses, ambities en
		gedragingen.'],

		['competence' => 'Zelfmanagement ',

		'description' => 'Je hebt inzicht in je eigen sterktes en zwaktes en kan in	functie daarvan handelen.'],

		['competence' => 'Zelfontwikkeling',

		'description' => 'Je wint inzicht in je eigen identiteit, je sterke en zwakke kanten, waarden, meningen, kwaliteiten, bekwaamheid, interesses, ambities	en je gaat op basis hiervan handelingen stellen om de nodige bekwaamheid verder te ontplooien.'],

		['competence' => 'Zelfreflectie ',

		'description' => 'Je kan jezelf een spiegel voorhouden en stilstaan bij je werkwijzen, de keuzes die je maakt en mogelijke verbeteringen detecteren.'],

		['competence' => 'Zelfstandig ',

		'description' => 'Je kan mogelijke taken oppakken en uitvoeren zonder ondersteuning van een ander.'],

		['competence' => 'Zelfsturing ',

		'description' => 'Je kiest je eigen koers en weet deze te realiseren binnen en buiten de organisatie, je houdt rekening met je eigen interesses, sterke en		zwakke punten, waarden en ambities.'],

		['competence' => 'Zelfvertrouwen ',

		'description' => 'Je kan bij het verwoorden van je eigen visies en voorstellen een zekere indruk maken en kan deze indruk in stand houden en op anderen overdragen.'],

		];	    
    //
	foreach ($data as $key => $value) {
		Competence::create($value);
		}	
    }
}




//toestemming gekregen onder voorwaarden:
// 1. Het project is op vrijwillige basis en er is geen commercieel gewin.
// 2. Een bronvermelding naar: https://www.sollicitego.nl/sollicitatietips/curriculum-vitae/competentielijst/



// Uitgegeven in eigen beheer.
// Alle rechten voorbehouden. Copyright © Sollicitego, 2017
// Niets uit deze uitgave mag worden verveelvoudigd, opgeslagen in een
// geautomatiseerd gegevensbestand en/of openbaar gemaakt in enige vorm of
// op enige wijze, hetzij elektronisch, mechanisch, door fotokopieën, opnamen
// of op enige andere manier zonder voorafgaande schriftelijke toestemming
// van de uitgever.
// Disclaimer
// Sollicitego heeft de grootste zorgvuldigheid betracht bij de vervaardiging,
// betrouwbaarheid en actualiteit van alle gepubliceerde gegevens.
// Onjuistheden of onvolledigheden zijn echter niet altijd te vermijden.
// Sollicitego en de aan haar gelieerde en met haar samenwerkende
// ondernemingen zijn niet aansprakelijk voor directe of indirecte schade als
// gevolg van de inhoud van dit werk.
