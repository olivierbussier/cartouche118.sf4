-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 27 oct. 2018 à 06:42
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `c118`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headline` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `posted_at`, `title`, `content`, `link`, `image`, `headline`, `type`, `position`) VALUES
(1, '2018-10-19 06:25:06', 'Le magasin Cartouche 118', '<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>\r\n\r\n<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>\r\n\r\n<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>', NULL, '20181019-221040-blog.jpg', '<p>Sp&eacute;cialiste de la recharge de cartouches d&#39;imprimante</p>\r\n\r\n<p>Faites des &eacute;conomies et contribuez &agrave; pr&eacute;server l&#39;environnement<br />\r\nNe jetez plus vos cartouches, venez les faire recharger, jet d&#39;encre ou laser.</p>', 'portfolio', 13),
(4, '2018-10-19 14:42:20', 'Encore un article', '<p>Le&nbsp;<strong>Lorem Ipsum</strong>&nbsp;est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.&nbsp;</p>', NULL, '20181021-191056-blog.jpg', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure</p>', 'portfolio', 3),
(5, '2018-10-19 14:43:18', 'lorem ipsum', '<p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et emp&ecirc;che de se concentrer sur la mise en page elle-m&ecirc;me. L&#39;avantage du Lorem Ipsum sur un texte g&eacute;n&eacute;rique comme &#39;Du texte. Du texte. Du texte.&#39; est qu&#39;il poss&egrave;de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du fran&ccedil;ais standard.</p>', NULL, '20181021-191059-blog.jpg', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', 'feature', 2),
(6, '2018-10-19 14:45:55', 'Joli!', '<p>Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute;.</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', NULL, '20181021-181031-blog.jpg', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', 'portfolio', 11),
(8, '2018-10-19 17:15:50', 'Traduction de H. Rackham (1914)', '<p>omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. <span style=\"color:#e74c3c\">Itaque earum rerum hic tenetur a sapiente delectus</span></p>\r\n\r\n<ol>\r\n	<li>ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>poribus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eve</li>\r\n</ol>', NULL, '20181019-201044-blog.jpg', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>', 'feature', 7),
(10, '2018-10-20 09:14:13', 'Eius populus ab incunabulis primis', '<p>Equitis Romani autem esse filium criminis loco poni ab accusatoribus neque his iudicantibus oportuit neque defendentibus nobis.Nam quod de pietate dixistis, est quidem ista nostra existimatio, sed iudicium certe parentis; quid nos opinemur, audietis ex iuratis; quid parentes sentiant, lacrimae matris incredibilisque maeror, squalor patris et haec praesens maestitia, quam cernitis, luctusque declarat.Equitis Romani autem esse filium criminis loco poni ab accusatoribus neque his iudicantibus oportuit neque defendentibus nobis.Nam quod de pietate dixistis, est quidem ista nostra existimatio, sed iudicium certe parentis;</p>', NULL, '20181021-081006-blog.jpg', NULL, 'carousel', 10),
(11, '2018-10-20 09:20:43', 'Voici le texte lorem ipsum généré de 5 paragraphes.', '<p>Mox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam.</p>', NULL, '20181021-181006-blog.jpg', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi,</p>', 'portfolio', 5),
(12, '2018-10-20 09:21:41', 'r voluit, promptior laudato consilio conse', '<p>Mox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius</p>', NULL, '20181021-181015-blog.jpg', '<p>id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', 'portfolio', 12),
(13, '2018-10-20 09:22:59', 'Novitates autem si spem adferun', '<p>Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus, quorum crebris excursibus vastabantur confines limitibus terrae Gallorum.</p>', NULL, '20181020-091059-blog.jpg', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>\r\n\r\n<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>', 'feature', 9),
(14, '2018-10-20 09:23:30', 'moturus si spem adferun', '<p>Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus, quorum crebris excursibus vastabantur confines limitibus terrae Gallorum.Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus, quorum crebris excursibus vastabantur confines limitibus terrae Gallorum.</p>', NULL, '20181021-081051-blog.jpg', NULL, 'carousel', 4),
(15, '2018-10-20 09:27:31', 'Constantius consulatu suo septies', '<p>Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus,&nbsp;</p>', NULL, '20181021-181043-blog.jpg', '<p>but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure</p>', 'portfolio', 6),
(16, '2018-10-20 11:22:23', 'Essai', '<p>dqsf kf lsd fsdml fsdf ksdmlf sdff sdml fsdml fsmlfsdmlfksdfksdmfksdmfksdmlksdml ml f sml fsdml fksdmfk sdfk sm</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>', 'http://www.pinterest.com', '20181021-191017-blog.jpg', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>', 'feature', 8),
(19, '2018-10-21 08:38:03', 'Rechargez vos cartouches', '<p>Une d&eacute;marche &eacute;cologique</p>', NULL, '20181021-081003-blog.jpg', NULL, 'carousel', 14),
(20, '2018-10-21 08:52:39', 'Rechargez vos cartouches d\'encre et vos toners a Grenoble', '<p>Et &eacute;conomisez jusqu&#39;&agrave; 50% sur le prix du neuf</p>', NULL, '20181021-171009-blog.jpg', NULL, 'carousel', 15),
(21, '2018-10-21 12:30:04', 'Comment venir nous voir', '<p>Equitis Romani autem esse filium criminis loco poni ab accusatoribus neque his iudicantibus oportuit neque defendentibus nobis.</p>\r\n\r\n<p>Nam quod de pietate dixistis, est quidem ista nostra existimatio, sed iudicium certe parentis; quid nos opinemur, audietis ex iuratis; quid parentes sentiant, lacrimae matris incredibilisque maeror, squalor patris et haec praesens maestitia, quam cernitis, luctusque declarat.</p>', NULL, NULL, NULL, 'FAQ', 16),
(22, '2018-10-21 13:04:56', 'Nouvelle FAQ', '<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>', NULL, NULL, NULL, 'FAQ', 17),
(23, '2018-10-21 16:51:06', 'Pour les professionels', '<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.</p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute; &agrave; un des mots latins les plus obscurs,</span></p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute; &agrave; un des mots latins les plus obscurs,</span></p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute; &agrave; un des mots latins les plus obscurs,</span></p>', NULL, '20181021-181017-blog.jpg', '<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\">Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute; &agrave; un des mots latins les plus obscurs.</span></p>', 'marketing', 19),
(24, '2018-10-21 16:51:24', 'Pour les particuliers', '<h2>Le recyclage de vos cartouches jet d&rsquo;encre en Is&egrave;re</h2>\r\n\r\n<p>Pourquoi r&eacute;utiliser ses cartouches jet d&rsquo;encre&nbsp;? A quelle qualit&eacute; de produit faut-il s&rsquo;attendre&nbsp;?</p>\r\n\r\n<p>Nous utilisons une&nbsp;<strong>m&eacute;thode facile</strong>&nbsp;et&nbsp;<strong>respectueuse de l&rsquo;environnement</strong>&nbsp;pour recycler vos cartouches jet d&rsquo;encre.</p>\r\n\r\n<p><strong>Le prix est bien plus avantageux</strong>&nbsp;que l&#39;achat neuf, et la&nbsp;<strong>qualit&eacute; d&#39;impression</strong>&nbsp;est la m&ecirc;me ! Ainsi, vous continuez sereinement l&#39;impression de vos photos de vacances, de vos documents de travail, vos recettes de cuisine&hellip;</p>\r\n\r\n<p>Nous notons plusieurs avantages pour le&nbsp;<strong>recyclage de vos cartouches jet d&rsquo;encre</strong>&nbsp;:</p>\r\n\r\n<ul>\r\n	<li>Recyclage gratuit pour nos clients</li>\r\n	<li>Produit trait&eacute; dans le respect des r&eacute;glementations en vigueur</li>\r\n	<li>Aucune cartouche ne termine &agrave; la d&eacute;charge</li>\r\n	<li>Prix jusqu&rsquo;&agrave; 50% moins cher par rapport &agrave; une cartouche neuve</li>\r\n</ul>\r\n\r\n<p>Cartoooche 118 vous garantit que la cartouche recycl&eacute;e est&nbsp;<strong>tout aussi performante</strong>&nbsp;que celle d&rsquo;origine et sa&nbsp;<strong>dur&eacute;e de vie est identique</strong>.</p>\r\n\r\n<p>Franchissez le seuil de notre magasin &agrave; Grenoble et faites le test par vous-m&ecirc;me &agrave; un&nbsp;<strong>prix comp&eacute;titif</strong>&nbsp;!</p>', NULL, '20181021-181046-blog.jpg', '<p>Situ&eacute;e &agrave; Grenoble,&nbsp;<strong>Cartoooche 118</strong>, est votre entreprise professionnelle sp&eacute;cialis&eacute;e depuis 15 ans dans la&nbsp;<strong>recharge de cartouches jet d&rsquo;encre</strong>. Gr&acirc;ce &agrave; notre service, vous&nbsp;<strong>faites des &eacute;conomies</strong>&nbsp;et&nbsp;<strong>contribuez &agrave; la pr&eacute;servation de l&rsquo;environnement</strong>.<span style=\"background-color:#ffffff; color:#000000; font-family:&quot;Open Sans&quot;,Arial,sans-serif; font-size:14px\"> </span></p>', 'marketing', 18),
(25, '2018-10-21 16:51:46', 'Nos engagements', '<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.</p>', NULL, '20181021-181059-blog.jpg', '<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte.</p>', 'marketing', 20);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adherent_id` int(11) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B63E2EC725F06C53` (`adherent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `adherent_id`, `role`) VALUES
(1, 1, 'ROLE_USER'),
(2, 1, 'ROLE_ADMIN'),
(3, 2, 'ROLE_USER'),
(5, 3, 'ROLE_USER'),
(6, 3, 'ROLE_PUB');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_name`, `nom`, `prenom`, `mail`, `password`) VALUES
(1, 'obussier_adm', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i'),
(2, 'obussier_usr', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i'),
(3, 'obussier_pub', 'Bussier', 'Olivier', 'olivier@bussier.fr', '$2y$10$livyvJfA92niw.1fgnV/A.RXc5sP.a.ddABCsVcD9CITZ0HOj2u3i');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_B63E2EC725F06C53` FOREIGN KEY (`adherent_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;