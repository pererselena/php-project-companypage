--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS elpr18;
--  GRANT ALL ON elpr18.* TO user@localhost IDENTIFIED BY "pass";
--  USE elpr18;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for Content
--
DROP TABLE IF EXISTS `kmom10_content`;
CREATE TABLE `kmom10_content`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `path` CHAR(120) UNIQUE,
    `slug` CHAR(120) UNIQUE,

    `title` VARCHAR(120),
    `data` TEXT,
    `type` CHAR(20),

    -- MySQL version 5.6 and higher
    `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    -- MySQL version 5.5 and lower
    -- `published` DATETIME DEFAULT NULL,
    -- `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- `updated` DATETIME DEFAULT NULL, --  ON UPDATE CURRENT_TIMESTAMP,

  `deleted` DATETIME DEFAULT NULL

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `kmom10_content` (`path`, `slug`, `type`, `title`, `data`) VALUES
    ("hem", null, "page", "Välkommen till Sunset!", "Sunset är en butikskedja med mer än fyrtio års erfarenhet av solavskärmning för fönster, altan, uteplats – ja, allt för både utomhus och inomhus. Hos oss hittar du smarta produkter av hög kvalitet med fokus på design och funktion för både konsument och projektmarknad. Vi hjälper dig med allt från rådgivning och måttagning till installation, så att du kan koppla av under markisen. "),
    ("om", null, "page", "Om", "Den här webbplatsen är skapad till företaget Sunset AB som säljer solskydds produkter. Sidan används för att sälja och marknadsföra deras produkter.  
Webbplatsen är byggd som ett CMS system så att man kan ändra och lägga till information på olika sidor. Det finns en inlogningssida med olika rättigheter.   
Den här webbplatsen är skapad som ett examinationsprojekt i kursen OOPHP vid Blekinge tekniska högskola av Elena Perers.  
Elena Perers är en student i programmet Webbprogramering vid BTH. Härstammar från Ryssland och har börjat en ny karriär som webbutvecklare här i Sverige."),
    ("blogpost-1", "att-valja-vav", "news", "Att välja väv.", "En avgörande faktor för hur slutresultatet för hur solavskärmningen blir är väven. Här listar vi fyra viktiga saker att tänka på. Oavsett vilken väv du väljer till solavskärmningen så håller de högsta kvalitet och ger bra skugga och solskydd. Men det finns ett par saker som är bra att tänka på när det är dags att välja väv.  
![Tyg](../../image/product/vav.jpg?w=900&h=300&crop-to-fit)  
### Vävens färg. ###  
Ljuset och färgtonen inomhus påverkas av markisens väv. Väljer man till exempel en ljusblå markisväv får också ljuset inomhus en blåaktig ton. Tänk också på att eventuella mönster på väven får effekt på inomhusmiljön.  
### Mörk eller ljus väv? ###  
När det gäller screenvävar har mörka och ljusa vävar samma funktionalitet, fast med skillnaden att den ljusa väven reflekterar värmen medan den mörka absorberar den – vid fönster som har G-värde 0,32 (normalglas) gör det därför ingen skillnad. En skillnad som dock är värd att beakta är att det är lättare att se ut genom väven om den är mörk. En ljus väv är mera bländande och kan skapa en alltför ljus inomhusmiljö vilket kan medföra att det blir svårare att utföra arbeten där data- och teveskärmar är viktiga arbetsredskap. Om du vill skapa en behaglig inomhusmiljö anpassad för kontor kan du därför med fördel välja en mörk screenväv.  
Om väven är transparent ger den ljusa väven mer diffusa konturer medan sikten blir avsevärt mycket skarpare med mörk väv.  
### Insynsskydd. ###  
En ljus väv har en mycket hög avskärmningsfaktor och hindrar insyn i större omfattning än en mörk. En av våra särskilt smarta vävar har en transparens på endast 1–3 procent. Tack vare en kombination av en vit utsida, vilket reflekterar ljuset bra, samt mörk väv på insidan kan du ändå se bra ut genom väven. Denna väv passar särskilt bra för screenmarkiser och markisoletter.
### Transparens. ###
Våra screenvävar finns med olika grad av transparens. På vissa är transparensen endast 5 procent men faktum är att vi tack vare det mänskliga ögats smarta konstruktion ändå upplever att vi ser bra ut genom fönstret. Om målet är att screengardinen ska vara särskilt effektiv finns även en väv med bara 1 procents transparens."),
    ("blogpost-2", "kopa-plisse-och-lamellgardiner", "news", "Funderar du på att köpa plisségardiner eller lamellgardiner?", "Att välja plisségardiner eller lamellgardiner till dina fönster är både ett elegant och smart val. Tack vare sin konstruktion kan de användas till många kreativa lösningar och dessutom motoriseras. Här hjälper vi dig med några viktiga saker att tänka på inför köpet.  
![Plisségardiner](../../image/product/plisse.jpg?w=300&h=240&crop-to-fit)
### Forma plisségardiner som du vill ###  
En plisségardin passar utmärkt i allt från det stilrena vardagsrummet till det lekfulla barnrummet eller köket. Med sina två lister i ändarna och den veckade väven påminner den om ett dragspel och kan anpassas till både fyrkantiga och trekantiga fönster. Du kan även montera dem mellan glasen i dina fönster.  
### Begränsa insynen med plisségardiner ###  
Med aluminiumlister i varje ände kan de fästas både i fönstrets övre och nedre kant, eller med en helt flexibel fästpunkt. En smart konstruktion i de fall du vill kunna begränsa insynen i vissa delar av fönstret, men fortfarande släppa in ljus.  
### Lamellgardiner för stora glaspartier ###  
Ett smart val för större glaspartier är lamellgardiner, som ger ett bra skydd mot både solljus och värme. Hur mycket ljus som ska släppas in reglerar du själv genom att vinkla lamellerna. Förutom den funktionella aspekten kan lamellgardiner också fungera som en stilren inredningsdetalj eller rumsavdelare. Lamellerna kan enkelt kapas."),
    ("blogpost-3", "markisvav-textil", "news", "Färger och mönster för alla fönster och uteplatser", "Har du ett modernt hus som präglas av strama linjer? Då kan det ofta vara klokt att undvika alltför starka färger. Här fungerar ofta hela gråskalan alldeles utmärkt, från svart till vitt. Om du bor nära havet eller om naturen runtomkring har kraftiga kontraster kan du också titta närmare på en mättad blå eller röd färg på markisen.  
![Plisségardiner](../../image/product/f-markis.jpg?w=300&h=240&crop-to-fit)  
### Markiser för röda hus ###  
Röda hus är ofta en utmaning när det gäller markiser, oavsett om du har ett gammalt hus målat i Falu Rödfärg eller ett nyproducerat hus i samma tradition. Men färger som senapsgult, mossgrönt eller gråblått brukar vara säkra kort.  
### Markiser för gula hus ###  
Gult har en stor spännvidd. Många gula hus går i ljusa nyanser som närmast för tankarna till beige. Men så finns också de kraftigare gula nyanserna som ofta återfinns på äldre trähus. Här kan du prova dig fram med beige och gröna alternativ.  
### Markiser för blå hus ###  
Den blå färgen på husfasader är ofta blek, mild eller går mot grått. Här kan du prova dig fram med milda kontraster eller väv med ränder som matchar fasaden. Hämta inspiration till markiserna från fönsterfoder eller varför inte från trädgården och omgivningarna.  
### Markiser för svarta hus ###  
Svarta fasader ger tyngd och tål mycket. Här passar oftast hela gråskalan och de bruna nyanserna för markiser, men du kan också experimentera med kraftiga accenter. Tänk på att svarta fasader ofta får markisen att se ljusare ut än vad den faktiskt är."),
    ("blogpost-4", "sommarerbjudande", "offer", "Sommarerbjudande 20% rabatt på följande solovent!", "Under hela sommaren har vi 20% rabbat på solovent i standart utförande. Du kan se produkten [här >>](../../product/product/5)"),
    ("blogpost-5", "medlemserbjudande", "offer", "Medlemserbjudande 10% rabatt på alla produkter!", "Villaägarna-medlemmar har 10% rabatt hos oss på nya persienner och markiser. Detta går inte att kombinera med andra erbjudanden. Ange ditt Villaägarna-medlemsnummer när du kontaktar oss för att erhålla 10% rabatt på materialkostnaden när du kontaktar oss.. Du kan se produkter [här >>](../../product)");

SELECT `id`, `path`, `slug`, `type`, `title`, `created` FROM `kmom10_content`;

SELECT * FROM `kmom10_content`;
