Das Rebussystem, ett Hallonhack, baserat på BasPers perlhack från 1999
======================================================================

Skapat av Trial and Error 2011

Docker
------------
Om du vill slippa installera lika många beroenden kan du köra i Docker. Kräver dock exempelvis Docker Desktop.

Kör då först följande i lämplig terminal bör att bygga en container, när du står i roten:

```
docker build -t rebusrally .
```

Därefter följande för att starta, mounta `C:\github\Das-Rebussystem` (ändra till din uppsättning) till containerns html-mapp, och mappa port 8080 till containerns 8080-mapp.

``` 
docker run -dp 8080:8080 -v C:\github\Das-Rebussystem\:/var/www/html rebusrally
```

Därefter går det att nå sidan på localhost:8080, eller från en annan dator på samma nätverk via serverns IP-adress.

På Docker i Windows kan det vara lite meckigt att få till skrivrättigheterna på mappen, då den mountade volymen ägs av 'root' istället för 'nobody'.
Detta kan man lösa igenom att endast bygga första delen av docker containern:

```
docker build --target rebusrally_root -t rebusrally_root .
```

 med samma volymmount och logga in på terminalen och köra:
```
chown -R nobody:nobody var/www/html
```

Efter det så skall det gå utmärkt att köra den vanliga dockercontainern.


Installation
------------

För att använda detta system behövs en webbserver med php-stöd samt
php-sqlite och php-json. Lägg hela skiten i lämplig katalog och sätt
igång!


Översikt
--------

Systemet består av två delar, presentation och rättning.
För starta presentationen öppna `present.php` i lämplig browser.
Presentationen består av ett antal slides som genereras av en datafil
som beskrivs nedan. Filen beskriver alla lag och grenar i rallyt.
Presentationen blir roligare om det finns resultat för de olika 
grenarna, det är där rättningen kommer in. Öppna `r.php` och beskåda
alla tomma fält där prickar ska fyllas i.


Ditt rally
----------

Välj ett namn på rallyt, tex ht2011, och lägg in det i `rebus_settings.php`.
All information om ett specifikt rally finns i en fil med namnet `ht2011.php`.
Alla data som hör till rallyt finns i en katalog med namnet `ht2011`.

I ht2011.php filen finns en samling arrayer med data. Dessa är
relativt självförklarande, men här är ändå en förklaring:

* teams: En array som mappar lagnamn mot lagnummer och antal lagmedlemmar.
Antal lagmedlemmar behöver endast sättas till rätt antal om man vill
använda prickberäkning baserat på antal lagmedlemmar. För att markera
blåbärslag och småbil osv kan man använda syntaxen:

'Lag namn' => array(<lag nummer>, <antal lagmedlemmar>, <flair>),

Flair en bild som läggs framför lagnamnet i grafer, för att använda tex markera
en småbil kan man skriva '<small>' och skapa en bild som heter small.png.

* events: En ganska stor array som innehåller alla rebusar, pyssel och
plock och övriga "grenar" som ger prickar, tex öppnade kuvert. 
De olika grenarnas kortnamn mappas mot deras fullständiga namn. 
Kortnamnens begynnelsebokstav måste vara R
för rebusar, S för stjälprebusar, P för pyssel, FP för fotoplock och
TP för tallriksplock. Övriga grenar behöver inte heta något speciellt.

* parts: Här mappas rallyts etapper upp. Det är enligt denna gruppering
som presentationen kommer att visas. Etapperna byggs upp av kortnamnen
som definierades i events arrayen enligt ovan. Läs nästa avsnitt för mer
information!

* maxPoints: Pyssel mappas mot antal maxprickar i det pysslet. Om 
maxprickar finns för ett pyssel visas det i presentationen
och på rättningssidan.

* info: Här kan man mappa in specialinformation per gren. Denna info
visas på rättningssidan till stor hjälp för de stackars satar som
rättar. Man kan givetvis använda regexpar för att mappa.
Man kan använda specialsyntaxen: <red> för att markera texten
röd om något är exakt viktigt. <Xp> ersätts med X multiplicerat med
antalet lagmedlemmar.


Etapper
-------

En etapp är antingen en enda gren som bara anges med kortnamnet eller
så består den av flera grenar, enligt formatet `<etappnamn> =>
array(<grenar>)`. Efter att grenarna har visats generas automatisk en
summeringsslide som heter 'Summering <etapp>'. Om namnet på etappen är
'Etapp X' och det finns en bild som heter `etappX.xxx` (xxx är jpg,
png eller gif) kommer bilden att visas i en egen slide. På samma sätt
visas bilder för pyssel och plock om det finns en bild med namnet
`gren<grenkortnamn>.xxx` eller bara `<grenkortnamn>.xxx`.

Det speciella grennamnet `*sum*` används för att summera resten av
grenarna i en array och presentera resultat i en sorterad lista. 
På detta sätt kan man summera olika etapper, även
med fördel rekursivt. Man kan alternativt använda `*sumcomp*`, effekten
blir liknande som med `*sum*` men dessutom görs en animation som visar hur
lagens position har ändrats jämfört med den första sliden efter
`*sumcomp*`.

För extra effekt kan man lägga in en bild (som får titeln 'Lunch'):

    *picture*Lunch:lunch.jpg

eller en speciallösning av en rebus:

    *solution*S11puh

eller en event summering (första posten efter *esum* blir titeln):

    array(*esum*, 'Stjälpplock totalt', 'StjPlk', 'ÖppPlk')

En gren som presenteras som sorterad (kan används för tex stilpris):

    *sorted*Stil

Detta verkade nog mycket mer komplicerat än det är, utgå från en gammal
fil så går det lätt. Använd webserverns log för att hitta eventuella
syntaxproblem.

Här är ett utdrag från ht2011.php:

    ...

    'Etapp 4' => array('R 4', 'P DOD', 'P HOP', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' => 
      array('*picture*Lunch:lunch.jpg',
            'P GRI', 'P TPS', 'P TAT', 'P HZZ', 'P TUP', 'ÖppPlk', 'StjPlk',
            array('*esum*', 'Stjälpplock totalt', 'StjPlk', 'ÖppPlk'),
            'ÖppReb',
            'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
            'S 8', 'S 9', 'S 10', 'S 11', 
            '*solution*S11puh', 'S 12',
            array('*esum*', 'Stjälprebusar totalt',
                  'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
                  'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12')),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunchsummering'),

    ...

Här definieras två etapper, nämligen 'Etapp 4' som innehåller en rebus
och ett antal pyssel och plock. Även tidprickar för lunch visas
här. Eftersom etappen heter 'Etapp 4' visas även bilden som heter
`etapp4.jpg`. Efter att alla grenar har presenteras kommer en
automatisk summeringslide som visar resultatet av etappen och sedan
en sorterad av summering av hela rallyt så långt ('Totalt efter Etapp 4').

Lunchetappen inleds med en bild, sedan ett antal pyssel och en
summering av stjälpplock. Ett antal stjälprebusar presenteras
inklusive en alternativ lösning, till slut en summering av
stjälprebusarna och ett totalresult efter lunchen.


Rebusar
-------

Rebusar ska ha filnamn `Rn.txt`, `Hn.txt`, `Bn.txt`, `Xn.txt` eller `Sn.txt` för vanliga rebusar,
hjälprebusar, blåbärsrebusar, bonusrebusar eller stjälprebusar, där n är numret på rebusen. För att göra
alternativlösningar kan man byta ut siffran mot valfri text och sedan använda
t.ex. '*solution*S<text>' som beskrivs ovan.

Blåbärs-rebusar visas bara om de är med i arrayen bluerebus. Exempel:

$bluerebus = array(2, 3, 4, 6, 7, 8);

Vill man inte ha några blåbärsrebusar gör man en tom array.

I rebusfilerna kan man använda dessa taggar:

    \bild <bild>
    \rebus <rebus start>
    \ort <rebussvar>
    \upphovsman <signatur>
    \av <signatur>
    \op <rebus operation>

Allt annat blir vanlig text.

Det finns ett Python-script (check.py) för att kolla att rebusarna är korrekta.


Rättning
--------

All inmatad information finns i en sqlite-databas som skapas i
rallyts katalog om den inte finns. Filnamnet är `db`. För att
rensa bort allt och börja med en ny databas är det bara att ta 
bort den filen. Se dock till att inte fler än en dator skapar
upp en ny databas. Det tar en liten stund att skapa upp den,
men när den väl finns på plats kan flera använda den samtidigt.

Glöm inte att sätta lämpliga rättigheter så att webservern kan
skriva i databsen. Oftast ska man göra:

    chgrp www-data <katalog> <katalog>/db
    chmod g+w <katalog> <katalog>/db

För att mata in resultat surfar man till `r.php` på servern.
Där möts man av en stor matris. Röd bakgrundsfärg betyder att
ingen har matat in något i den cellen. Vitt betyder att fältet
är inmatat. Grönt blir fältet om data matats in av någon annan
och du har fått det infört i ditt fält. Ajax!

Datat skickas till databasen när man lämnar en cell. Data hämtas
kontinuerligt från databasen, kolumn för kolumn. Det är en halv
sekund mellan kolumnuppdateringarna, så det tar en stund att
uppdatera hela matrisen.


Presentation
------------

När som helst kan man kika på presentationen genom att surfa till
`present.php`. Man navigerar mellan sidorna i presentationen genom 
att använda piltangenterna eller page up, page down. Vi använde
en trådlös presenterarmojt som var hårdkodad till page up, page down.


Statisk presentation
--------------------

För att generera en statisk presentation (ren html som inte behöver
en databas eller php) använder man `static.php` från kommandoraden,
och pekar ut en mapp där resultatet ska läggas.

Om du kör sidan i Docker, kan du köra följande:

```
docker exec -it <container-id> /bin/sh
```

I shell kör du sedan `php static-php .` för att generera den statiska sidan, html-filerna hamnar i rotmappen.

Remote
------

För att få upp presentationen på fler än en skärm samtidigt använder
man inte VNC (som vi gjorde...). Däremot kör man lämpligtvis med `remote.php`:
sidan laddas på den eller de datorer som
är kopplade till projektorer etc. Sedan kör man den "vanliga" `present.php`
på en dator som då styr vad som visas på remote-datorerna.

Det finns också ett script (`stats.php`) som visar hur många procent som är rättade.

Övrigt
------

I `rebus_settings.php` går det att ändra diverse inställningar, tex
kan man få länkar till individuella sidor i presentationen
genom att sätta `index_links` till 1.

Det mesta av det grafiska går att justera med css. Just nu är det
en css-mall som heter `<rallynamn>.css`.
