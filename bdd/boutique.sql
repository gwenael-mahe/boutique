-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 mars 2020 à 09:54
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id`, `id_user`, `prix`, `date`) VALUES
(1, 3, 54, '2020-03-17'),
(2, 3, 54, '2020-03-17'),
(3, 3, 54, '2020-03-17');

-- --------------------------------------------------------

--
-- Structure de la table `achat_product`
--

DROP TABLE IF EXISTS `achat_product`;
CREATE TABLE IF NOT EXISTS `achat_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_achat` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achat_product`
--

INSERT INTO `achat_product` (`id`, `id_achat`, `id_produit`, `quantite`) VALUES
(1, 1, 19, 1),
(2, 1, 19, 1),
(3, 2, 19, 1),
(4, 2, 19, 1),
(5, 3, 19, 1),
(6, 3, 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `notation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_user`, `id_produit`, `id_message`, `notation`) VALUES
(2, 2, 23, 0, 3),
(3, 2, 23, 0, 3),
(4, 2, 23, 3, 1),
(5, 2, 23, 0, 1),
(6, 2, 23, 0, 1),
(7, 2, 23, 0, 1),
(8, 2, 23, 0, 1),
(9, 2, 23, 0, 1),
(10, 2, 23, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `basicpage`
--

DROP TABLE IF EXISTS `basicpage`;
CREATE TABLE IF NOT EXISTS `basicpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_page` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `basicpage`
--

INSERT INTO `basicpage` (`id`, `titre`, `description`, `id_page`, `img`) VALUES
(1, 'Bombyx', '   Bonjour ici nous vous proposons une sÃ©lection de jeux en tout genre pour pouvoir vous amusez en famille ou avec des amis', 1, 'img/logo/1.png');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) DEFAULT 'img/cat/default.png',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `img`) VALUES
(14, 'Jeux de carte', '    Ici vous trouverez des jeux de cartes !  ', 'img/cat/14.png'),
(15, 'Jeux de stratÃ©gie', '          Ici vous trouverez des jeux de stratÃ©gie!   ', 'img/cat/15.png'),
(16, 'Jeux de rÃ´le', '        Ici vous trouverez des jeux de rÃ´le!   ', 'img/cat/16.png'),
(13, 'Jeux de plateau ', '        Ici vous trouverez des jeux de plateau!   ', 'img/cat/13.png');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_user`, `message`, `date`, `id_product`) VALUES
(3, 2, 'bonjour', '2020-03-17 10:54:39', 23),
(4, 2, 'catan c\'est vraiment bien', '2020-03-17 10:59:33', 23);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_product`, `id_user`, `quantite`) VALUES
(6, 19, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `descriptionup` text NOT NULL,
  `descriptiondown` text NOT NULL,
  `img` varchar(255) DEFAULT 'img/product/default.png',
  `id_souscat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `nom`, `prix`, `descriptionup`, `descriptiondown`, `img`, `id_souscat`) VALUES
(20, 'Cerbere', 35, '  Votre derniÃ¨re aventure vous a menÃ© lÃ  oÃ¹ vous nâ€™auriez jamais dÃ» aller : dans les enfers ! Vous devez fuir et rejoindre une barque qui vous ramÃ¨nera en sÃ©curitÃ©. Mais CerbÃ¨re, le molosse infernal, est Ã  vos trousses et compte bien vous garder aÌ€ jamais. ', '  Tentez de vous Ã©chapper des Enfers, avec CerbÃ¨re Ã  vos trousses ! CoopÃ©rez pour progresser vers la barque qui vous fera traverser le Styx. Mais attention, les places sont limitÃ©esâ€¦ Combien de temps coopÃ©rerez-vous pour Ã©chapper Ã  CerbÃ¨re, et quand dÃ©ciderez-vous de trahir le groupe pour vous assurer une place dans la barque ?\r\n\r\nÃ€ votre tour, choisissez entre : vous avantager un peu au dÃ©triment du groupe, ou bien avantager le groupe mais en restant sur place. Si tout le monde privilÃ©gie lâ€™entraide, il devient plus facile dâ€™Ã©chapper Ã  CerbÃ¨re. Mais souvent, il est trop tentant dâ€™avancer seul et de laisser ses compagnons en pÃ¢ture Ã  la bÃªteâ€¦ Vous commencez la partie en coopÃ©rant, mais les places pour la victoire sont limitÃ©es. Et si CerbÃ¨re vous rattrape, il vous propose de gagner la partie en faisant Ã©chouer vos anciens compagnons ! Allez-vous faire confiance aux autre joueurs, mÃªme dans les pires moments, ou serez-vous le premier Ã  trahir pour sauver votre peau ? Â« CerbÃ¨re Â» propose des retournements de situations Ã©piques, met votre confiance Ã  rude Ã©preuve, et vous fait vivre des aventures marquantes. Vous nâ€™avez pas fini de rappeler Ã  vos compagnons dâ€™infortune quelle crasse ils vous ont faite la derniÃ¨re fois, ou avec quel acte hÃ©roÃ¯que vous avez sauvÃ© le groupe ! ', 'img/product/20.jpg', 9),
(19, 'Colt Express', 27, ' Incarnez un Desperado qui attaque un train de voyageurs dans ce jeu qui se dÃ©roule au Far West ! Pas de pitiÃ©, il ne peut y avoir qu\'un seul As de la gÃ¢chette ! ', ' La partie est lancÃ©e, le jeu promet d\'Ãªtre rude. Entre les wagons, sur le toit, les balles fusent ; les hors-la-loi sont blessÃ©s. Le Marshall patrouille dans le train, contre-carre les plans des bandits et tente de faire rÃ©gner l\'Ordre et la Loi. Il est un danger supplÃ©mentaire. Un danger qui peut vous envoyer en prison ou entre quatre planches.\r\n\r\nAfin de sortir victorieux de cette folle entreprise, gÃ©rez au mieux vos dÃ©placements, montez et descendez du train, ramassez des butins (mallette, bourses, joyaux), donnez des coups de poing, dÃ©placez le shÃ©rif et surtout tirez. Votre arme sera votre plus fidÃ¨le amie.\r\n\r\nQui obtiendra le titre d\'As de la gÃ¢chette (et la prime qui l\'accompagne) ? Qui aura le plus gros butin ? Chacun a sa propre personnalitÃ©, mais au bout du compte, tous n\'ont qu\'un seul but : rÃ©unir le plus gros magot pour lui-mÃªme en dÃ©troussant les passagers avant que le train n\'arrive en gare.       ', 'img/product/19.jpg', 10),
(21, 'UNO', 12, ' Facile Ã  apprendre, vous serez vite gagnÃ© par la frÃ©nÃ©sie dâ€™UNO, le plus cÃ©lÃ¨bre des jeux de cartes familiaux.Cartes De Jeu\r\n ', '  no idea ', 'img/product/21.jpg', 11),
(22, 'DOS', 12, ' Un nouveau jeu de cartes inspirÃ© du cÃ©lÃ¨bre jeu UNO. Jouez avec deux cartes, associez les couleurs, les cartes et additionnez les points ! La stratÃ©gie est importante pour se dÃ©fausser de toutes ses cartes !', ' no idea', 'img/product/22.jpg', 11),
(23, 'Catan DUEL', 23, 'Catan Duel (ex Les Princes de Catane) est un jeu de cartes et de stratÃ©gie pour 2 joueurs qui se situe dans l\'univers de Catane et s\'inspire du jeu plateau du mÃªme nom.', ' Cette adaptation de Catan en jeu de cartes se limite Ã  2 joueurs. Ici il nâ€™est plus question de plateau, mais de cartes que lâ€™on Ã©tale devant soi, constituant ainsi sa colonie que lâ€™on dÃ©veloppe. On retrouve dans ce jeu les mÃ©canismes de collecte des ressources, les Ã©changes commerciaux et les Points de Victoires Ã  accumuler. Cependant, la configuration est diffÃ©rente. Les joueurs peuvent dÃ©sormais construire de nombreux bÃ¢timents diffÃ©rents (reprÃ©sentÃ©s sous forme de cartes). Les colonies sont exposÃ©es entre les 2 joueurs, chacun la dÃ©veloppant face Ã  lui. On ne retrouve donc pas lâ€™interaction de la version plateau et les actions possibles contre lâ€™adversaire sont de nature diffÃ©rente.\r\n\r\nDans le jeu Catan Duel, chaque partie est diffÃ©rente, puisque les situations de dÃ©part sont choisies alÃ©atoirement, il y a donc d\'innombrables possibilitÃ©s de jouer! Dans cette nouvelle version, vous trouverez aussi un nouveau concept : 3 paquets de cartes thÃ©matisÃ©s, Ã  complexitÃ© variable, qui vous permettront de jouer le jeu diffÃ©remment. Il s\'agit d\'un jeu de pose et de combinaison, assez calculatoire. Il permet de nouvelles tactiques et propose une approche diffÃ©rente de lâ€™univers de Â« Catane Â».\r\n\r\nLes Princes de Catane est la rÃ©Ã©dition 2012 de l\'ancien Catane - Le Jeu de Cartes. Cette nouvelle version contient 180 cartes au lieu de 120 mais ce n\'est pas tout.\r\n\r\nPlongez au cÅ“ur de Catan. Vous commencez avec une petite principautÃ© de quelques cartes. Au hasard des dÃ©s, les terrains vous livrent des ressources, que vous devez utiliser judicieusement pour placer de nouvelles cartes. De la stratÃ©gie et un soupÃ§on de chance feront la diffÃ©rence entre victoire et dÃ©faite !', 'img/product/23.jpg', 12),
(24, 'Risk', 40, ' Avec le jeu de sociÃ©tÃ© Risk dâ€™Hasbro, votre enfant sâ€™amuse Ã  conquÃ©rir le monde ! En jouant Ã  Risk, il accroÃ®t sa logique et dÃ©veloppe des stratÃ©gies pour gagner la partie.', ' no idea', 'img/product/24.jpeg', 10),
(25, 'Dixit', 30, '  Dixit est un jeu d\'ambiance intuitif et poÃ©tique. Les joueurs doivent dÃ©couvrir Ã  quelle carte illustrÃ©e correspond la phrase prononcÃ©e par le \"conteur\" de la partie. Et cela, sans tomber dans les piÃ¨ges tendus par les autres joueurs. Dixit suscite l\'imagination des enfants, leur sens de l\'observation et les encourage Ã  s\'exprimer. Un jeu de sociÃ©tÃ© original, esthÃ©tique et familial. ', '  Intelligent : user de finesse et d\'intuition\r\nMalin : Ã©viter les piÃ¨ges tendus par les autres joueurs\r\nEducatif : dÃ©veloppe imagination, observation et langage ', 'img/product/25.jpg', 13),
(26, 'Initiation au jeux de rÃ´le', 15, '  Le jeu de rÃ´le, enfin accessible Ã  tous !\r\nVous voilÃ  dans un village oÃ¹ rÃ¨gne un mystÃ¨re bien Ã©trange ! Ogre et gobelins semblent au service d\'une certaine \" Dormeuse \". Votre Ã©quipe d\'aventuriers va devoir s\'entraider et relever les dÃ©fis pour espÃ©rer percer les secrets de ce village ! ', '  Cette boÃ®te d\'initiation au jeu de rÃ´le vous donne tout, clÃ© en main : un livre de 96 pages avec les cinq scÃ©narios, les conseils pour le maÃ®tre du jeu, les rÃ¨gles du jeu de rÃ´le pour dÃ©buter. 50 cartes pour animer la partie, 5 cartes personnages et un paravent. ', 'img/product/26.jpg', 14),
(31, 'A Game of Thrones : The Card Game - Things we do for Love', 19, ' Cette extension contient 88 cartes qui s\'inspirent de la riche histoire du jeu en tant que CCG et LCG, apportant des cartes puissantes et emblÃ©matiques des Ã©poques prÃ©cÃ©dentes de la vie du jeu jusqu\'Ã  la deuxiÃ¨me Ã©dition du LG A Game of Thrones.', ' Vous trouverez dans ce pack :\r\n\r\n3 exemplaires de 2 cartes diffÃ©rentes de chacune des 8 factions\r\n3 exemplaires de 10 cartes neutres diffÃ©rentes\r\n1 exemplaire de 4 cartes d\'agenda diffÃ©rentes\r\n1 exemplaire de 6 cartes d\'intrigues diffÃ©rentes ', 'img/product/31.jpg', 11),
(32, 'Terraforming Mars', 50, ' L\'Ã¨re de la domestication de Mars a commencÃ©. Dans Terraforming Mars, de puissantes corporations travaillent pour rendre la PlanÃ¨te Rouge habitable. La tempÃ©rature, l\'oxygÃ¨ne et les ocÃ©ans sont les trois axes de dÃ©veloppement principaux. Mais pour triompher, il faudra aussi construire des infrastructures pour les gÃ©nÃ©rations futures.', ' Dans les annÃ©es 2400, Ã  une Ã©poque future mais pas si lointaine, lâ€™espÃ¨ce humaine commence la domestication de la PlanÃ¨te Rouge. Câ€™est le commencement de la terraformation de Mars. Le Gouvernement Mondial de la Terre sponsorise de puissantes corporations, qui sont envoyÃ©es sur Mars pour initier de grands projets dâ€™envergure. Vous Ãªtes lâ€™une dâ€™entre elles. Afin de rendre Mars habitable, ces compagnies Å“uvrent pour remplir 3 grandes missions principales :  \r\n\r\nAugmenter la tempÃ©rature\r\nAugmenter le niveau d\'oxygÃ¨ne \r\nAugmenter les Ã©tendues ocÃ©aniques', 'img/product/32.jpg', 12),
(33, '7 Wonders', 39, ' Dans 7 Wonders, prenez la tÃªte de l\'une des sept grandes citÃ©s du monde antique et laissez votre empreinte dans l\'histoire des civilisations.\r\n\r\n', ' 7 Plateaux Merveille\r\n7 Cartes Merveille\r\n49 Cartes Age I\r\n49 Cartes Age II\r\n50 Cartes Age III\r\n46 Jetons Conflit\r\n46 PiÃ¨ces de valeur 1\r\n24 PiÃ¨ces de valeur 3\r\n1 Carnet de score\r\n1 Livret de rÃ¨gles\r\n2 Cartes \"2 Joueurs\"', 'img/product/33.jpg', 14);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) DEFAULT 'img/sous_cat/default.png',
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `nom`, `description`, `img`, `id_categorie`) VALUES
(14, 'Initiation', '     ', 'img/sous_cat/14.jpg', 16),
(13, 'StratÃ©gie', '   ', 'img/sous_cat/13.jpg', 14),
(12, 'Gestion et dÃ©veloppement', '     ', 'img/sous_cat/12.jpg', 15),
(11, 'Classique', '     ', 'img/sous_cat/11.jpg', 14),
(10, '2-6 joueurs', '   ', 'img/sous_cat/10.jpg', 13),
(9, '3-7 joueurs', '   ', 'img/sous_cat/9.jpg', 13);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`) VALUES
(3, 'test', '$2y$12$D8QwK.uxidwE5Ka1F8oKs.EgHhvyElJ9XVJ3uq2m8ejmdCi9hDcRK', 'test@test'),
(2, 'admin', '$2y$12$y6aiswbjvQtorfJAi/3c5uyI3lcmDv3Jt1F/M2CB9GkcmkQ8XUK/2', 'admin@admin.fr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
