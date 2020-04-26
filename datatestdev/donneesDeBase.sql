-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 26 avr. 2020 à 07:13
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `c118`
--
delete from note;
ALTER TABLE note AUTO_INCREMENT=1;

delete from telephone;
ALTER TABLE telephone AUTO_INCREMENT=1;

delete from email;
ALTER TABLE email AUTO_INCREMENT=1;

delete from adresse;
ALTER TABLE adresse AUTO_INCREMENT=1;

delete from ligne_commande;
ALTER TABLE ligne_commande AUTO_INCREMENT=1;

delete from produit;
ALTER TABLE produit AUTO_INCREMENT=1;

delete from commande;
ALTER TABLE commande AUTO_INCREMENT=1;

delete from client;
ALTER TABLE client AUTO_INCREMENT=1;

delete from taxe;
ALTER TABLE taxe AUTO_INCREMENT=1;

delete from categorie_produit;
ALTER TABLE categorie_produit AUTO_INCREMENT=1;

delete from marque;
ALTER TABLE marque AUTO_INCREMENT=1;

delete from fournisseur;
ALTER TABLE fournisseur AUTO_INCREMENT=1;

delete from blog;
ALTER TABLE blog AUTO_INCREMENT=1;

delete from roles;
ALTER TABLE roles AUTO_INCREMENT=1;

delete from user;
ALTER TABLE user AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `posted_at`, `position`, `title`, `headline`, `content`, `type`, `link`, `image`) VALUES
(1, '2018-10-19 06:25:06', 13, 'Le magasin Cartouche 118', '<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>', '<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>\r\n\r\n<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>\r\n\r\n<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>', 'clients', NULL, '20181019-221040-blog.jpg'),
(4, '2018-10-19 14:42:20', 3, 'Encore un article', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure</p>', '<p>Le&nbsp;<strong>Lorem Ipsum</strong>&nbsp;est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.&nbsp;</p>', 'clients', NULL, '20181021-191056-blog.jpg'),
(5, '2018-10-19 14:43:18', 2, 'lorem ipsum', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', '<p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et emp&ecirc;che de se concentrer sur la mise en page elle-m&ecirc;me. L&#39;avantage du Lorem Ipsum sur un texte g&eacute;n&eacute;rique comme &#39;Du texte. Du texte. Du texte.&#39; est qu&#39;il poss&egrave;de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du fran&ccedil;ais standard.</p>', 'produits', NULL, '20181021-191059-blog.jpg'),
(6, '2018-10-19 14:45:55', 11, 'Joli!', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', '<p>Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute;.</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', 'clients', NULL, '20181021-181031-blog.jpg'),
(8, '2018-10-19 17:15:50', 7, 'Traduction de H. Rackham (1914)', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>', '<p>omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. <span style=\"color:#e74c3c\">Itaque earum rerum hic tenetur a sapiente delectus</span></p>\r\n\r\n<ol>\r\n	<li>ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>poribus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eve</li>\r\n</ol>', 'produits', NULL, '20181019-201044-blog.jpg'),
(11, '2018-10-20 09:20:43', 5, 'Voici le texte lorem ipsum généré de 5 paragraphes.', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi,</p>', '<p>Mox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam.</p>', 'clients', NULL, '20181021-181006-blog.jpg'),
(12, '2018-10-20 09:21:41', 12, 'r voluit, promptior laudato consilio conse', '<p>id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', '<p>Mox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius</p>', 'clients', NULL, '20181021-181015-blog.jpg'),
(13, '2018-10-20 09:22:59', 9, 'Novitates autem si spem adferun', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>', '<p>Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus, quorum crebris excursibus vastabantur confines limitibus terrae Gallorum.</p>', 'produits', NULL, '20181020-091059-blog.jpg'),
(15, '2018-10-20 09:27:31', 6, 'Constantius consulatu suo septies', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', '<p>Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus,&nbsp;</p>', 'clients', NULL, '20181021-181043-blog.jpg'),
(16, '2018-10-20 11:22:23', 8, 'Essai', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>', '<p>dqsf kf lsd fsdml fsdf ksdmlf sdff sdml fsdml fsmlfsdmlfksdfksdmfksdmfksdmlksdml ml f sml fsdml fksdmfk sdfk sm</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', 'produits', 'http://www.pinterest.com', '20181021-191017-blog.jpg'),
(19, '2018-10-21 08:38:03', 14, 'Rechargez vos cartouches', NULL, '<p>Une d&eacute;marche &eacute;cologique</p>', 'carousel', NULL, '20200418-170426-blog.jpg'),
(20, '2018-10-21 08:52:39', 15, 'Rechargez vos cartouches d\'encre et vos toners a Grenoble', NULL, '<p>Et &eacute;conomisez jusqu&#39;&agrave; 50% sur le prix du neuf</p>', 'carousel', NULL, '20200418-170413-blog.jpg'),
(21, '2018-10-21 12:30:04', 20, 'Quelles sont les avantages que je peux réaliser en rechargeant mes cartouches ?', NULL, '<p>Les int&eacute;rets sont multiples, comme par exemple</p>\r\n\r\n<ul>\r\n	<li>Le prix : vous pouvez r&eacute;aliser jusqu&#39;&agrave; 50% d&eacute;conomies (exemple pour une HP 301 ou HP 302, mais il y en a bien d&#39;autres)</li>\r\n	<li>L&#39;&eacute;cologie : vous ne jetez plus vos vieux boitiers mais les r&eacute;utilisez, &eacute;vitant ainsi un usage unique de mati&egrave;res plastique.</li>\r\n</ul>', 'FAQ', NULL, NULL),
(22, '2018-10-21 13:04:56', 16, 'Est-ce que le fait d\'utiliser vos cartouches peut annuler la garantie de mon imprimante ?', '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '<p style=\"text-align:center\">L&rsquo;utilisation de cartouches recycl&eacute;es ou compatibles n&rsquo;affecte en aucun cas la garantie fabricant de votre imprimante selon la directive 93/13 CEE du Conseil du 5 avril 1993 et la loi 1995 / 1996 du 1er f&eacute;vrier 1995.</p>', 'FAQ', NULL, NULL),
(23, '2018-10-21 16:51:06', 18, 'Pour les professionels', '<p>Pour les professionnels nous garantissons</p>\r\n\r\n<ul>\r\n	<li><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Service livraison</span></li>\r\n	<li><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Conseil personnalis&eacute;</span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', '<p>..</p>', 'services', NULL, '20181021-181017-blog.jpg'),
(24, '2018-10-21 16:51:24', 17, 'Pour les particuliers', '<p>Situ&eacute;e &agrave; Grenoble,&nbsp;<strong>Cartoooche 118</strong>, est votre entreprise professionnelle sp&eacute;cialis&eacute;e depuis 15 ans dans la&nbsp;<strong>recharge de cartouches jet d&rsquo;encre</strong>. Gr&acirc;ce &agrave; notre services, vous&nbsp;<strong>faites des &eacute;conomies</strong>&nbsp;et&nbsp;<strong>contribuez &agrave; la pr&eacute;servation de l&rsquo;environnement</strong>.<span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\"> </span></p>', '<h2>Le recyclage de vos cartouches jet d&rsquo;encre en Is&egrave;re</h2>\r\n\r\n<p>Pourquoi r&eacute;utiliser ses cartouches jet d&rsquo;encre&nbsp;? A quelle qualit&eacute; de produit faut-il s&rsquo;attendre&nbsp;?</p>\r\n\r\n<p>Nous utilisons une&nbsp;<strong>m&eacute;thode facile</strong>&nbsp;et&nbsp;<strong>respectueuse de l&rsquo;environnement</strong>&nbsp;pour recycler vos cartouches jet d&rsquo;encre.</p>\r\n\r\n<p><strong>Le prix est bien plus avantageux</strong>&nbsp;que l&#39;achat neuf, et la&nbsp;<strong>qualit&eacute; d&#39;impression</strong>&nbsp;est la m&ecirc;me ! Ainsi, vous continuez sereinement l&#39;impression de vos photos de vacances, de vos documents de travail, vos recettes de cuisine&hellip;</p>\r\n\r\n<p>Nous notons plusieurs avantages pour le&nbsp;<strong>recyclage de vos cartouches jet d&rsquo;encre</strong>&nbsp;:</p>\r\n\r\n<ul>\r\n	<li>Recyclage gratuit pour nos clients</li>\r\n	<li>Produit trait&eacute; dans le respect des r&eacute;glementations en vigueur</li>\r\n	<li>Aucune cartouche ne termine &agrave; la d&eacute;charge</li>\r\n	<li>Prix jusqu&rsquo;&agrave; 50% moins cher par rapport &agrave; une cartouche neuve</li>\r\n</ul>\r\n\r\n<p>Cartoooche 118 vous garantit que la cartouche recycl&eacute;e est&nbsp;<strong>tout aussi performante</strong>&nbsp;que celle d&rsquo;origine et sa&nbsp;<strong>dur&eacute;e de vie est identique</strong>.</p>\r\n\r\n<p>Franchissez le seuil de notre magasin &agrave; Grenoble et faites le test par vous-m&ecirc;me &agrave; un&nbsp;<strong>prix comp&eacute;titif</strong>&nbsp;!</p>', 'services', NULL, '20181021-181046-blog.jpg'),
(25, '2018-10-21 16:51:46', 21, 'Nos services', '<p>Ouverts depuis 2003 &agrave; Grenoble, nous sommes sp&eacute;cialistes :</p>\r\n\r\n<ul>\r\n	<li>de la fourniture de cartouches d&#39;origine</li>\r\n	<li>de la recharge de vos cartouches vides</li>\r\n	<li>du conseil dans le&nbsp;domaines de l&#39;impression&nbsp;</li>\r\n</ul>\r\n\r\n<p>Nous garantissons la qualit&eacute; de nos produits.</p>', '<p>Ouverts depuis 2003 &agrave; Grenoble, nous sommes sp&eacute;cialistes :</p>\r\n\r\n<ul>\r\n	<li>de la recharge de cartouches d&#39;imprimante (Cartouches d&#39;origine neuve ou recharg&eacute;e, cartouche compatibles)</li>\r\n	<li>du conseil dans le&nbsp;domaines de l&#39;impression (choix d&#39;imprimantes, selection de produits)</li>\r\n</ul>\r\n\r\n<p>Nous garantissons la qualit&eacute; de nos produits. Nous&nbsp;sommes attentifs aux remqrques de nos clients</p>\r\n\r\n<p>Notre offre vous permet de faire&nbsp;des &eacute;conomies et vous permet de contribuer&nbsp;&agrave; pr&eacute;server l&#39;environnement en &eacute;vitant l&#39;usage unique qui est normalement r&eacute;serv&eacute; &agrave; vos cartouches d&#39;encre</p>\r\n\r\n<p>Ne jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser;</p>\r\n\r\n<p>Notre experience et notre savoir-faire sont &agrave; votre disposition.</p>', 'services', NULL, '20181021-181059-blog.jpg'),
(26, '2018-12-25 16:41:53', 19, 'RECHARGEZ VOS CARTOUCHES D’ENCRE ET VOS TONERS À GRENOBLE POUR ÉCONOMISER JUSQU’À 50% ET PLUS', '<p>&nbsp;fdskfsdlf sdm sdmlf ksdmlf ksdmlfk sdml sdmlf ksdmlf ksdmlfk sdm ksdml sdml fsdmlfk smf s</p>', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'carousel', NULL, '20200418-170446-blog.jpg'),
(27, '2020-04-18 18:05:36', 23, 'Recharge', '<p><span style=\"font-size:26px\">Rechargez vos cartouches laser</span></p>', '<p><span style=\"font-size:36px\">Rechargez vos cartouches laser</span></p>', 'carousel', NULL, '20200418-180436-blog.jpg'),
(28, '2020-04-18 18:31:31', 22, 'Quelles sont les marques que vous rechargez ?', NULL, '<p>Pour faire simple, nous rechargeons toutes les marques et tous les mod&egrave;les, et nous pouvons vous procurer aussi toutes les cartouches d&#39;origine</p>', 'FAQ', NULL, NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_name`, `nom`, `prenom`, `mail`, `password`) VALUES
(1, 'obussier_adm', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i'),
(2, 'obussier_usr', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i'),
(3, 'obussier_pub', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i');

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `adherent_id`, `role`) VALUES
(1, 1, 'ROLE_USER'),
(2, 1, 'ROLE_ADMIN'),
(3, 2, 'ROLE_USER'),
(5, 3, 'ROLE_USER'),
(6, 3, 'ROLE_PUB');
