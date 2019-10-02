---
#title: Dokumentaion

---
Dokumentaion
=========================

Det här är en beskrivning av hur webbplatsen är uppbyggd och hur kodstrukturen är gjord.

Webbplatsen har följande namespaces, Content, Base, Login, MyTextFilter, Product.
Dessa finns i src mappen och varje namespace har en klass och en kontroller.

Content hanterar nyheter och erbjudanden samt sidor så som Om och Hem. Denna kontroller ContentController är monterad till /content.

Base har en BaseController som används för att hantera Hem och Om, den är monterad till null och är alltså default Controller. Base saknar en egen klass utan använder sig istället av Content och Product för att hämta information från databasen.

AnaxFlatFileController är monterad till /Dokumentaion för att hantera denna sida.

Product namespace har en klass Product som hämtar och skriver all information till databasen som har med produkter att göra och ProductController är monterad till /product och hanterar product förfrågningar.

Namespacet Login består av en Login klass och en LoginController, Controller är monterad till /login och hanterar allt som berör inloggningen att göra. Samt de administrations delar som administratören kan utföra nås via denna kontroller som sedan använder metoder i Product och Content.

### Databas
Följande är ett diagram av databasen och dess tabeller som används för denna webbplats.

Det finns tre tabellet i databasen, en för användaren och dessa roll och profil information.

Product tabellen håller all information kring produkterna, för att kunna presentera detta på webbplatsen.  

Content tabellen används för nyheter och erbjudanden samt sidorna Om och Hem.

![Er-diagram](image/er.png)


### Enhetstesning

Det går att köra make phpunit och make test för att utföra tester i projektet. Däremot har jag problemet att nästan alla metoder och controllers använder sig av databasen vilket gör att det blir väldigt svårt att testa. Det hade nog kanske gått om man visste mer om hur man kan mocka sina metoder och klasser för att testa. Det är tyvärr inget som vi har gått igenom kursen och därmed har jag valt att inte göra något annat än att testa en metod i en Controller klass då det var den enda som inte använde sig av databasen eller var protected.


### phpdoc

Make doc går att göra för att generera api dokumetaion och dokumentationen finns i doc katalogen i projekt roten.
