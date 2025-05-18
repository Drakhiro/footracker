SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `footracker`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `User` (
    `ID` INT AUTO_INCREMENT PRIMARY KEY,
    `Mail` VARCHAR(255) UNIQUE NOT NULL,
    `Username` VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

-- Insérer un utilisateur administrateur
INSERT INTO User (Mail, Username, Password) VALUES
('admin@example.com', 'admin', 'admin');

-- Insérer un utilisateur standard
INSERT INTO User (Mail, Username, Password) VALUES
('user1@example.com', 'user1', 'mypassword456');

-- Insérer un autre utilisateur standard
INSERT INTO User (Mail, Username, Password) VALUES
('user2@example.com', 'user2', 'anotherpassword789');

-- Insérer un utilisateur invité
INSERT INTO User (Mail, Username, Password) VALUES
('guest@example.com', 'guest', 'guestpassword');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
-- --

-- CREATE TABLE IF NOT EXISTS `conversations` (
--   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',
--   `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indique si la conversation est active',
--   `theme` varchar(40) NOT NULL COMMENT 'Thème de la conversation',
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --
-- -- Contenu de la table `conversations`
-- --

-- INSERT INTO `conversations` (`id`, `active`, `theme`) VALUES
-- (1, 1, 'Le web à l''IG2I'),
-- (2, 1, 'La champions League');

-- -- --------------------------------------------------------

-- --
-- -- Structure de la table `message`
-- --

-- CREATE TABLE IF NOT EXISTS `message` (
--   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du message',
--   `idConversation` int(11) NOT NULL COMMENT 'Clé étrangère vers la table des conversations',
--   `idAuteur` int(11) NOT NULL COMMENT 'clé étrangère vers la table des auteurs',
--   `contenu` varchar(100) NOT NULL COMMENT 'Contenu du message',
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --
-- -- Contenu de la table `message`
-- --

-- INSERT INTO `message` (`id`, `idConversation`, `idAuteur`, `contenu`) VALUES
-- (1, 1, 3, 'Que penses-tu de la nouvelle organisation des cours d''ISIM ? Pas mal, non ?'),
-- (2, 2, 4, 'Quel est ton pronostic pour les quarts ?'),
-- (3, 2, 3, 'Le PSG va se qualifier !'),
-- (6, 2, 4, 'Pas sûr ...'),
-- (5, 1, 4, 'Oui, tu as raison');

-- -- --------------------------------------------------------

-- --
-- -- Structure de la table `users`
-- --

-- CREATE TABLE IF NOT EXISTS `users` (
--   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire, identifiant numérique auto incrémenté',
--   `pseudo` varchar(20) NOT NULL COMMENT 'pseudo',
--   `passe` varchar(20) NOT NULL COMMENT 'mot de passe',
--   `blacklist` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est en liste noire',
--   `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est un administrateur',
--   `connecte` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est connecte',
--   `couleur` varchar(10) NOT NULL DEFAULT 'black' COMMENT 'indique la couleur préférée de l''utilisateur, en anglais',
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --
-- -- Contenu de la table `users`
-- --

-- INSERT INTO `users` (`id`, `pseudo`, `passe`, `blacklist`, `admin`, `connecte`, `couleur`) VALUES
-- (3, 'Tom', 'web1', 0, 1, 0, 'orange'),
-- (4, 'Phil', 'sda1', 0, 0, 0, 'green');

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
