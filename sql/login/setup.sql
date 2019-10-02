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
DROP TABLE IF EXISTS `kmom10_users`;
CREATE TABLE `kmom10_users`
(
    `username` VARCHAR(200) PRIMARY KEY NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `image` VARCHAR(100) DEFAULT NULL,
    `email` VARCHAR(100) NOT NULL,
    `role` VARCHAR(200) DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `kmom10_users`;
INSERT INTO `kmom10_users` (`name`, `password`, `image`, `email`, `username`, `role`) VALUES
    ('Administratör', '$2y$10$1.6lsuLztOd52pAppeuG5OnQU18ljhjkFsjPJunRT8QB5ekriioIS', 'img/moderator.png', 'admin@admin.se', 'admin', 'admin'),
    ('User', '$2y$10$6l6worjatjwOeu592WN3euqjsg36ticc7lgR2LzzODCg2m.f0I5zu', 'img/user.jpg', 'user@user.se', 'user', 'user')
;

SELECT * FROM `kmom10_users`;
