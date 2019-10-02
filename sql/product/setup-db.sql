--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a test user
--
CREATE DATABASE IF NOT EXISTS elpr18;
GRANT ALL ON elpr18.* TO user@localhost IDENTIFIED BY "pass";
USE elpr18;
