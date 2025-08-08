-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 août 2025 à 15:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Disponible','Indisponible') NOT NULL DEFAULT 'Disponible',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `ownerId`, `title`, `author`, `imageUrl`, `description`, `status`, `created_at`) VALUES
(26, 10, 'L&#039;Odyssée', 'Homère', '/TomTroc/uploads/book_6845c76f7af285.41675474.jpg', 'Ulysse, héros grec de la guerre de Troie, celui dont la ruse a permis à mettre fin à un siège de 10 ans, voudrait regagner son île d&#039;Ithaque, où l&#039;attendent sa femme Pénélope et son fils Télémaque. Mais les dieux ne l&#039;entendent pas de cette ainsi. Sur le chemin du retour, il doit affronter le Cyclope, la magicienne Circé, les Sirènes au chant mortel, les monstres Charybde et Scylla, et bien d&#039;autres encore.\r\n\r\nAidé de la déesse Athéna, Ulysse parviendra-t-il à retrouver son palais et à se débarrasser des prétendants qui convoitent sa femme et ses biens?', 'Disponible', '2025-06-08 19:25:03'),
(27, 10, 'Othello', 'William Shakespeare', '/TomTroc/uploads/book_6845c7e084d680.97540099.jpg', 'Héros à l&#039;esprit guerrier jusque dans son discours amoureux, séducteur, maniant à la perfection le paradoxe et jouant à merveille sur l&#039;ambiguïté des mots, Othello, Maure de Venise, se sert du langage comme d&#039;une épée. Sa gloire suscite diverses réactions : Roderigo méprise &quot;l&#039;homme aux grosses lèvres&quot;, Désdémone est séduite par le récit de ses exploits en terres lointaines, qui fourmille d&#039;évocations exotiques. Iago, lui, hait Othello. Que cette haine soit gratuite ou qu&#039;elle soit le résultat d&#039;une lucidité pragmatique, elle pousse Iago à tout détruire sur son passage. Metteur en scène machiavélique, manipulateur de l&#039;ombre, il bat Othello sur son propre terrain, puisque c&#039;est par le discours qu&#039;il l&#039;entraîne vers le meurtre. le Maure, jaloux, boira les mots de son ennemi comme un poison pervers. Révélatrice des préoccupations d&#039;une époque qui voit les limites du monde connu reculer de plus en plus, Othello est également une tragédie domestique offrant de merveilleuses scènes d&#039;intimité, telle celle de la toilette de Desdémone lorsqu&#039;elle entonne le chant du saule.', 'Disponible', '2025-06-08 19:26:56'),
(28, 10, 'Madame Bovary', 'Gustave Flaubert', '/TomTroc/uploads/book_6845c81546b205.81500152.jpg', 'C&#039;est l&#039;histoire d&#039;une femme mal mariée, de son médiocre époux, de ses amants égoïstes et vains, de ses rêves, de ses chimères, de sa mort. C&#039;est l&#039;histoire d&#039;une province étroite, dévote et bourgeoise. C&#039;est, aussi, l&#039;histoire du roman français. Rien, dans ce tableau, n&#039;avait de quoi choquer la société du Second Empire. Mais, inexorable comme une tragédie, flamboyant comme un drame, mordant comme une comédie, le livre s&#039;était donné une arme redoutable : le style. Pour ce vrai crime, Flaubert se retrouva en correctionnelle.\r\n\r\nAucun roman n&#039;est innocent : celui-là moins qu&#039;un autre. Lire Madame Bovary, au XXIe siècle, c&#039;est affronter le scandale que représente une œuvre aussi sincère qu&#039;impérieuse. Dans chacune de ses phrases, Flaubert a versé une dose de cet arsenic dont Emma Bovary s&#039;empoisonne : c&#039;est un livre offensif, corrosif, dont l&#039;ironie outrage toutes nos valeurs, et la littérature même, qui ne s&#039;en est jamais vraiment remise.', 'Disponible', '2025-06-08 19:27:49'),
(29, 11, 'Hamlet', 'William Shakespeare', '/TomTroc/uploads/book_6845c897386936.33361717.jpg', 'Hamlet est le fils du Roi de Danemark, remplacé sur le trône et en tant qu’époux de la reine Gertrude par son frère aîné, Claudius. Le spectre du souverain défunt apparaît une nuit à Hamlet pour lui révéler qu’il a été empoisonné par Claudius, et le pousser à le venger.\r\n\r\nHamlet feint la folie afin de démasquer son oncle usurpateur. On met cette folie passagère sur le compte de l’amour qu’il porterait à Ophélie, fille de Polonius, conseiller du roi.\r\n\r\nHamlet ourdit une nouvelle ruse et fait jouer par une troupe de théâtre la reconstitution des véritables circonstances de la mort de son père. Claudius, en interrompant les comédiens au beau milieu de la représentation, conforte Hamlet dans sa certitude. Il se résout à assassiner son oncle, mais hésite. Il décide de tout révéler à sa mère, et croyant que Claudius se dissimule derrière un rideau, y plante son épée, tuant non pas le régicide, mais son conseiller, Polonius. Claudius contraint Hamlet à l’exil en Angleterre. Ophélie folle de douleur se suicide par noyade, et Laërte, son frères, jure de venger sa sœur et son père en tuant Hamlet.\r\n\r\nHamlet ne tard pas à faire savoir qu’il retourne au Danemark, son bateau ayant été attaqué par des pirates. Claudius saisit l’opportunité de se débarrasser du dangereux héritier légitime, et fait en sorte que celui-ci affronte Laërte en duel. Il prend la double précaution d’enduire de poison la lame de ce dernier, et d’en verser également dans la coupe de vin de Hamlet.\r\n\r\nDurant le combat, Gertrude boit à cette coupe et décède. Laërte quant à lui parvient à blesser Hamlet de sa lame empoisonnée, mais se blesse lui-même avec l’arme mortelle, et trépasse. Hamlet parvient à assassiner Claudius avant de succomber lui-même à sa blessure empoisonnée.\r\n\r\nFortinbras, seigneur norvégien qui s’apprêtait à déclarer la guerre au Danemark, arrive à Elseneur où l’histoire de Hamlet lui est contée. Il ordonne d’inhumer celui qui aurait été son ennemi avec tous les honneurs.', 'Disponible', '2025-06-08 19:29:59'),
(30, 11, 'Harry Potter à l&#039;école des sorciers', 'J.K. Rowling', '/TomTroc/uploads/books/book_30_6845cbc89c54a4.02849210.jpg', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l&#039;emmener à Poudlard, la célèbre école de sorcellerie où une place l&#039;attend depuis toujours. Voler sur des balais, jeter des sorts, combattre les Trolls : Harry Potter se révèle un sorcier vraiment doué. Mais quel mystère entoure donc sa naissance et qui est l&#039;effroyable V..., le mage dont personne n&#039;ose prononcer le nom ?', 'Disponible', '2025-06-08 19:42:27'),
(31, 13, 'Moby Dick', 'Herman Melville', '/TomTroc/uploads/book_68930834b79520.56541897.jpg', 'Ishmaël s&#039;embarque sur Le Péquod, un baleinier qui va sillonner les océans pendant trois ans. Le bateau est dirigé par le mystérieux capitaine Achab qui martèle le sol de sa jambe de bois. Il n&#039;a de cesse de retrouver Moby Dick, la monstrueuse baleine blanche qui l&#039;a amputé quelques années auparavant. Cette obsession, au détriment de l&#039;équipage, tourne à l&#039;affrontement entre le Bien et le Mal.', 'Disponible', '2025-08-06 09:45:56'),
(32, 13, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', '/TomTroc/uploads/book_68930a04505a41.17919497.jpg', 'La vengeance est un plat qui se mange froid, mais certains l&#039;assaisonnent avec un raffinement tel qu&#039;ils l&#039;élèvent au rang d&#039;une gastronomie. Edmond Dantès, le héros du Comte de Monte-Cristo, est de ceux-là. Jeune marin, âme candide et fils modèle, il semble promis au bonheur et à une brillante carrière dans la marine, quand soudain tout s&#039;écroule. Du jour au lendemain, il se voit précipité dans un abîme de détresse et de ténèbres. Arrêté comme comploteur, il est enfermé au château d&#039;If, la prison de Marseille, pour y croupir jusqu&#039;à la fin de ses jours. Sa faute ? S&#039;être attiré la jalousie de deux rivaux. Sa malchance ? Avoir affaire à un magistrat arriviste et malhonnête. Mais, au bout de quatorze ans, Dantès s&#039;évade et reparaît, après complète métamorphose en richissime aristocrate, pour châtier les trois misérables responsables de ses malheurs...', 'Disponible', '2025-08-06 09:53:40'),
(33, 13, 'La Ligne verte', 'Stephen King', '/TomTroc/uploads/book_68930a3c776324.90535986.jpg', '« Ca s&#039;est passé en 1932, quand le pénitencier de l&#039;Etat se trouvait encore à Cold Mountain. Naturellement, la chaise électrique était là. Ils en blaguaient, de la chaise, les détenus, mais comme on blague des chaises qui font peur et auxquelles on ne peut échapper. Ils la surnommaient Miss Cent Mille Volts, la Veuve Courant, la Rôtisseuse. »\r\n\r\nDans le bloc des condamnés à mort, au bout d&#039;un long couloir que les prisonniers appellent la ligne verte, la chaise électrique attend John Caffey. Le meurtrier des petites jumelles Detterick, jadis découvert en larmes devant leurs cadavres ensanglantés.\r\n\r\nPaul Edgecombe, le gardien-chef, l&#039;accueille comme les autres, sans état d&#039;âme. Pourtant, quelque chose se trame... L&#039;air est étouffant, la tension à son comble. Un rouage va lâcher, mais pourquoi ? Les provocations sadiques d&#039;un maton dérangé, la présence d&#039;une souris un peu trop curieuse, l&#039;arrivée d&#039;un autre condamné ?\r\n\r\nAux frontières du roman noir et du fantastique, ce récit est avant tout une brillante réflexion sur l&#039;exécution capitale.', 'Disponible', '2025-08-06 09:54:36'),
(34, 13, 'Les Voyages de Gulliver', 'Jonathan Swift', '/TomTroc/uploads/book_68930a6991bbb2.72192616.jpg', 'Lemuel Gulliver, chirurgien de marine, entame quatre grands voyages : à Lilliput, où il découvre des habitants de 15 centimètres de haut ; à Brobdingnag peuplé de géants ; à Laputa et son archipel peuplé de philosophes délirants ; enfin au pays de Houyhnhnms où des chevaux intelligents sont enfin parvenus au sommet de la sagesse, ils sont les maîtres des Yahoos, animaux d’aspect répugnant au comportement misérable, qui se révèlent, au grand désespoir de Gulliver, être des humains.\r\n\r\nAvec ce livre publié en 1726, Jonathan Swift écrit ici la plus grande satire en langue anglaise. Derrière ces personnages de contes de fée ou de sciences-fiction, ce sont tous les excès de la société anglaise qui sont passés au crible. Une satire qui reste toujours d’actualité.', 'Disponible', '2025-08-06 09:55:21');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1Id` int(11) NOT NULL,
  `user2Id` int(11) NOT NULL,
  `startDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `user1Id`, `user2Id`, `startDate`) VALUES
(7, 11, 10, '2025-06-08 19:31:39'),
(8, 10, 13, '2025-08-08 15:47:23');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversationId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `recipientId` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `isRead` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversationId`, `senderId`, `recipientId`, `content`, `timestamp`, `isRead`) VALUES
(18, 7, 11, 10, 'Bonjour je serais intéressée par Othello, est-il toujours disponible ?', '2025-06-08 19:32:18', 0),
(19, 7, 10, 11, 'Bonjour, oui il est toujours dispo. J&#039;ai d&#039;autres livres de Shakespeare également si vous le souhaitez !', '2025-06-08 19:36:12', 0),
(20, 8, 10, 13, 'Bonjour, avez vous d&#039;autres livres à échanger ?', '2025-08-08 15:47:47', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar_url`, `bio`, `created_at`) VALUES
(10, 'LeGrandLecteur', 'user1@user.com', '$2y$10$A96Hs9ycy5wZcuQ.Z6EPi.sN/R2URyRBZgRYDzlqmotparP2THNCq', '/TomTroc/uploads/avatars/avatar_10_6845ca568350d.jpg', '', '2025-06-08 19:12:17'),
(11, 'LilaLecture', 'user2@user.com', '$2y$10$N4UJtb3ezRxAvcgiekaoee.NNRvRwVGSKy6LVXZPZkXdMMrExvWg2', '/TomTroc/uploads/avatars/avatar_11_6845c9ad1e4e5.jpg', 'Passionnée de littérature contemporaine, j’aime dénicher des pépites rares et échanger avec d’autres lecteurs. Grande adepte de romans épistolaires et de poésie contemporaine, je suis toujours en quête de nouvelles découvertes littéraires.', '2025-06-08 19:28:42'),
(13, 'BoomBook', 'user3@user.com', '$2y$10$8f97RND9JsXxm4f52M4/uuB3X2QNmUjmmilvHkRPZqxEg2y.Hw7H.', 'https://picsum.photos/200/300', '', '2025-08-06 09:41:40');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1Id` (`user1Id`),
  ADD KEY `user2Id` (`user2Id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversationId` (`conversationId`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `recipientId` (`recipientId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1Id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2Id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`recipientId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
