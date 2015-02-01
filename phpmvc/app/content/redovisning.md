Redovisning
====================================

Kmom05: Bygg ut ramverket
------------------------------------

Detta kursmmentet är det som gått snabbast. Har valt att göra en liten modul, då tiden är knapp för resterande övningar i kursen. I gengäld så är själva tanken med övningen att lära sig Github och Packagist, vilket jag tycker har greppat ganska bra.

Min modul heter Thurex/Thurextable.

### Val av modul

Då jag tycker det är väldigt krångligt med HTML och alla dessa olika taggar så passar en hjälp med HTML -tabeller bra för mig. 

### Utveckling av modul

Försökte att lägga all styling i klassen. Tyvärr kunde gick det inte att göra hover i styling för respektive element, utan då måste man använda sig av klasser i css filer. Därför finns en parameter som array för att knyta an klasser till respektive element i tabellen. 

### Packagist

Det var inga problem att publicera på Packagist. Det fanns väldigt utförliga instruktioner på dess sajt.

### Integrering i ramverket

Klassen fungerar egentligen som en stand-alone. Inga problem med integrering. Inga problem att få klassen att fungera med Anax.

### Extrauppgiften

Extrauppgiften gjordes aldrig.


[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom05/)
 
Kmom04: Databaser, ORM och scaffolding
------------------------------------

Överlag har det stötts på problem i stort set i varje moment, men lösning har hittats till slut. Antingen genom att läsa i forumet, eller genom att titta på kurskamraternas lösningar för att få tips. Det svåraste med denna kursen är att den är så komplex. Oftast har jag bara tid att sitta ned 0,5-1h åt gången och då hinner man inte alltid sätta sig in i problemet. En annan sak är att komplexiteten gör att man måste vara riktigt pigg och allert, vilket kan vara svårt efter en hel dag på jobbet och nattande av sonen... Detta är den övningen hittills som gett mest vad gäller PHP, databaser och ramverkslösningar.

### Formulärhantering

Otroligt kraftfullt! Så smidigt och enkelt. Kommer att använda detta många gånger framöver.

### Databashantering

Något jag antagligen kommer att använda mig mycket av framöver. Sönt att slippa skriva samma saker hela tiden. Hade stora problem att komma igång. Tyckte själva övningen var enkel, även om instruktionerna ofta känns knapphändiga. Försökte att lägga all information i formuläret för users, dvs man kan sortera på aktiva direkt i rubriken mm.

### Implementering av kommentater i databasen

Ett problem jag hade var att jag döpte ett id som ärvdes från Sessionen av kommentarerna, vilket ju är upptaget av själva databasen...
Valde att lägga in all kod i controllern för modellen av Comments, döpte dem med databas i namnet för att lättare skilja ut dem från basklassen Comments från biblioteket phpmvc. Fick ett felmeddelande att $_SESSION['form-failed'] saknades i CForm.php, löste det genom att lägga den kodraden inom en if sats och använda isset -metoden.

### Extrauppgiften

Extrauppgiften gjordes aldrig.


[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom04/index.php/redovisning)

Kmom03: Bygg ett eget tema
------------------------------------

### Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?

Jag har inga som helst erfarenheter sedan tidigare av CSS -ramverk.


### Vad tycker du om LESS, lessphp och Semantic.gs?

Tog alldeles för lånmg tid för mig att sätta mig in i allt, till en början fungerade ingenting, men som vanligt började det växa fram efter att ha kikat lite på andra lösningar. Nu känns det som att jag har koll på det, men inte mer. I övrigt känns det bra att kunna lägga upp teman enkelt med dessa verktyg.


### Vad tycker du om gridbaserad layout, vertikalt och horisontellt?

Mycket bra. Väldigt lätt att sätta upp en layout och enkelt att ändra. Snabbt och enkelt.


### Awesome

Intressant! Kommer jag definitivt att använda mig av i framtiden, riktigt bra med alla dessa ikoner. Kul grej att kunna få dem att spinna runt också. Ser lite flashigare ut. Också enkelt att använda.


### Mitt tema

Försökte att göra det så enkelt som möjligt. Härma mitt gamla tema, testa att lägga asides. Lade till en på högersida, som sedan försvinner vid små skärmstorlekar. Detta med små skärmstorlekar stämmer inte riktigt då det är upplösningen som syftas. Min mobiltelefon har bättre upplösning än min gamla bildskärm, så det tog en stund innan jag fattade vad som var fel. Hade varit bra att veta hur man tar reda på om det verkligen är en mobil/surfplatta och hur man kan gå tillväga då.


Extrauppgiften utfördes aldrig.

Övningen kändes bra, även om den tog alldeles för lång tid som vanligt. Många av verktygen som användes till denna övningen kommer jag definitivt att använda i framtiden. Känns mer och mer som jag börjar lära mig webprogrammering. Det är kul!

[Theme.php](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom03/theme.php)

[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom03/)

Kmom02: Kontroller och modeller
------------------------------------

Utgåva 2:

Det tog en stund att komma på hur jag skulle lösa kravet med skilda kommentarsystem på olika sidor. Efter lite frågor i forumet och mycket undersökande i andras kod så klarnade allt. Då förstod jag vad Mos menade med att skicka med en variabel från index sidan. Därefter blev det en enkel kodning, faktiskt väldigt enkel. Däremot sitter inte Html kodandet ännu, men antar att det kommer bara man lägger ned lite tid på att sitta och koda.

Ett annat fel som uppstod som jag till slut fick ta hjälp från forumet flera gånger var ett anrop till en array som var felaktig. Anropet echo array genererade ett fel, som olyckligtvis inte kom fram som localhost utan endast när koden var uppläst till Bths server. Då jag inte förstod felet trots att felmedelandet pekade på att anropet till en array var felaktig, så trodde jag ändå att felet var kompabilitetsproblem mellan Bths server och mina filer, Utf-8 tex. Fick hjälp i forumet av dali14 som pekade på att anropet till array var felaktig.

Utgåva 1:

Sidorna som har olika kommentarsystem är Me -sidan och Redovisning (rubriken).
 
Efter denna uppgift kommer varje moment att finnas under ett separat arkiv under webroot. Detta för att åskådligglra ramverket lite bättre. Varje kursmoment blir då en egen sajt.

Något som känns lite konstigt är att alla template filer odyl återfinns i ramverket och inte under webroot. Om det hade funnits under webroot så hade det medfört större variaton på sajterna i ramverket. Nu kan det bli svårt att erhålla flexibilitet i designen, då det mestadels endast blir via css filen man ändrar utseendet.

Composer känns som ett smidigt sätt att utöka ett ramverk med nya paket. Det känns nästan lite magiskt att det är så enkelt att få ner ett helt paket. Fick göra om laborationen några gånger då jag inte riktigt förstod uppbyggnaden på vårt ramverk. Trodde först att vi bara skulle utöka från kmom01, men kmom02 är helt nytt ramverk.

Packagist känns som ett trevligt sätt att leta upp paket på. Hittade flera olika paket och råkade av misstag ladda ner ett par riktigt stora paket.

Denna laborationen har gjorts ett antal gånger från början. Förstod inte riktigt hur upplägget på vårt ramverk skulle vara, tils jag förstod att det var ramverket som vi laddade ner som vi skulle använda.

Har lite svårt se hur allt hänger ihop, men ser var allt ska vara för att synas. Känns som relativt lätt att lägga till sidor på en sajt. Börjar ana att *.md filerna snart kommer att ersättas av databas lagrad information.

Kommentarerna har bara lagts in, kändes lite konstigt att åskådliggöra informationen från användaren på annat sätt än just default då ändå ingenting sparas annat än i aktuell session. Bättre att ordna koden när inläggen/kommentarerna sparas till databas.

[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom02/)



Kmom01: Gör en me-sida i Anax MVC
------------------------------------
 
Började med att läsa artiklarna som hörde momentet till, därefter skummade jag igenom uppgiften, för att sedan göra övningen. Den gick inget vidare, men istället för att börja om fortsatte jag. Uppgiften gjordes från sctratch och då och då kikade jag på en redan inlämnad övning.

Flödet kändes ganska bra. Måste erkänna att jag inte förstår in i minsta detalj vad som sker, men flödet har jag koll på. Jag vet hur jag ska lägga till sidor. Har inte försökt ändra sid -layout speciellt mycket, men antar att det kommer övningar framöver för aside mm.

Lade upp redovisningen även som undermenyer, mest för att ha en bra mall. Trevligt med menyer som även växer vertikalt.

All programmering har gjorts lokalt för att senare lyftas över till www.bth.se

Följande verktyg/program har använts:

* Windows 8.1
* NetBeans IDE 8.0
* FileZilla
* Dreamveawer
* Firefox
* WAMP

KRAV 1: Använd Anax MVC
> Uppnåtts.

KRAV 2: Skapa sidor för en presentation av dig, dina redovisningstexter och för att visa källkod.
> Uppnåtts.

KRAV 3: Använd en byline på sidorna för presentation och på redovisningssidan.
> Uppnåtts.

KRAV 4: Sidornas innehåll skall skrivas i Markdown.
> Uppnåtts.

KRAV 5: Skapa din egna header, footer och navbar för webbplatsen.
> Uppnåtts.

KRAV 6: Stöd “snygga länkar”.
> Uppnåtts.

KRAV 7: Ändra style och logga så webbplatsen blir lite mer “personlig”.
> Uppnåtts.

[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/kmom01/webroot/) 