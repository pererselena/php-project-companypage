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
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `kmom10_product`;
CREATE TABLE `kmom10_product`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(1000) DEFAULT NULL,
    `image` VARCHAR(100) DEFAULT NULL,
    `category` VARCHAR(100) DEFAULT NULL,
    `profile` VARCHAR(100) DEFAULT NULL,
    `sunscreen` VARCHAR(100) DEFAULT NULL,
    `options` VARCHAR(100) DEFAULT NULL,
    `recommended` VARCHAR(5) DEFAULT NULL,
    `added` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `kmom10_product`;
INSERT INTO `kmom10_product` (`name`, `description`, `image`, `category`, `profile`, `sunscreen`, `options`, `recommended`) VALUES
    ('Screenmarkis', 'En stabil och tålig screenmarkis för utomhusbruk, dimensionerad för att passa något större fönster. Väven är inbyggd i en kassett och är helt skyddad mot väder och vind i indraget läge. Markisen löper jämnt, och närmast fönsterrutan.', 'image/product/screen.jpg', 'Utomhus', 'Lackerad aluminium', 'Screenväv (GF600)', 'Sol- och vindautomatik', 'yes'),
    ('Klassisk markis', 'En av våra mest klassiska markiser som nu har uppdaterats med ny, stilren design på kassett och gavlar. Medio passar de flesta typer av byggnader och markisen manövreras enkelt med motorstyrning.', 'image/product/markis.jpg', 'Utomhus', 'Lackerad aluminium', '100% akryl (teflonimpregnerad)', 'Sol- och vindautomatik, mekanisk, fjärstyrd', 'yes'),
    ('Lamellgardin', 'Lamellgardin med 127 mm breda lameller. Du väljer utformning, färg och stil helt utifrån hur fönstren ser ut, rummets uttryck och hur du vill manövrera gardinen.', 'image/product/lamellgardin.jpg', 'Inomhus', 'none', 'Kan fjärrmanövreras (extra tillval)', '127 mm Lamellväv (välj från hela vårt vävsortiment)', 'no'),
    ('Plissé', 'Med en plisségardin får du ett behagligt ljus i rummet. Till alla plisségardiner har du ett mycket stort urval av vävar i olika mönster, kulörer och kvaliteter. Denna hissas upp och ned med ett handtag på underlisten.', 'image/product/plisse.jpg', 'Inomhus', 'Aluminium med plastdetaljer', 'none', 'Sidostyrning med fjäderspänd lina', 'no'),
    ('Solovent', 'Reglerbara solskyddslameller av härdat screentryckt glas. Lamellerna kan utföras stående eller liggande och kan vara fast monterade eller vridbara som då regleras som manuellt eller motordrivet system med automatisk styrning. Systemet anpassas helt efter projekt.', 'image/product/solovent.jpg', 'Utomhus', 'Strängpressad aluminium', 'Screentryckt laminerat härdat glas', 'Solautomatik eller kan fjärrmanövreras', 'yes'),
    ('Rullgardin', 'Effektgardinen kan närmast beskrivas som en ställbar rullgardin. Väven regleras enkelt och steglöst i flera lägen beroende på hur mycket ljusinsläpp/insynsskydd du önskar och vilken effekt du vill att ljuset ska ha i rummet. Effektgardinen kan regleras med sidodrag eller motor och du kan med fördel välja till en stilren kassett.', 'image/product/rullgardin.jpg', 'Inomhus', 'Lackerad aluminium', 'none', 'Motor, sidodrag', 'yes')
;

SELECT * FROM `kmom10_product`;
