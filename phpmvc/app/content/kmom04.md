 
Kmom04: Databaser, ORM och scaffolding
------------------------------------

Överlag har det stötts på problem i stort set i varje moment, men lösninghar hittats till slut. Antingen genom att läsa i forumet, eller genom att titta på kurskamraternas lösningar, för att få tips. Det svåraste med denna kursen är att den är så komplex. Oftast har jag bara tid att sitta ned 0,5-1h åt gången och då hinner man inte alltid sätta sig in i problemet. En annan sak är att komplexiteten gör att man måste vara riktigt pigg och allert, vilket kan vara svårt efter en hel dag på jobbet och nattande av sonen... Detta är den övningen hittills som gett mest vad gäller PHP, databaser och ramverkslösningar.

### Formulärhantering

Otroligt kraftfullt! Så smidigt och enkelt. Kommer att använda detta många gånger framöver.

### Databashantering

Något jag antagligen kommer att använda mig mycket av framöver. Sönt att slippa skriva samma saker hela tiden. Hade stora problem att komma igång. Tyckte själva övningen var enkel, även om instruktionerna ofta känns knapphändiga. Försökte att lägga all information i formuläret för users, dvs man kan sortera på aktiva direkt i rubriken mm.

### Implementering av kommentater i databasen

Ett problem jag hade var att jag döpte ett id som ärvdes från Sessionen av kommentarerna, vilket ju är upptaget av själva databasen...
Valde att lägga in all kod i controllern för modellen av Comments, döpte dem med databas i namnet för att lättare skilja ut dem från basklassen Comments från biblioteket phpmvc. Fick ett felmeddelande att $_SESSION['form-failed'] saknades, löste et genom att lägga den kodraden inom en if sats och använda isset -metoden.

### Extrauppgiften

Extrauppgiften gjordes aldrig.


[Min ME -sida](http://www.student.bth.se/~totu13/phpmvc/Anax-MVC/webroot/kmom04/)