 
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