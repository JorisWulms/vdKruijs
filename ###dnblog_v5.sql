-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 mrt 2017 om 09:18
-- Serverversie: 10.1.9-MariaDB
-- PHP-versie: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnblog_v5`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `affiliate_banner`
--

CREATE TABLE `affiliate_banner` (
  `bannerID` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `kliks` int(11) NOT NULL DEFAULT '0',
  `script` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `affiliate_banner_locatie`
--

CREATE TABLE `affiliate_banner_locatie` (
  `bannerID` int(10) NOT NULL,
  `locatie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `affiliate_shops`
--

CREATE TABLE `affiliate_shops` (
  `BID` int(12) NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `Beschrijving` text NOT NULL,
  `Seokey` varchar(255) NOT NULL,
  `Seodesc` text NOT NULL,
  `Seotitle` varchar(255) NOT NULL,
  `Rewrite` varchar(255) NOT NULL,
  `Visable` tinyint(1) NOT NULL,
  `Categorie` int(12) NOT NULL,
  `Foto_Locatie` varchar(255) NOT NULL,
  `Prijs` varchar(255) NOT NULL,
  `affiliatelink` varchar(255) NOT NULL,
  `kliks` varchar(50) NOT NULL DEFAULT '0',
  `Itemordering` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `affiliate_shops_cat`
--

CREATE TABLE `affiliate_shops_cat` (
  `Categorie` int(12) NOT NULL,
  `CATNaam` varchar(255) NOT NULL,
  `Items` int(12) NOT NULL,
  `Visable` tinyint(1) NOT NULL,
  `Ordering` int(20) NOT NULL DEFAULT '0',
  `Cat_Beschrijving` text NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodesc` varchar(255) NOT NULL,
  `seokey` varchar(255) NOT NULL,
  `Rewrite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blogs`
--

CREATE TABLE `blogs` (
  `blogID` int(12) NOT NULL,
  `visable` tinyint(1) NOT NULL,
  `catID` int(12) NOT NULL,
  `foto_locatie` varchar(32) NOT NULL,
  `datum` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `youtube` varchar(255) NOT NULL,
  `plugin` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blogs_language`
--

CREATE TABLE `blogs_language` (
  `blogID` int(12) NOT NULL,
  `naam` varchar(64) NOT NULL,
  `beschrijving` text NOT NULL,
  `extraItem` text NOT NULL,
  `seokey` varchar(64) NOT NULL,
  `seodesc` text NOT NULL,
  `seotitle` varchar(64) NOT NULL,
  `rewrite` varchar(32) NOT NULL,
  `language_id` int(11) NOT NULL,
  `introText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blog_cat`
--

CREATE TABLE `blog_cat` (
  `catID` int(12) NOT NULL,
  `visable` tinyint(1) NOT NULL,
  `ordering` int(20) NOT NULL DEFAULT '0',
  `leesmeer` tinyint(4) NOT NULL,
  `leesmeerAantal` int(10) NOT NULL,
  `navigatie` int(11) NOT NULL,
  `foto_locatie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blog_cat_language`
--

CREATE TABLE `blog_cat_language` (
  `catID` int(12) NOT NULL,
  `naam` varchar(32) NOT NULL,
  `beschrijving` text NOT NULL,
  `rewrite` varchar(255) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodesc` varchar(255) NOT NULL,
  `seokey` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `extraItem` text NOT NULL,
  `introText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactform`
--

CREATE TABLE `contactform` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ordening` int(11) NOT NULL,
  `visible` int(2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `placeholder` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contactform`
--

INSERT INTO `contactform` (`id`, `title`, `ordening`, `visible`, `type`, `placeholder`, `parent`) VALUES
(25, 'naam', 0, 1, 'text', 'Wat is uw naam?', 0),
(26, 'email', 0, 1, 'text', 'Wat is uw e-mailadres?', 0),
(27, 'opmerkingen', 0, 1, 'textarea', 'Uw opmerkingen...', 0),
(28, 'submit', 0, 1, 'submit', 'Verzenden', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `galerij`
--

CREATE TABLE `galerij` (
  `id` int(11) NOT NULL,
  `descr` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL DEFAULT '',
  `wachtwoord` varchar(100) NOT NULL DEFAULT '',
  `salt` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `actief` char(1) NOT NULL DEFAULT '0',
  `lastactive` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logoutdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aantal` int(1) NOT NULL,
  `ip` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `naam`, `wachtwoord`, `salt`, `status`, `email`, `actief`, `lastactive`, `logoutdate`, `aantal`, `ip`) VALUES
(1, 'admin', '805c677fbcb31569328b33bb6e57d7d48916db6b4a9974b841080e76663b689a', 'B3LwLtETxmTvrFPb', 9, 'cimst08@gmail.com', '1', '2017-03-23 09:17:15', '2011-04-29 09:25:59', 0, '192.168.10.42'),
(605, 'klant', '72221340d94f197f4c44508eb2b6ddf4a5f82a69613c462e612bba06f0f64abc', 'wF9yFbhsXYDL4WEf', 4, 'klant@klant.nl', '1', '2015-07-31 14:22:54', '0000-00-00 00:00:00', 0, '192.168.10.23');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `import_products`
--

CREATE TABLE `import_products` (
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_url` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_property` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linkbuilding`
--

CREATE TABLE `linkbuilding` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `anchortext` varchar(255) NOT NULL,
  `extraText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linksys_cat`
--

CREATE TABLE `linksys_cat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rewrite` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodesc` varchar(255) NOT NULL,
  `seokey` varchar(255) NOT NULL,
  `volgorde` int(11) NOT NULL,
  `navigatie` int(11) NOT NULL,
  `imagelocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linksys_link`
--

CREATE TABLE `linksys_link` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rewrite` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `longdesc` text NOT NULL,
  `shortdesc` text NOT NULL,
  `place` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `category` int(10) NOT NULL,
  `searchwords` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `returnlink` text NOT NULL,
  `ownsite` tinyint(1) NOT NULL,
  `tip` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `rewrite` varchar(255) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '0',
  `ordening` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `module`
--

INSERT INTO `module` (`id`, `parent`, `title`, `rewrite`, `visible`, `ordening`) VALUES
(1, 0, 'Dashboard', 'dashboard', 1, 1),
(8, 0, 'Modules', 'module', 1, 12),
(24, 0, 'Configuratie', '#', 1, 11),
(30, 0, 'Pagina''s', 'sitetree', 1, 2),
(41, 0, 'Nieuws', 'nieuws', 1, 6),
(56, 0, 'Banners', 'banner', 1, 5),
(57, 83, 'Fotos', 'photo', 1, 2),
(59, 83, 'Categorie', 'project', 1, 1),
(61, 80, 'Producten', 'shop_products', 1, 2),
(62, 80, 'Categorieën', 'shop_cat', 1, 1),
(63, 84, 'Artikelen', 'blog', 1, 2),
(64, 84, 'Categorie&euml;n', 'blogcat', 1, 1),
(65, 24, 'Algemene instellingen', 'settings_general', 1, 1),
(66, 24, 'Style instellingen', 'settings_style', 1, 2),
(67, 24, 'Banner instellingen', 'settings_banner', 1, 3),
(68, 24, 'Blog instellingen', 'settings_blogs', 1, 4),
(69, 77, 'Contactformulier', 'contact', 1, 1),
(70, 24, 'Robots.txt', 'robots', 1, 6),
(71, 24, 'Gebruikers', 'user', 1, 8),
(72, 24, 'Talen', 'language', 1, 10),
(75, 77, 'Linkbuilding', 'linkbuilding', 1, 1),
(76, 77, 'Notice', 'settings_notice', 1, 2),
(77, 0, 'Plugins', '#', 1, 9),
(78, 77, 'Popup', 'settings_popup', 1, 3),
(79, 24, 'Plugins', 'plugin', 1, 9),
(80, 0, 'Affiliate Shop', '#', 1, 8),
(81, 80, 'Affiliate Banners', 'affiliatebanner', 1, 3),
(82, 24, 'Nieuws instellingen', 'settings_nieuws', 1, 5),
(83, 0, 'Galerij', '#', 1, 7),
(84, 0, 'Blog', '#', 1, 3),
(85, 0, 'Linksystem', '#', 1, 10),
(86, 85, 'Categorieën', 'linksys_cat', 1, 1),
(87, 85, 'Links', 'linksys_link', 1, 2),
(88, 0, 'Navigatie', 'navigation', 1, 4),
(89, 24, 'Custom CSS', 'settings_custom_css', 1, 7),
(90, 24, 'Richdata instellingen', 'settings_richdata', 1, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `module_koppel`
--

CREATE TABLE `module_koppel` (
  `moduleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `module_koppel`
--

INSERT INTO `module_koppel` (`moduleID`, `userID`) VALUES
(1, 1),
(1, 605),
(8, 1),
(24, 1),
(30, 1),
(30, 605),
(41, 1),
(41, 605),
(56, 1),
(57, 1),
(59, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `navigation`
--

CREATE TABLE `navigation` (
  `id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `navigationID` int(11) NOT NULL,
  `sitetreeID` int(11) NOT NULL,
  `blogCatID` int(11) NOT NULL,
  `linksysCatID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rewrite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `navigation`
--

INSERT INTO `navigation` (`id`, `ordering`, `navigationID`, `sitetreeID`, `blogCatID`, `linksysCatID`, `title`, `rewrite`) VALUES
(1, 1, 3, 1, 0, 0, 'Home', 'index'),
(6, 0, 0, 8, 0, 0, 'Bedankt contact', 'bedankt-contact'),
(15, 9, 3, 12, 0, 0, 'Contact', 'contact');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `visible` int(1) NOT NULL,
  `datum` date NOT NULL,
  `modified` date NOT NULL,
  `foto_locatie` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_language`
--

CREATE TABLE `news_language` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rewrite` text NOT NULL,
  `bigtext` text NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodesc` varchar(255) NOT NULL,
  `seokey` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plugin`
--

CREATE TABLE `plugin` (
  `id` int(11) NOT NULL,
  `naam` varchar(150) NOT NULL,
  `plugin` varchar(150) NOT NULL,
  `pluginSize` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `plugin`
--

INSERT INTO `plugin` (`id`, `naam`, `plugin`, `pluginSize`) VALUES
(1, 'Contactformulier', 'contact', 0),
(2, 'Landingspages', 'landingspages', 0),
(5, 'Nieuws overzicht', 'nieuws', 0),
(6, 'Random blogs', 'randomBlogs', 1),
(7, 'Productfeed overzicht', 'productfeed', 1),
(8, 'Affiliate Shop', 'shop', 1),
(9, 'Galerij', 'gallery', 1),
(10, 'Linksys signup', 'linksys_signup', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `rewrite` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `beschrijving` text COLLATE latin1_general_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '0',
  `korteBeschrijving` text COLLATE latin1_general_ci NOT NULL,
  `slogan` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `projectCategory` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project_galerij`
--

CREATE TABLE `project_galerij` (
  `galerijid` int(11) NOT NULL,
  `projectid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_banner`
--

CREATE TABLE `settings_banner` (
  `id` int(2) NOT NULL,
  `layoutType` int(1) NOT NULL DEFAULT '1',
  `title1_size` varchar(5) NOT NULL DEFAULT '3em',
  `title1_color` varchar(25) NOT NULL DEFAULT '#FFFFFF',
  `title1_uppercase` tinyint(1) NOT NULL,
  `title1_background` varchar(25) NOT NULL,
  `title2_size` varchar(5) NOT NULL DEFAULT '1.5em',
  `title2_color` varchar(25) NOT NULL DEFAULT '#FFFFFF',
  `title2_uppercase` tinyint(1) NOT NULL,
  `title2_background` varchar(25) NOT NULL,
  `buttonColor` varchar(10) NOT NULL,
  `buttonBackgroundColor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_banner`
--

INSERT INTO `settings_banner` (`id`, `layoutType`, `title1_size`, `title1_color`, `title1_uppercase`, `title1_background`, `title2_size`, `title2_color`, `title2_uppercase`, `title2_background`, `buttonColor`, `buttonBackgroundColor`) VALUES
(1, 7, '40px', '#ffffff', 1, '', '24px', '#FFFFFF', 0, '', '#ffffff', '#B51F24');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_blogs`
--

CREATE TABLE `settings_blogs` (
  `id` tinyint(4) NOT NULL,
  `layoutTypeRandom` int(11) NOT NULL,
  `layoutTypeCategory` int(11) NOT NULL,
  `layoutTypeBlog` int(11) NOT NULL,
  `randomAmt` int(2) NOT NULL,
  `randomMainColor` varchar(10) NOT NULL,
  `randomSubColor` varchar(10) NOT NULL,
  `randomTxtColor` varchar(10) NOT NULL,
  `randomTxtAmt` int(10) NOT NULL,
  `randomTitleSize` varchar(10) NOT NULL,
  `randomTitleColor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_blogs`
--

INSERT INTO `settings_blogs` (`id`, `layoutTypeRandom`, `layoutTypeCategory`, `layoutTypeBlog`, `randomAmt`, `randomMainColor`, `randomSubColor`, `randomTxtColor`, `randomTxtAmt`, `randomTitleSize`, `randomTitleColor`) VALUES
(1, 8, 1, 1, 4, '#B51F24', '#1f1f1f', '#ffffff', 250, '2em', '#B51F24');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_contact`
--

CREATE TABLE `settings_contact` (
  `id` tinyint(1) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `bedanktpagina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_contact`
--

INSERT INTO `settings_contact` (`id`, `titel`, `bedanktpagina`) VALUES
(1, 'Contactformulier', 'bedankt-contact');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_general`
--

CREATE TABLE `settings_general` (
  `id` tinyint(1) NOT NULL,
  `websitename` varchar(255) NOT NULL,
  `websiteurl` varchar(255) NOT NULL,
  `emailaddress` varchar(255) NOT NULL,
  `bccaddress` varchar(255) NOT NULL,
  `sitemap` tinyint(1) NOT NULL,
  `blogpath` varchar(20) NOT NULL,
  `linksyspath` varchar(20) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `additionalTagHeader` text NOT NULL,
  `additionalTagBody` text NOT NULL,
  `xmlFeed` varchar(255) NOT NULL,
  `notFound` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_general`
--

INSERT INTO `settings_general` (`id`, `websitename`, `websiteurl`, `emailaddress`, `bccaddress`, `sitemap`, `blogpath`, `linksyspath`, `logo`, `additionalTagHeader`, `additionalTagBody`, `xmlFeed`, `notFound`) VALUES
(1, 'DynBlog', 'http://192.168.10.42/dynamicblogv5local/', 'info@', 'thomasmcdougal@yahoo.nl', 1, 'blog', 'linksys', 'logoCross.png', '', '', '', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_linkbuilding`
--

CREATE TABLE `settings_linkbuilding` (
  `id` int(1) NOT NULL,
  `position` int(1) NOT NULL,
  `extraPosition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_linkbuilding`
--

INSERT INTO `settings_linkbuilding` (`id`, `position`, `extraPosition`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_nieuws`
--

CREATE TABLE `settings_nieuws` (
  `id` tinyint(1) NOT NULL,
  `newspath` varchar(32) NOT NULL,
  `pluginTextAmt` int(10) NOT NULL,
  `overviewTextAmt` int(10) NOT NULL,
  `pluginAmt` int(10) NOT NULL,
  `buttonColor` varchar(100) NOT NULL,
  `buttonBorderRadius` varchar(10) NOT NULL,
  `buttonTextColor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_nieuws`
--

INSERT INTO `settings_nieuws` (`id`, `newspath`, `pluginTextAmt`, `overviewTextAmt`, `pluginAmt`, `buttonColor`, `buttonBorderRadius`, `buttonTextColor`) VALUES
(1, 'news', 80, 140, 3, '#B51F24', '4px', '#ffffff');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_notice`
--

CREATE TABLE `settings_notice` (
  `id` tinyint(1) NOT NULL,
  `noticeText` text NOT NULL,
  `buttonText` varchar(30) NOT NULL,
  `colorScheme` varchar(40) NOT NULL,
  `noticeTextColor` varchar(25) NOT NULL,
  `plugin` varchar(30) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_notice`
--

INSERT INTO `settings_notice` (`id`, `noticeText`, `buttonText`, `colorScheme`, `noticeTextColor`, `plugin`, `active`) VALUES
(1, '', 'Open', '#000000', '#ffffff', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_popup`
--

CREATE TABLE `settings_popup` (
  `id` tinyint(1) NOT NULL,
  `popupContent` text NOT NULL,
  `popupTextColor` varchar(30) NOT NULL,
  `popupSize` varchar(30) NOT NULL,
  `popupBorderRadius` varchar(15) NOT NULL,
  `popupCloseBg` varchar(10) NOT NULL,
  `popupCloseColor` varchar(10) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_popup`
--

INSERT INTO `settings_popup` (`id`, `popupContent`, `popupTextColor`, `popupSize`, `popupBorderRadius`, `popupCloseBg`, `popupCloseColor`, `active`) VALUES
(1, '', '#363636', '100%', '6px', '#f20303', '#ffffff', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_richdata`
--

CREATE TABLE `settings_richdata` (
  `id` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `streetAddress` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addressLocality` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postalCode` varchar(10) CHARACTER SET utf8 NOT NULL,
  `addressCountry` varchar(2) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(25) CHARACTER SET utf8 NOT NULL,
  `contacturl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sameAs_facebook` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sameAs_twitter` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sameAs_google` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alternateName` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_richdata`
--

INSERT INTO `settings_richdata` (`id`, `active`, `streetAddress`, `addressLocality`, `postalCode`, `addressCountry`, `telephone`, `contacturl`, `sameAs_facebook`, `sameAs_twitter`, `sameAs_google`, `alternateName`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings_style`
--

CREATE TABLE `settings_style` (
  `id` int(1) NOT NULL,
  `fontFamily1` varchar(255) NOT NULL,
  `fontFamily2` varchar(255) NOT NULL,
  `fontSize` varchar(10) NOT NULL,
  `fontWeight` varchar(20) NOT NULL,
  `fontColor` varchar(10) NOT NULL,
  `titleColor` varchar(10) NOT NULL,
  `linkColor` varchar(10) NOT NULL,
  `headerBorder` varchar(10) NOT NULL,
  `headerBackground` varchar(20) NOT NULL,
  `headerFixed` int(1) NOT NULL DEFAULT '1',
  `menuBackground` varchar(10) NOT NULL,
  `menuColor` varchar(10) NOT NULL,
  `menuItemPadding` varchar(5) NOT NULL,
  `menuFullWidth` int(1) NOT NULL,
  `menuBorders` varchar(10) NOT NULL,
  `menuHoverColor` varchar(10) NOT NULL,
  `menuCapitals` int(1) NOT NULL,
  `centerLogo` int(1) NOT NULL DEFAULT '0',
  `siteWidth` varchar(10) NOT NULL,
  `siteContainerWidth` varchar(10) NOT NULL,
  `siteBackground` varchar(255) NOT NULL,
  `siteLineheight` varchar(10) NOT NULL,
  `h1size` varchar(10) NOT NULL,
  `h1weight` varchar(10) NOT NULL,
  `h2size` varchar(10) NOT NULL,
  `h2weight` varchar(10) NOT NULL,
  `h3size` varchar(10) NOT NULL,
  `h3weight` varchar(10) NOT NULL,
  `textBlockBackground` varchar(10) NOT NULL,
  `textBlockColor` varchar(10) NOT NULL,
  `footerBackground` varchar(10) NOT NULL,
  `footerColor` varchar(10) NOT NULL,
  `footerBorder` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings_style`
--

INSERT INTO `settings_style` (`id`, `fontFamily1`, `fontFamily2`, `fontSize`, `fontWeight`, `fontColor`, `titleColor`, `linkColor`, `headerBorder`, `headerBackground`, `headerFixed`, `menuBackground`, `menuColor`, `menuItemPadding`, `menuFullWidth`, `menuBorders`, `menuHoverColor`, `menuCapitals`, `centerLogo`, `siteWidth`, `siteContainerWidth`, `siteBackground`, `siteLineheight`, `h1size`, `h1weight`, `h2size`, `h2weight`, `h3size`, `h3weight`, `textBlockBackground`, `textBlockColor`, `footerBackground`, `footerColor`, `footerBorder`) VALUES
(1, 'Open+Sans', 'Open+Sans+Condensed', '14px', 'normal', '#555555', '#B51F24', '#B51F24', '', '#ffffff', 0, '#B51F24', '#ffffff', '15px', 1, '', '#ffffff', 1, 1, '1000px', '', '#ffffff', '24px', '28px', 'bold', '22px', 'bold', '18px', 'bold', '#ffffff', '', '#1f1f1f', '#e6e6e6', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sitetree`
--

CREATE TABLE `sitetree` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `navigatie` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `exttemp` varchar(255) NOT NULL,
  `leesmeer` tinyint(1) NOT NULL DEFAULT '1',
  `leesmeerAantal` int(10) NOT NULL DEFAULT '5'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sitetree`
--

INSERT INTO `sitetree` (`id`, `parent`, `visible`, `ordering`, `navigatie`, `images`, `exttemp`, `leesmeer`, `leesmeerAantal`) VALUES
(1, 0, 1, 0, 3, '', '', 0, 3),
(8, 0, 1, 0, 0, '', '', 0, 5),
(12, 0, 1, 0, 3, '', '1', 0, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sitetree_categorie`
--

CREATE TABLE `sitetree_categorie` (
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `sitetreeid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sitetree_language`
--

CREATE TABLE `sitetree_language` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rewrite` text NOT NULL,
  `bigtext` text NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodesc` varchar(255) NOT NULL,
  `seokey` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `lpintro` text NOT NULL,
  `introText` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sitetree_language`
--

INSERT INTO `sitetree_language` (`id`, `title`, `rewrite`, `bigtext`, `seotitle`, `seodesc`, `seokey`, `language_id`, `lpintro`, `introText`) VALUES
(1, 'Home', 'index', '<h1>Welkom</h1>\r\n', '', '', '', 2, '																																																																																																																																															', ''),
(8, 'Bedankt contact', 'bedankt-contact', '<p>Bedankt voor het invullen van ons contactformulier.</p>\r\n', '', '', '', 2, '', ''),
(12, 'Contact', 'contact', '', '', '', '', 2, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `slider`
--

CREATE TABLE `slider` (
  `bannerID` int(20) NOT NULL,
  `bannerLinkNL` varchar(255) NOT NULL,
  `bannerOrder` int(20) NOT NULL,
  `bannerSrc` varchar(255) NOT NULL,
  `topTextNL` varchar(255) NOT NULL,
  `bottomTextNL` varchar(255) NOT NULL,
  `bannerButtonNL` varchar(255) NOT NULL,
  `bannerOverlay` tinyint(1) NOT NULL,
  `bannerOverlayColor` varchar(10) NOT NULL,
  `bannerOverlayOpacity` varchar(10) NOT NULL,
  `bannerBackground` varchar(10) NOT NULL,
  `bannerPadding` varchar(10) NOT NULL,
  `bannerFocus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `slider`
--

INSERT INTO `slider` (`bannerID`, `bannerLinkNL`, `bannerOrder`, `bannerSrc`, `topTextNL`, `bottomTextNL`, `bannerButtonNL`, `bannerOverlay`, `bannerOverlayColor`, `bannerOverlayOpacity`, `bannerBackground`, `bannerPadding`, `bannerFocus`) VALUES
(2, '', 0, 'img_2.jpg', '', '', '', 1, '#000000', '0.4', '', '80px', 'center');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `slider_page`
--

CREATE TABLE `slider_page` (
  `bannerID` int(10) NOT NULL,
  `rewrite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `slider_page`
--

INSERT INTO `slider_page` (`bannerID`, `rewrite`) VALUES
(2, 'index');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `text_display`
--

CREATE TABLE `text_display` (
  `id` int(11) NOT NULL,
  `text_partcode` varchar(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `text_language`
--

CREATE TABLE `text_language` (
  `id` int(11) NOT NULL,
  `language_id` char(2) NOT NULL DEFAULT '',
  `text_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `text_languages`
--

CREATE TABLE `text_languages` (
  `id` int(11) NOT NULL,
  `text_langcode` char(2) NOT NULL DEFAULT '',
  `text_language` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL,
  `website` varchar(255) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `text_languages`
--

INSERT INTO `text_languages` (`id`, `text_langcode`, `text_language`, `ordering`, `website`, `visible`) VALUES
(2, 'NL', 'Nederlands', 1, 'http://localhost/', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `affiliate_banner`
--
ALTER TABLE `affiliate_banner`
  ADD PRIMARY KEY (`bannerID`);

--
-- Indexen voor tabel `affiliate_shops`
--
ALTER TABLE `affiliate_shops`
  ADD PRIMARY KEY (`BID`);

--
-- Indexen voor tabel `affiliate_shops_cat`
--
ALTER TABLE `affiliate_shops_cat`
  ADD PRIMARY KEY (`Categorie`);

--
-- Indexen voor tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogID`);

--
-- Indexen voor tabel `blogs_language`
--
ALTER TABLE `blogs_language`
  ADD UNIQUE KEY `BID` (`blogID`,`language_id`);

--
-- Indexen voor tabel `blog_cat`
--
ALTER TABLE `blog_cat`
  ADD PRIMARY KEY (`catID`);

--
-- Indexen voor tabel `blog_cat_language`
--
ALTER TABLE `blog_cat_language`
  ADD UNIQUE KEY `Categorie` (`catID`,`language_id`);

--
-- Indexen voor tabel `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `galerij`
--
ALTER TABLE `galerij`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `import_products`
--
ALTER TABLE `import_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `linkbuilding`
--
ALTER TABLE `linkbuilding`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `linksys_cat`
--
ALTER TABLE `linksys_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `linksys_link`
--
ALTER TABLE `linksys_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `module_koppel`
--
ALTER TABLE `module_koppel`
  ADD PRIMARY KEY (`moduleID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `news_language`
--
ALTER TABLE `news_language`
  ADD UNIQUE KEY `id` (`id`,`language_id`);

--
-- Indexen voor tabel `plugin`
--
ALTER TABLE `plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `project_galerij`
--
ALTER TABLE `project_galerij`
  ADD PRIMARY KEY (`galerijid`,`projectid`);

--
-- Indexen voor tabel `settings_banner`
--
ALTER TABLE `settings_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_blogs`
--
ALTER TABLE `settings_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_contact`
--
ALTER TABLE `settings_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_general`
--
ALTER TABLE `settings_general`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_linkbuilding`
--
ALTER TABLE `settings_linkbuilding`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_nieuws`
--
ALTER TABLE `settings_nieuws`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_notice`
--
ALTER TABLE `settings_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_popup`
--
ALTER TABLE `settings_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_richdata`
--
ALTER TABLE `settings_richdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings_style`
--
ALTER TABLE `settings_style`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sitetree`
--
ALTER TABLE `sitetree`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sitetree_categorie`
--
ALTER TABLE `sitetree_categorie`
  ADD PRIMARY KEY (`categoryid`,`sitetreeid`);

--
-- Indexen voor tabel `sitetree_language`
--
ALTER TABLE `sitetree_language`
  ADD UNIQUE KEY `id` (`id`,`language_id`);

--
-- Indexen voor tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`bannerID`);

--
-- Indexen voor tabel `text_display`
--
ALTER TABLE `text_display`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `text_language`
--
ALTER TABLE `text_language`
  ADD UNIQUE KEY `id` (`id`,`language_id`);

--
-- Indexen voor tabel `text_languages`
--
ALTER TABLE `text_languages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `affiliate_banner`
--
ALTER TABLE `affiliate_banner`
  MODIFY `bannerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `affiliate_shops`
--
ALTER TABLE `affiliate_shops`
  MODIFY `BID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `affiliate_shops_cat`
--
ALTER TABLE `affiliate_shops_cat`
  MODIFY `Categorie` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `blogs_language`
--
ALTER TABLE `blogs_language`
  MODIFY `blogID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `blog_cat`
--
ALTER TABLE `blog_cat`
  MODIFY `catID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `contactform`
--
ALTER TABLE `contactform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT voor een tabel `galerij`
--
ALTER TABLE `galerij`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;
--
-- AUTO_INCREMENT voor een tabel `import_products`
--
ALTER TABLE `import_products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `linkbuilding`
--
ALTER TABLE `linkbuilding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `linksys_cat`
--
ALTER TABLE `linksys_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `linksys_link`
--
ALTER TABLE `linksys_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT voor een tabel `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT voor een tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `plugin`
--
ALTER TABLE `plugin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `settings_banner`
--
ALTER TABLE `settings_banner`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_contact`
--
ALTER TABLE `settings_contact`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_general`
--
ALTER TABLE `settings_general`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_linkbuilding`
--
ALTER TABLE `settings_linkbuilding`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_nieuws`
--
ALTER TABLE `settings_nieuws`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_popup`
--
ALTER TABLE `settings_popup`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `settings_style`
--
ALTER TABLE `settings_style`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `sitetree`
--
ALTER TABLE `sitetree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT voor een tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `bannerID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `text_display`
--
ALTER TABLE `text_display`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `text_languages`
--
ALTER TABLE `text_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `module_koppel`
--
ALTER TABLE `module_koppel`
  ADD CONSTRAINT `module_koppel_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_koppel_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `gebruikers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
