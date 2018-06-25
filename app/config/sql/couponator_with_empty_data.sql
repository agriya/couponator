-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2012 at 06:11 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `couponator`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_sites`
--

DROP TABLE IF EXISTS `affiliate_sites`;
CREATE TABLE IF NOT EXISTS `affiliate_sites` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `affiliate_sites`
--

INSERT INTO `affiliate_sites` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Site'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Link Share'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Community Junction'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PepperJam'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ShareASale'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'For Me To Coupon'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Google Affiliates Network');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `class` varchar(100) collate utf8_unicode_ci NOT NULL,
  `foreign_id` bigint(20) unsigned NOT NULL,
  `filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dir` varchar(100) collate utf8_unicode_ci NOT NULL,
  `mimetype` varchar(100) collate utf8_unicode_ci default NULL,
  `filesize` bigint(20) default NULL,
  `height` bigint(20) default NULL,
  `width` bigint(20) default NULL,
  `thumb` tinyint(1) default NULL,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`),
  KEY `class` (`class`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Attachment Details';

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `created`, `modified`, `class`, `foreign_id`, `filename`, `dir`, `mimetype`, `filesize`, `height`, `width`, `thumb`, `description`) VALUES
(1, '2009-05-11 20:15:24', '2009-05-11 20:15:24', 'UserAvatar', 0, 'default_avatar.jpg', 'UserAvatar/0', 'image/jpeg', 1087, 50, 50, NULL, ''),
(2, '2009-05-11 20:15:24', '2009-05-11 20:15:24', 'Store', 0, 'default_avatar.png', 'Store/0', 'image/jpeg', 1087, 50, 50, NULL, ''),
(3, '2009-05-11 20:15:24', '2009-05-11 20:15:24', 'UserCoupon', 0, 'default_avatar.jpg', 'UserCoupon/0', 'image/jpeg', 1087, 50, 50, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `banned_ips`
--

DROP TABLE IF EXISTS `banned_ips`;
CREATE TABLE IF NOT EXISTS `banned_ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `range` varchar(255) collate utf8_unicode_ci default NULL,
  `referer_url` varchar(255) collate utf8_unicode_ci default NULL,
  `reason` varchar(255) collate utf8_unicode_ci default NULL,
  `redirect` varchar(255) collate utf8_unicode_ci default NULL,
  `thetime` int(15) NOT NULL,
  `timespan` int(15) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `address` (`address`),
  KEY `range` (`range`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Banned IPs Details';

--
-- Dumping data for table `banned_ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `cake_sessions`
--

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL default '0',
  `data` text collate utf8_unicode_ci,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Session Details';

--
-- Dumping data for table `cake_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `slug` varchar(100) collate utf8_unicode_ci NOT NULL,
  `coupon_count` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created`, `modified`, `title`, `slug`, `coupon_count`, `is_active`) VALUES
(1, '2011-02-16 12:40:56', '2011-02-16 12:40:56', 'Apparel', 'apparel', 0, 1),
(2, '2011-02-16 12:41:10', '2011-02-16 12:41:10', 'Apparel - Babies & Kids', 'apparel-babies-kids', 0, 1),
(3, '2011-02-16 12:41:18', '2011-02-16 12:41:18', 'Apparel - Men', 'apparel-men-s', 0, 1),
(4, '2011-02-16 12:41:56', '2011-02-16 12:41:56', 'Apparel - Womans', 'apparel-woman-s', 0, 1),
(5, '2011-02-16 12:42:13', '2011-02-16 12:42:13', 'Automotive', 'automotive', 0, 1),
(6, '2011-02-16 12:45:53', '2011-02-16 12:45:53', 'Beauty & Fragrance', 'beauty-fragrance', 0, 1),
(7, '2011-02-16 12:46:09', '2011-02-16 12:46:09', 'Books & Magazines', 'books-magazines', 0, 1),
(8, '2011-02-16 12:46:18', '2011-02-16 12:46:18', 'Cameras & Photography', 'cameras-photography', 0, 1),
(9, '2011-02-16 12:46:31', '2011-02-16 12:46:31', 'Car Rental', 'car-rental', 0, 1),
(10, '2011-02-16 12:47:17', '2011-02-16 12:47:17', 'Computers', 'computers', 0, 1),
(11, '2011-02-16 12:47:24', '2011-02-16 12:47:24', 'Dating', 'dating', 0, 1),
(12, '2011-02-16 12:47:39', '2011-02-16 12:47:39', 'Department Store', 'department-store', 0, 1),
(13, '2011-02-16 12:47:47', '2011-02-16 12:47:47', 'Electronic Equipment', 'electronic-equipment', 0, 1),
(14, '2011-02-16 12:47:56', '2011-02-16 12:47:56', 'Flowers', 'flowers', 0, 1),
(15, '2011-02-16 12:48:05', '2011-02-16 12:48:05', 'Garden & Outdoors', 'garden-outdoors', 0, 1),
(16, '2011-02-16 12:48:14', '2011-02-16 12:48:14', 'Gifts', 'gifts', 0, 1),
(17, '2011-02-16 12:48:23', '2011-02-16 12:48:23', 'Gourmet Food & Drink', 'gourmet-food-drink', 0, 1),
(18, '2011-02-16 12:48:30', '2011-02-16 12:48:30', 'Green Products', 'green-products', 0, 1),
(19, '2011-02-16 12:48:40', '2011-02-16 12:48:40', 'Health & Wellness', 'health-wellness', 0, 1),
(20, '2011-02-16 12:52:43', '2011-02-16 12:52:43', 'House wares', 'house-wares', 0, 1),
(21, '2011-02-16 12:52:52', '2011-02-16 12:52:52', 'Jewelry & Accessories', 'jewelry-accessories', 0, 1),
(23, '2011-02-16 12:54:09', '2011-02-16 12:54:09', 'Music & Movies', 'music-movies', 0, 1),
(24, '2011-02-16 12:54:24', '2011-02-16 12:54:24', 'Pet Care', 'pet-care', 0, 1),
(25, '2011-02-16 12:54:32', '2011-02-16 12:54:32', 'Services', 'services', 0, 1),
(26, '2011-02-16 12:54:43', '2011-02-16 12:54:43', 'Shoes', 'shoes', 0, 1),
(27, '2011-02-16 12:54:51', '2011-02-16 12:54:51', 'Software & Downloads', 'software-downloads', 0, 1),
(28, '2011-02-16 12:55:04', '2011-02-16 12:55:04', 'Sports & Fitness', 'sports-fitness', 0, 1),
(29, '2011-02-16 12:55:15', '2011-02-16 12:55:15', 'Toys & Games', 'toys-games', 0, 1),
(30, '2011-02-16 12:55:23', '2011-02-16 12:55:23', 'Travel & Vacations', 'travel-vacations', 0, 1),
(32, '2011-02-16 12:56:06', '2011-02-16 12:56:06', 'Babies & Kids', 'babies-kids', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `name` varchar(45) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(45) collate utf8_unicode_ci NOT NULL,
  `latitude` float default NULL,
  `longitude` float default NULL,
  `timezone` varchar(10) collate utf8_unicode_ci default NULL,
  `dma_id` int(11) default NULL,
  `county` varchar(25) collate utf8_unicode_ci default NULL,
  `code` varchar(4) collate utf8_unicode_ci default NULL,
  `store_count` bigint(20) NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`),
  KEY `is_approved` (`is_approved`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--


-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `subject` varchar(255) collate utf8_unicode_ci NOT NULL,
  `message` text collate utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) collate utf8_unicode_ci default NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `fips104` varchar(2) collate utf8_unicode_ci default NULL,
  `iso2` varchar(2) collate utf8_unicode_ci default NULL,
  `iso3` varchar(3) collate utf8_unicode_ci default NULL,
  `ison` varchar(4) collate utf8_unicode_ci default NULL,
  `internet` varchar(2) collate utf8_unicode_ci default NULL,
  `capital` varchar(25) collate utf8_unicode_ci default NULL,
  `map_reference` varchar(50) collate utf8_unicode_ci default NULL,
  `nationality_singular` varchar(35) collate utf8_unicode_ci default NULL,
  `nationality_plural` varchar(35) collate utf8_unicode_ci default NULL,
  `currency` varchar(30) collate utf8_unicode_ci default NULL,
  `currency_code` varchar(3) collate utf8_unicode_ci default NULL,
  `population` bigint(20) default NULL,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `comment` text collate utf8_unicode_ci,
  `slug` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `fips104`, `iso2`, `iso3`, `ison`, `internet`, `capital`, `map_reference`, `nationality_singular`, `nationality_plural`, `currency`, `currency_code`, `population`, `title`, `comment`, `slug`) VALUES
(1, 'Afghanistan (افغانستان)', 'AF', 'AF', 'AFG', '4', 'AF', 'Kabul ', 'Asia ', 'Afghan', 'Afghans', 'Afghani ', 'AFA', 26813057, 'Afghanistan', '', 'afghanistan'),
(2, 'Albania (Shqipëria)', 'AL', 'AL', 'ALB', '8', 'AL', 'Tirana ', 'Europe ', 'Albanian', 'Albanians', 'Lek ', 'ALL', 3510484, 'Albania', '', 'albania-shqip-ria'),
(3, 'Algeria (الجزائر)', 'AG', 'DZ', 'DZA', '12', 'DZ', 'Algiers ', 'Africa ', 'Algerian', 'Algerians', 'Algerian Dinar ', 'DZD', 31736053, 'Algeria', '', 'algeria'),
(4, 'American Samoa', 'AQ', 'AS', 'ASM', '16', 'AS', 'Pago Pago ', 'Oceania ', 'American Samoan', 'American Samoans', 'US Dollar', 'USD', 67084, 'American Samoa', '', 'american-samoa'),
(5, 'Andorra', 'AN', 'AD', 'AND', '20', 'AD', 'Andorra la Vella ', 'Europe ', 'Andorran', 'Andorrans', 'Euro', 'EUR', 67627, 'Andorra', '', 'andorra'),
(6, 'Angola', 'AO', 'AO', 'AGO', '24', 'AO', 'Luanda ', 'Africa ', 'Angolan', 'Angolans', 'Kwanza ', 'AOA', 10366031, 'Angola', '', 'angola'),
(7, 'Anguilla', 'AV', 'AI', 'AIA', '660', 'AI', 'The Valley ', 'Central America and the Caribbean ', 'Anguillan', 'Anguillans', 'East Caribbean Dollar ', 'XCD', 12132, 'Anguilla', '', 'anguilla'),
(8, 'Antarctica', 'AY', 'AQ', 'ATA', '10', 'AQ', '', 'Antarctic Region ', '', '', '', '', 0, 'Antarctica', 'ISO defines as the territory south of 60 degrees south latitude', 'antarctica'),
(9, 'Antigua and Barbuda', 'AC', 'AG', 'ATG', '28', 'AG', 'Saint John''s ', 'Central America and the Caribbean ', 'Antiguan and Barbudan', 'Antiguans and Barbudans', 'East Caribbean Dollar ', 'XCD', 66970, 'Antigua and Barbuda', '', 'antigua-and-barbuda'),
(10, 'Argentina', 'AR', 'AR', 'ARG', '32', 'AR', 'Buenos Aires ', 'South America ', 'Argentine', 'Argentines', 'Argentine Peso ', 'ARS', 37384816, 'Argentina', '', 'argentina'),
(11, 'Armenia (Հայաստան)', 'AM', 'AM', 'ARM', '51', 'AM', 'Yerevan ', 'Commonwealth of Independent States ', 'Armenian', 'Armenians', 'Armenian Dram ', 'AMD', 3336100, 'Armenia', '', 'armenia'),
(12, 'Aruba', 'AA', 'AW', 'ABW', '533', 'AW', 'Oranjestad ', 'Central America and the Caribbean ', 'Aruban', 'Arubans', 'Aruban Guilder', 'AWG', 70007, 'Aruba', '', 'aruba'),
(13, 'Ashmore and Cartier', 'AT', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'Ashmore and Cartier', 'ISO includes with Australia', 'ashmore-and-cartier'),
(14, 'Australia', 'AS', 'AU', 'AUS', '36', 'AU', 'Canberra ', 'Oceania ', 'Australian', 'Australians', 'Australian dollar ', 'AUD', 19357594, 'Australia', 'ISO includes Ashmore and Cartier Islands,Coral Sea Islands', 'australia'),
(15, 'Austria (Österreich)', 'AU', 'AT', 'AUT', '40', 'AT', 'Vienna ', 'Europe ', 'Austrian', 'Austrians', 'Euro', 'EUR', 8150835, 'Austria', '', 'austria-sterreich'),
(16, 'Azerbaijan (Azərbaycan)', 'AJ', 'AZ', 'AZE', '31', 'AZ', 'Baku (Baki) ', 'Commonwealth of Independent States ', 'Azerbaijani', 'Azerbaijanis', 'Azerbaijani Manat ', 'AZM', 7771092, 'Azerbaijan', '', 'azerbaijan-az-rbaycan'),
(17, 'Bahamas', 'BF', 'BS', 'BHS', '44', 'BS', 'Nassau ', 'Central America and the Caribbean ', 'Bahamian', 'Bahamians', 'Bahamian Dollar ', 'BSD', 297852, 'The Bahamas', '', 'bahamas'),
(18, 'Bahrain (البحرين)', 'BA', 'BH', 'BHR', '48', 'BH', 'Manama ', 'Middle East ', 'Bahraini', 'Bahrainis', 'Bahraini Dinar ', 'BHD', 645361, 'Bahrain', '', 'bahrain'),
(19, 'Baker Island', 'FQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Baker Island', 'ISO includes with the US Minor Outlying Islands', 'baker-island'),
(20, 'Bangladesh (বাংলাদেশ)', 'BG', 'BD', 'BGD', '50', 'BD', 'Dhaka ', 'Asia ', 'Bangladeshi', 'Bangladeshis', 'Taka ', 'BDT', 131269860, 'Bangladesh', '', 'bangladesh'),
(21, 'Barbados', 'BB', 'BB', 'BRB', '52', 'BB', 'Bridgetown ', 'Central America and the Caribbean ', 'Barbadian', 'Barbadians', 'Barbados Dollar', 'BBD', 275330, 'Barbados', '', 'barbados'),
(22, 'Bassas da India', 'BS', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Bassas da India', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'bassas-da-india'),
(23, 'Belarus (Белару́сь)', 'BO', 'BY', 'BLR', '112', 'BY', 'Minsk ', 'Commonwealth of Independent States ', 'Belarusian', 'Belarusians', 'Belarussian Ruble', 'BYR', 10350194, 'Belarus', '', 'belarus'),
(24, 'Belgium (België)', 'BE', 'BE', 'BEL', '56', 'BE', 'Brussels ', 'Europe ', 'Belgian', 'Belgians', 'Euro', 'EUR', 10258762, 'Belgium', '', 'belgium-belgi'),
(25, 'Belize', 'BH', 'BZ', 'BLZ', '84', 'BZ', 'Belmopan ', 'Central America and the Caribbean ', 'Belizean', 'Belizeans', 'Belize Dollar', 'BZD', 256062, 'Belize', '', 'belize'),
(26, 'Benin (Bénin)', 'BN', 'BJ', 'BEN', '204', 'BJ', 'Porto-Novo  ', 'Africa ', 'Beninese', 'Beninese', 'CFA Franc BCEAO', 'XOF', 6590782, 'Benin', '', 'benin-b-nin'),
(27, 'Bermuda', 'BD', 'BM', 'BMU', '60', 'BM', 'Hamilton ', 'North America ', 'Bermudian', 'Bermudians', 'Bermudian Dollar ', 'BMD', 63503, 'Bermuda', '', 'bermuda'),
(28, 'Bhutan (འབྲུག་ཡུལ)', 'BT', 'BT', 'BTN', '64', 'BT', 'Thimphu ', 'Asia ', 'Bhutanese', 'Bhutanese', 'Ngultrum', 'BTN', 2049412, 'Bhutan', '', 'bhutan'),
(29, 'Bolivia', 'BL', 'BO', 'BOL', '68', 'BO', 'La Paz /Sucre ', 'South America ', 'Bolivian', 'Bolivians', 'Boliviano ', 'BOB', 8300463, 'Bolivia', '', 'bolivia'),
(30, 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'BK', 'BA', 'BIH', '70', 'BA', 'Sarajevo ', 'Bosnia and Herzegovina, Europe ', 'Bosnian and Herzegovinian', 'Bosnians and Herzegovinians', 'Convertible Marka', 'BAM', 3922205, 'Bosnia and Herzegovina', '', 'bosnia-and-herzegovina-bosna-i-hercegovina'),
(31, 'Botswana', 'BC', 'BW', 'BWA', '72', 'BW', 'Gaborone ', 'Africa ', 'Motswana', 'Batswana', 'Pula ', 'BWP', 1586119, 'Botswana', '', 'botswana'),
(32, 'Bouvet Island', 'BV', 'BV', 'BVT', '74', 'BV', '', 'Antarctic Region ', '', '', 'Norwegian Krone ', 'NOK', 0, 'Bouvet Island', '', 'bouvet-island'),
(33, 'Brazil (Brasil)', 'BR', 'BR', 'BRA', '76', 'BR', 'Brasilia ', 'South America ', 'Brazilian', 'Brazilians', 'Brazilian Real ', 'BRL', 174468575, 'Brazil', '', 'brazil-brasil'),
(34, 'British Indian Ocean Territory', 'IO', 'IO', 'IOT', '86', 'IO', '', 'World ', '', '', 'US Dollar', 'USD', 0, 'The British Indian Ocean Territory', '', 'british-indian-ocean-territory'),
(35, 'Brunei (Brunei Darussalam)', 'BX', 'BN', 'BRN', '96', 'BN', '', '', '', '', 'Brunei Dollar', 'BND', 372361, 'Brunei', '', 'brunei-brunei-darussalam'),
(36, 'Bulgaria (България)', 'BU', 'BG', 'BGR', '100', 'BG', 'Sofia ', 'Europe ', 'Bulgarian', 'Bulgarians', 'Lev ', 'BGN', 7707495, 'Bulgaria', '', 'bulgaria'),
(37, 'Burkina Faso', 'UV', 'BF', 'BFA', '854', 'BF', 'Ouagadougou ', 'Africa ', 'Burkinabe', 'Burkinabe', 'CFA Franc BCEAO', 'XOF', 12272289, 'Burkina Faso', '', 'burkina-faso'),
(38, 'Burundi (Uburundi)', 'BY', 'BI', 'BDI', '108', 'BI', 'Bujumbura ', 'Africa ', 'Burundi', 'Burundians', 'Burundi Franc ', 'BIF', 6223897, 'Burundi', '', 'burundi-uburundi'),
(39, 'Cambodia (Kampuchea)', 'CB', 'KH', 'KHM', '116', 'KH', 'Phnom Penh ', 'Southeast Asia ', 'Cambodian', 'Cambodians', 'Riel ', 'KHR', 12491501, 'Cambodia', '', 'cambodia-kampuchea'),
(40, 'Cameroon (Cameroun)', 'CM', 'CM', 'CMR', '120', 'CM', 'Yaounde ', 'Africa ', 'Cameroonian', 'Cameroonians', 'CFA Franc BEAC', 'XAF', 15803220, 'Cameroon', '', 'cameroon-cameroun'),
(41, 'Canada', 'CA', 'CA', 'CAN', '124', 'CA', 'Ottawa ', 'North America ', 'Canadian', 'Canadians', 'Canadian Dollar ', 'CAD', 31592805, 'Canada', '', 'canada'),
(42, 'Cape Verde (Cabo Verde)', 'CV', 'CV', 'CPV', '132', 'CV', 'Praia ', 'World ', 'Cape Verdean', 'Cape Verdeans', 'Cape Verdean Escudo ', 'CVE', 405163, 'Cape Verde', '', 'cape-verde-cabo-verde'),
(43, 'Cayman Islands', 'CJ', 'KY', 'CYM', '136', 'KY', 'George Town ', 'Central America and the Caribbean ', 'Caymanian', 'Caymanians', 'Cayman Islands Dollar', 'KYD', 35527, 'The Cayman Islands', '', 'cayman-islands'),
(44, 'Central African Republic (République Centrafricain', 'CT', 'CF', 'CAF', '140', 'CF', 'Bangui ', 'Africa ', 'Central African', 'Central Africans', 'CFA Franc BEAC', 'XAF', 3576884, 'The Central African Republic', '', 'central-african-republic-r-publique-centrafricain'),
(45, 'Chad (Tchad)', 'CD', 'TD', 'TCD', '148', 'TD', 'N''Djamena ', 'Africa ', 'Chadian', 'Chadians', 'CFA Franc BEAC', 'XAF', 8707078, 'Chad', '', 'chad-tchad'),
(46, 'Chile', 'CI', 'CL', 'CHL', '152', 'CL', 'Santiago ', 'South America ', 'Chilean', 'Chileans', 'Chilean Peso ', 'CLP', 15328467, 'Chile', '', 'chile'),
(47, 'China (中国)', 'CH', 'CN', 'CHN', '156', 'CN', 'Beijing ', 'Asia ', 'Chinese', 'Chinese', 'Yuan Renminbi', 'CNY', 1273111290, 'China', 'see also Taiwan', 'china'),
(48, 'Christmas Island', 'KT', 'CX', 'CXR', '162', 'CX', 'The Settlement ', 'Southeast Asia ', 'Christmas Island', 'Christmas Islanders', 'Australian Dollar ', 'AUD', 2771, 'Christmas Island', '', 'christmas-island'),
(49, 'Clipperton Island', 'IP', '--', '-- ', '--', '--', '', 'World ', '', '', '', '', 0, 'Clipperton Island', 'ISO includes with French Polynesia', 'clipperton-island'),
(50, 'Cocos Islands', 'CK', 'CC', 'CCK', '166', 'CC', 'West Island ', 'Southeast Asia ', 'Cocos Islander', 'Cocos Islanders', 'Australian Dollar ', 'AUD', 633, 'The Cocos Islands', '', 'cocos-islands'),
(51, 'Colombia', 'CO', 'CO', 'COL', '170', 'CO', 'Bogota ', 'South America, Central America and the Caribbean ', 'Colombian', 'Colombians', 'Colombian Peso ', 'COP', 40349388, 'Colombia', '', 'colombia'),
(52, 'Comoros (Comores)', 'CN', 'KM', 'COM', '174', 'KM', 'Moroni ', 'Africa ', 'Comoran', 'Comorans', 'Comoro Franc', 'KMF', 596202, 'Comoros', '', 'comoros-comores'),
(53, 'Congo', 'CF', 'CG', 'COG', '178', 'CG', 'Brazzaville ', 'Africa ', 'Congolese', 'Congolese', 'CFA Franc BEAC', 'XAF', 2894336, 'Republic of the Congo', '', 'congo-1'),
(54, 'Congo, Democratic Republic of the', 'CG', 'CD', 'COD', '180', 'CD', 'Kinshasa ', 'Africa ', 'Congolese', 'Congolese', 'Franc Congolais', 'CDF', 53624718, 'Democratic Republic of the Congo', 'formerly Zaire', 'congo-democratic-republic-of-the'),
(55, 'Cook Islands', 'CW', 'CK', 'COK', '184', 'CK', 'Avarua ', 'Oceania ', 'Cook Islander', 'Cook Islanders', 'New Zealand Dollar ', 'NZD', 20611, 'The Cook Islands', '', 'cook-islands'),
(56, 'Coral Sea Islands', 'CR', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'The Coral Sea Islands', 'ISO includes with Australia', 'coral-sea-islands'),
(57, 'Costa Rica', 'CS', 'CR', 'CRI', '188', 'CR', 'San Jose ', 'Central America and the Caribbean ', 'Costa Rican', 'Costa Ricans', 'Costa Rican Colon', 'CRC', 3773057, 'Costa Rica', '', 'costa-rica'),
(58, 'Côte d&#39;Ivoire', 'IV', 'CI', 'CIV', '384', 'CI', 'Yamoussoukro', 'Africa ', 'Ivorian', 'Ivorians', 'CFA Franc BCEAO', 'XOF', 16393221, 'Cote d''Ivoire', '', 'c-te-d-39-ivoire'),
(59, 'Croatia (Hrvatska)', 'HR', 'HR', 'HRV', '191', 'HR', 'Zagreb ', 'Europe ', 'Croatian', 'Croats', 'Kuna', 'HRK', 4334142, 'Croatia', '', 'croatia-hrvatska'),
(60, 'Cuba', 'CU', 'CU', 'CUB', '192', 'CU', 'Havana ', 'Central America and the Caribbean ', 'Cuban', 'Cubans', 'Cuban Peso', 'CUP', 11184023, 'Cuba', '', 'cuba'),
(61, 'Cyprus (Κυπρος)', 'CY', 'CY', 'CYP', '196', 'CY', 'Nicosia ', 'Middle East ', 'Cypriot', 'Cypriots', 'Cyprus Pound', 'CYP', 762887, 'Cyprus', '', 'cyprus'),
(62, 'Czech Republic (Česko)', 'EZ', 'CZ', 'CZE', '203', 'CZ', 'Prague ', 'Europe ', 'Czech', 'Czechs', 'Czech Koruna', 'CZK', 10264212, 'The Czech Republic', '', 'czech-republic-esko'),
(63, 'Denmark (Danmark)', 'DA', 'DK', 'DNK', '208', 'DK', 'Copenhagen ', 'Europe ', 'Danish', 'Danes', 'Danish Krone', 'DKK', 5352815, 'Denmark', '', 'denmark-danmark'),
(64, 'Djibouti', 'DJ', 'DJ', 'DJI', '262', 'DJ', 'Djibouti ', 'Africa ', 'Djiboutian', 'Djiboutians', 'Djibouti Franc', 'DJF', 460700, 'Djibouti', '', 'djibouti'),
(65, 'Dominica', 'DO', 'DM', 'DMA', '212', 'DM', 'Roseau ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'East Caribbean Dollar', 'XCD', 70786, 'Dominica', '', 'dominica'),
(66, 'Dominican Republic', 'DR', 'DO', 'DOM', '214', 'DO', 'Santo Domingo ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'Dominican Peso', 'DOP', 8581477, 'The Dominican Republic', '', 'dominican-republic'),
(67, 'Ecuador', 'EC', 'EC', 'ECU', '218', 'EC', 'Quito ', 'South America ', 'Ecuadorian', 'Ecuadorians', 'US Dollar', 'USD', 13183978, 'Ecuador', '', 'ecuador'),
(68, 'Egypt (مصر)', 'EG', 'EG', 'EGY', '818', 'EG', 'Cairo ', 'Africa ', 'Egyptian', 'Egyptians', 'Egyptian Pound ', 'EGP', 69536644, 'Egypt', '', 'egypt'),
(69, 'El Salvador', 'ES', 'SV', 'SLV', '222', 'SV', 'San Salvador ', 'Central America and the Caribbean ', 'Salvadoran', 'Salvadorans', 'El Salvador Colon', 'SVC', 6237662, 'El Salvador', '', 'el-salvador'),
(70, 'Equatorial Guinea (Guinea Ecuatorial)', 'EK', 'GQ', 'GNQ', '226', 'GQ', 'Malabo ', 'Africa ', 'Equatorial Guinean', 'Equatorial Guineans', 'CFA Franc BEAC', 'XAF', 486060, 'Equatorial Guinea', '', 'equatorial-guinea-guinea-ecuatorial'),
(71, 'Eritrea (Ertra)', 'ER', 'ER', 'ERI', '232', 'ER', 'Asmara ', 'Africa ', 'Eritrean', 'Eritreans', 'Nakfa', 'ERN', 4298269, 'Eritrea', '', 'eritrea-ertra'),
(72, 'Estonia (Eesti)', 'EN', 'EE', 'EST', '233', 'EE', 'Tallinn ', 'Europe ', 'Estonian', 'Estonians', 'Kroon', 'EEK', 1423316, 'Estonia', '', 'estonia-eesti'),
(73, 'Ethiopia (Ityop&#39;iya)', 'ET', 'ET', 'ETH', '231', 'ET', 'Addis Ababa ', 'Africa ', 'Ethiopian', 'Ethiopians', 'Ethiopian Birr', 'ETB', 65891874, 'Ethiopia', '', 'ethiopia-ityop-39-iya'),
(74, 'Europa Island', 'EU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Europa Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'europa-island'),
(75, 'Falkland Islands', 'FK', 'FK', 'FLK', '238', 'FK', 'Stanley', 'South America', 'Falkland Island', 'Falkland Islanders', 'Falkland Islands Pound', 'FKP', 2895, 'The Falkland Islands ', '', 'falkland-islands'),
(76, 'Faroe Islands', 'FO', 'FO', 'FRO', '234', 'FO', 'Torshavn ', 'Europe ', 'Faroese', 'Faroese', 'Danish Krone ', 'DKK', 45661, 'The Faroe Islands', '', 'faroe-islands'),
(77, 'Fiji', 'FJ', 'FJ', 'FJI', '242', 'FJ', 'Suva ', 'Oceania ', 'Fijian', 'Fijians', 'Fijian Dollar ', 'FJD', 844330, 'Fiji', '', 'fiji'),
(78, 'Finland (Suomi)', 'FI', 'FI', 'FIN', '246', 'FI', 'Helsinki ', 'Europe ', 'Finnish', 'Finns', 'Euro', 'EUR', 5175783, 'Finland', '', 'finland-suomi'),
(79, 'France', 'FR', 'FR', 'FRA', '250', 'FR', 'Paris ', 'Europe ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 59551227, 'France', '', 'france'),
(80, 'France, Metropolitan', '--', '--', '-- ', '--', 'FX', '', '', '', '', 'Euro', 'EUR', 0, 'Metropolitan France', 'ISO limits to the European part of France, excluding French Guiana, French Polynesia, French Southern and Antarctic Lands, Guadeloupe, Martinique, Mayotte, New Caledonia, Reunion, Saint Pierre and Miquelon, Wallis and Futuna', 'france-metropolitan'),
(81, 'French Guiana', 'FG', 'GF', 'GUF', '254', 'GF', 'Cayenne ', 'South America ', 'French Guianese', 'French Guianese', 'Euro', 'EUR', 177562, 'French Guiana', '', 'french-guiana'),
(82, 'French Polynesia', 'FP', 'PF', 'PYF', '258', 'PF', 'Papeete ', 'Oceania ', 'French Polynesian', 'French Polynesians', 'CFP Franc', 'XPF', 253506, 'French Polynesia', 'ISO includes Clipperton Island', 'french-polynesia'),
(83, 'French Southern Territories', 'FS', 'TF', 'ATF', '260', 'TF', '', 'Antarctic Region ', '', '', 'Euro', 'EUR', 0, 'The French Southern and Antarctic Lands', 'FIPS 10-4 does not include the French-claimed portion of Antarctica (Terre Adelie)', 'french-southern-territories'),
(84, 'Gabon', 'GB', 'GA', 'GAB', '266', 'GA', 'Libreville ', 'Africa ', 'Gabonese', 'Gabonese', 'CFA Franc BEAC', 'XAF', 1221175, 'Gabon', '', 'gabon'),
(85, 'Gambia', 'GA', 'GM', 'GMB', '270', 'GM', 'Banjul ', 'Africa ', 'Gambian', 'Gambians', 'Dalasi', 'GMD', 1411205, 'The Gambia', '', 'gambia'),
(86, 'Gaza Strip', 'GZ', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel ', 'ILS', 1178119, 'The Gaza Strip', '', 'gaza-strip'),
(87, 'Georgia (საქართველო)', 'GG', 'GE', 'GEO', '268', 'GE', 'T''bilisi ', 'Commonwealth of Independent States ', 'Georgian', 'Georgians', 'Lari', 'GEL', 4989285, 'Georgia', '', 'georgia'),
(88, 'Germany (Deutschland)', 'GM', 'DE', 'DEU', '276', 'DE', 'Berlin ', 'Europe ', 'German', 'Germans', 'Euro', 'EUR', 83029536, 'Deutschland', '', 'germany-deutschland'),
(89, 'Ghana', 'GH', 'GH', 'GHA', '288', 'GH', 'Accra ', 'Africa ', 'Ghanaian', 'Ghanaians', 'Cedi', 'GHC', 19894014, 'Ghana', '', 'ghana'),
(90, 'Gibraltar', 'GI', 'GI', 'GIB', '292', 'GI', 'Gibraltar ', 'Europe ', 'Gibraltar', 'Gibraltarians', 'Gibraltar Pound', 'GIP', 27649, 'Gibraltar', '', 'gibraltar'),
(91, 'Glorioso Islands', 'GO', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'The Glorioso Islands', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'glorioso-islands'),
(92, 'Greece (Ελλάς)', 'GR', 'GR', 'GRC', '300', 'GR', 'Athens ', 'Europe ', 'Greek', 'Greeks', 'Euro', 'EUR', 10623835, 'Greece', '', 'greece'),
(93, 'Greenland', 'GL', 'GL', 'GRL', '304', 'GL', 'Nuuk ', 'Arctic Region ', 'Greenlandic', 'Greenlanders', 'Danish Krone', 'DKK', 56352, 'Greenland', '', 'greenland'),
(94, 'Grenada', 'GJ', 'GD', 'GRD', '308', 'GD', 'Saint George''s ', 'Central America and the Caribbean ', 'Grenadian', 'Grenadians', 'East Caribbean Dollar', 'XCD', 89227, 'Grenada', '', 'grenada'),
(95, 'Guadeloupe', 'GP', 'GP', 'GLP', '312', 'GP', 'Basse-Terre ', 'Central America and the Caribbean ', 'Guadeloupe', 'Guadeloupians', 'Euro', 'EUR', 431170, 'Guadeloupe', '', 'guadeloupe'),
(96, 'Guam', 'GQ', 'GU', 'GUM', '316', 'GU', 'Hagatna', 'Oceania ', 'Guamanian', 'Guamanians', 'US Dollar', 'USD', 157557, 'Guam', '', 'guam'),
(97, 'Guatemala', 'GT', 'GT', 'GTM', '320', 'GT', 'Guatemala ', 'Central America and the Caribbean ', 'Guatemalan', 'Guatemalans', 'Quetzal', 'GTQ', 12974361, 'Guatemala', '', 'guatemala'),
(98, 'Guernsey', 'GK', '--', '-- ', '--', 'GG', 'Saint Peter Port ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 64342, 'Guernsey', 'ISO includes with the United Kingdom', 'guernsey'),
(99, 'Guinea (Guinée)', 'GV', 'GN', 'GIN', '324', 'GN', 'Conakry ', 'Africa ', 'Guinean', 'Guineans', 'Guinean Franc ', 'GNF', 7613870, 'Guinea', '', 'guinea-guin-e'),
(100, 'Guinea-Bissau (Guiné-Bissau)', 'PU', 'GW', 'GNB', '624', 'GW', 'Bissau ', 'Africa ', 'Guinean', 'Guineans', 'CFA Franc BCEAO', 'XOF', 1315822, 'Guinea-Bissau', '', 'guinea-bissau-guin-bissau'),
(101, 'Guyana', 'GY', 'GY', 'GUY', '328', 'GY', 'Georgetown ', 'South America ', 'Guyanese', 'Guyanese', 'Guyana Dollar', 'GYD', 697181, 'Guyana', '', 'guyana'),
(102, 'Haiti (Haïti)', 'HA', 'HT', 'HTI', '332', 'HT', 'Port-au-Prince ', 'Central America and the Caribbean ', 'Haitian', 'Haitians', 'Gourde', 'HTG', 6964549, 'Haiti', '', 'haiti-ha-ti'),
(103, 'Heard Island and McDonald Islands', 'HM', 'HM', 'HMD', '334', 'HM', '', 'Antarctic Region ', '', '', 'Australian Dollar', 'AUD', 0, 'The Heard Island and McDonald Islands', '', 'heard-island-and-mcdonald-islands'),
(104, 'Honduras', 'HO', 'HN', 'HND', '340', 'HN', 'Tegucigalpa ', 'Central America and the Caribbean ', 'Honduran', 'Hondurans', 'Lempira', 'HNL', 6406052, 'Honduras', '', 'honduras'),
(105, 'Hong Kong', 'HK', 'HK', 'HKG', '344', 'HK', '', 'Southeast Asia ', '', '', 'Hong Kong Dollar ', 'HKD', 0, 'Xianggang ', '', 'hong-kong'),
(106, 'Howland Island', 'HQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 7210505, 'Howland Island', 'ISO includes with the US Minor Outlying Islands', 'howland-island'),
(107, 'Hungary (Magyarország)', 'HU', 'HU', 'HUN', '348', 'HU', 'Budapest ', 'Europe ', 'Hungarian', 'Hungarians', 'Forint', 'HUF', 10106017, 'Hungary', '', 'hungary-magyarorsz-g'),
(108, 'Iceland (Ísland)', 'IC', 'IS', 'ISL', '352', 'IS', 'Reykjavik ', 'Arctic Region ', 'Icelandic', 'Icelanders', 'Iceland Krona', 'ISK', 277906, 'Iceland', '', 'iceland-sland'),
(109, 'India', 'IN', 'IN', 'IND', '356', 'IN', 'New Delhi ', 'Asia ', 'Indian', 'Indians', 'Indian Rupee ', 'INR', 1029991145, 'India', '', 'india'),
(110, 'Indonesia', 'ID', 'ID', 'IDN', '360', 'ID', 'Jakarta ', 'Southeast Asia ', 'Indonesian', 'Indonesians', 'Rupiah', 'IDR', 228437870, 'Indonesia', '', 'indonesia'),
(111, 'Iran (ایران)', 'IR', 'IR', 'IRN', '364', 'IR', 'Tehran ', 'Middle East ', 'Iranian', 'Iranians', 'Iranian Rial', 'IRR', 66128965, 'Iran', '', 'iran'),
(112, 'Iraq (العراق)', 'IZ', 'IQ', 'IRQ', '368', 'IQ', 'Baghdad ', 'Middle East ', 'Iraqi', 'Iraqis', 'Iraqi Dinar', 'IQD', 23331985, 'Iraq', '', 'iraq'),
(113, 'Ireland', 'EI', 'IE', 'IRL', '372', 'IE', 'Dublin ', 'Europe ', 'Irish', 'Irishmen', 'Euro', 'EUR', 3840838, 'Ireland', '', 'ireland'),
(114, 'Israel (ישראל)', 'IS', 'IL', 'ISR', '376', 'IL', 'Jerusalem', 'Middle East ', 'Israeli', 'Israelis', 'New Israeli Sheqel', 'ILS', 5938093, 'Israel', '', 'israel'),
(115, 'Italy (Italia)', 'IT', 'IT', 'ITA', '380', 'IT', 'Rome ', 'Europe ', 'Italian', 'Italians', 'Euro', 'EUR', 57679825, 'Italia ', '', 'italy-italia'),
(116, 'Jamaica', 'JM', 'JM', 'JAM', '388', 'JM', 'Kingston ', 'Central America and the Caribbean ', 'Jamaican', 'Jamaicans', 'Jamaican dollar ', 'JMD', 2665636, 'Jamaica', '', 'jamaica'),
(117, 'Jan Mayen', 'JN', '--', '-- ', '--', '--', '', 'Arctic Region ', '', '', 'Norway Kroner', 'NOK', 0, 'Jan Mayen', 'ISO includes with Svalbard', 'jan-mayen'),
(118, 'Japan (日本)', 'JA', 'JP', 'JPN', '392', 'JP', 'Tokyo ', 'Asia ', 'Japanese', 'Japanese', 'Yen ', 'JPY', 126771662, 'Japan', '', 'japan'),
(119, 'Jarvis Island', 'DQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Jarvis Island', 'ISO includes with the US Minor Outlying Islands', 'jarvis-island'),
(120, 'Jersey', 'JE', '--', '-- ', '--', 'JE', 'Saint Helier ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 89361, 'Jersey', 'ISO includes with the United Kingdom', 'jersey'),
(121, 'Johnston Atoll', 'JQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Johnston Atoll', 'ISO includes with the US Minor Outlying Islands', 'johnston-atoll'),
(122, 'Jordan (الاردن)', 'JO', 'JO', 'JOR', '400', 'JO', 'Amman ', 'Middle East ', 'Jordanian', 'Jordanians', 'Jordanian Dinar', 'JOD', 5153378, 'Jordan', '', 'jordan'),
(123, 'Juan de Nova Island', 'JU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Juan de Nova Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'juan-de-nova-island'),
(124, 'Kazakhstan (Қазақстан)', 'KZ', 'KZ', 'KAZ', '398', 'KZ', 'Astana ', 'Commonwealth of Independent States ', 'Kazakhstani', 'Kazakhstanis', 'Tenge', 'KZT', 16731303, 'Kazakhstan', '', 'kazakhstan'),
(125, 'Kenya', 'KE', 'KE', 'KEN', '404', 'KE', 'Nairobi ', 'Africa ', 'Kenyan', 'Kenyans', 'Kenyan shilling ', 'KES', 30765916, 'Kenya', '', 'kenya'),
(126, 'Kingman Reef', 'KQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Kingman Reef', 'ISO includes with the US Minor Outlying Islands', 'kingman-reef'),
(127, 'Kiribati', 'KR', 'KI', 'KIR', '296', 'KI', 'Tarawa ', 'Oceania ', 'I-Kiribati', 'I-Kiribati', 'Australian dollar ', 'AUD', 94149, 'Kiribati', '', 'kiribati'),
(128, 'Kuwait (الكويت)', 'KU', 'KW', 'KWT', '414', 'KW', 'Kuwait ', 'Middle East ', 'Kuwaiti', 'Kuwaitis', 'Kuwaiti Dinar', 'KWD', 2041961, 'Al Kuwayt', '', 'kuwait'),
(129, 'Kyrgyzstan (Кыргызстан)', 'KG', 'KG', 'KGZ', '417', 'KG', 'Bishkek ', 'Commonwealth of Independent States ', 'Kyrgyzstani', 'Kyrgyzstanis', 'Som', 'KGS', 4753003, 'Kyrgyzstan', '', 'kyrgyzstan'),
(130, 'Laos (ນລາວ)', 'LA', 'LA', 'LAO', '418', 'LA', 'Vientiane ', 'Southeast Asia ', 'Lao', 'Laos', 'Kip', 'LAK', 5635967, 'Laos', '', 'laos'),
(131, 'Latvia (Latvija)', 'LG', 'LV', 'LVA', '428', 'LV', 'Riga ', 'Europe ', 'Latvian', 'Latvians', 'Latvian Lats', 'LVL', 2385231, 'Latvia', '', 'latvia-latvija'),
(132, 'Lebanon (لبنان)', 'LE', 'LB', 'LBN', '422', 'LB', 'Beirut ', 'Middle East ', 'Lebanese', 'Lebanese', 'Lebanese Pound', 'LBP', 3627774, 'Lebanon', '', 'lebanon'),
(133, 'Lesotho', 'LT', 'LS', 'LSO', '426', 'LS', 'Maseru ', 'Africa ', 'Basotho', 'Mosotho', 'Loti', 'LSL', 2177062, 'Lesotho', '', 'lesotho'),
(134, 'Liberia', 'LI', 'LR', 'LBR', '430', 'LR', 'Monrovia ', 'Africa ', 'Liberian', 'Liberians', 'Liberian Dollar', 'LRD', 3225837, 'Liberia', '', 'liberia'),
(135, 'Libya (ليبيا)', 'LY', 'LY', 'LBY', '434', 'LY', 'Tripoli ', 'Africa ', 'Libyan', 'Libyans', 'Libyan Dinar', 'LYD', 5240599, 'Libya', '', 'libya'),
(136, 'Liechtenstein', 'LS', 'LI', 'LIE', '438', 'LI', 'Vaduz ', 'Europe ', 'Liechtenstein', 'Liechtensteiners', 'Swiss Franc', 'CHF', 32528, 'Liechtenstein', '', 'liechtenstein'),
(137, 'Lithuania (Lietuva)', 'LH', 'LT', 'LTU', '440', 'LT', 'Vilnius ', 'Europe ', 'Lithuanian', 'Lithuanians', 'Lithuanian Litas', 'LTL', 3610535, 'Lithuania', '', 'lithuania-lietuva'),
(138, 'Luxembourg (Lëtzebuerg)', 'LU', 'LU', 'LUX', '442', 'LU', 'Luxembourg ', 'Europe ', 'Luxembourg', 'Luxembourgers', 'Euro', 'EUR', 442972, 'Luxembourg', '', 'luxembourg-l-tzebuerg'),
(139, 'Macao', 'MC', 'MO', 'MAC', '446', 'MO', '', 'Southeast Asia ', 'Chinese', 'Chinese', 'Pataca', 'MOP', 453733, 'Macao', '', 'macao'),
(140, 'Macedonia (Македонија)', 'MK', 'MK', 'MKD', '807', 'MK', 'Skopje ', 'Europe ', 'Macedonian', 'Macedonians', 'Denar', 'MKD', 2046209, 'Makedonija', '', 'macedonia'),
(141, 'Madagascar (Madagasikara)', 'MA', 'MG', 'MDG', '450', 'MG', 'Antananarivo ', 'Africa ', 'Malagasy', 'Malagasy', 'Malagasy Franc', 'MGF', 15982563, 'Madagascar', '', 'madagascar-madagasikara'),
(142, 'Malawi', 'MI', 'MW', 'MWI', '454', 'MW', 'Lilongwe ', 'Africa ', 'Malawian', 'Malawians', 'Kwacha', 'MWK', 10548250, 'Malawi', '', 'malawi'),
(143, 'Malaysia', 'MY', 'MY', 'MYS', '458', 'MY', 'Kuala Lumpur ', 'Southeast Asia ', 'Malaysian', 'Malaysians', 'Malaysian Ringgit', 'MYR', 22229040, 'Malaysia', '', 'malaysia'),
(144, 'Maldives (ގުޖޭއްރާ ޔާއްރިހޫމްޖ)', 'MV', 'MV', 'MDV', '462', 'MV', 'Male ', 'Asia ', 'Maldivian', 'Maldivians', 'Rufiyaa', 'MVR', 310764, 'Maldives', '', 'maldives'),
(145, 'Mali', 'ML', 'ML', 'MLI', '466', 'ML', 'Bamako ', 'Africa ', 'Malian', 'Malians', 'CFA Franc BCEAO', 'XOF', 11008518, 'Mali', '', 'mali'),
(146, 'Malta', 'MT', 'MT', 'MLT', '470', 'MT', 'Valletta ', 'Europe ', 'Maltese', 'Maltese', 'Maltese Lira', 'MTL', 394583, 'Malta', '', 'malta'),
(147, 'Man, Isle of', 'IM', '--', '-- ', '--', 'IM', 'Douglas ', 'Europe ', 'Manxman', 'Manxmen', 'Pound Sterling', 'GBP', 73489, 'The Isle of Man', 'ISO includes with the United Kingdom', 'man-isle-of'),
(148, 'Marshall Islands', 'RM', 'MH', 'MHL', '584', 'MH', 'Majuro ', 'Oceania ', 'Marshallese', 'Marshallese', 'US Dollar', 'USD', 70822, 'The Marshall Islands', '', 'marshall-islands'),
(149, 'Martinique', 'MB', 'MQ', 'MTQ', '474', 'MQ', 'Fort-de-France ', 'Central America and the Caribbean ', 'Martiniquais', 'Martiniquais', 'Euro', 'EUR', 418454, 'Martinique', '', 'martinique'),
(150, 'Mauritania (موريتانيا)', 'MR', 'MR', 'MRT', '478', 'MR', 'Nouakchott ', 'Africa ', 'Mauritanian', 'Mauritanians', 'Ouguiya', 'MRO', 2747312, 'Mauritania', '', 'mauritania'),
(151, 'Mauritius', 'MP', 'MU', 'MUS', '480', 'MU', 'Port Louis ', 'World ', 'Mauritian', 'Mauritians', 'Mauritius Rupee', 'MUR', 1189825, 'Mauritius', '', 'mauritius'),
(152, 'Mayotte', 'MF', 'YT', 'MYT', '175', 'YT', 'Mamoutzou ', 'Africa ', 'Mahorais', 'Mahorais', 'Euro', 'EUR', 163366, 'Mayotte', '', 'mayotte'),
(153, 'Mexico (México)', 'MX', 'MX', 'MEX', '484', 'MX', 'Mexico ', 'North America ', 'Mexican', 'Mexicans', 'Mexican Peso', 'MXN', 101879171, 'Mexico', '', 'mexico-m-xico'),
(154, 'Micronesia', 'FM', 'FM', 'FSM', '583', 'FM', 'Palikir ', 'Oceania ', 'Micronesian', 'Micronesians', 'US Dollar', 'USD', 134597, 'The Federated States of Micronesia', '', 'micronesia'),
(155, 'Midway Islands', 'MQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'United States Dollars', 'USD', 0, 'The Midway Islands', 'ISO includes with the US Minor Outlying Islands', 'midway-islands'),
(156, 'Miscellaneous (French)', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Miscellaneous (French)', 'ISO includes Bassas da India, Europa Island, Glorioso Islands, Juan de Nova Island, Tromelin Island', 'miscellaneous-french'),
(157, 'Moldova', 'MD', 'MD', 'MDA', '498', 'MD', 'Chisinau ', 'Commonwealth of Independent States ', 'Moldovan', 'Moldovans', 'Moldovan Leu', 'MDL', 4431570, 'Moldova', '', 'moldova'),
(158, 'Monaco', 'MN', 'MC', 'MCO', '492', 'MC', 'Monaco ', 'Europe ', 'Monegasque', 'Monegasques', 'Euro', 'EUR', 31842, 'Monaco', '', 'monaco'),
(159, 'Mongolia (Монгол Улс)', 'MG', 'MN', 'MNG', '496', 'MN', 'Ulaanbaatar ', 'Asia ', 'Mongolian', 'Mongolians', 'Tugrik', 'MNT', 2654999, 'Mongolia', '', 'mongolia'),
(160, 'Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Montenegro', 'now included as region within Yugoslavia', 'montenegro'),
(161, 'Montserrat', 'MH', 'MS', 'MSR', '500', 'MS', 'Plymouth', 'Central America and the Caribbean ', 'Montserratian', 'Montserratians', 'East Caribbean Dollar', 'XCD', 7574, 'Montserrat', '', 'montserrat'),
(162, 'Morocco (المغرب)', 'MO', 'MA', 'MAR', '504', 'MA', 'Rabat ', 'Africa ', 'Moroccan', 'Moroccans', 'Moroccan Dirham', 'MAD', 30645305, 'Morocco', '', 'morocco'),
(163, 'Mozambique (Moçambique)', 'MZ', 'MZ', 'MOZ', '508', 'MZ', 'Maputo ', 'Africa ', 'Mozambican', 'Mozambicans', 'Metical', 'MZM', 19371057, 'Mozambique', '', 'mozambique-mo-ambique'),
(164, 'Myanmar', '--', '--', '-- ', '--', '--', '', '', '', '', 'Kyat', 'MMK', 0, 'Myanmar', 'see Burma', 'myanmar-1'),
(165, 'Myanmar (Burma)', 'BM', 'MM', 'MMR', '104', 'MM', 'Rangoon ', 'Southeast Asia ', 'Burmese', 'Burmese', 'kyat ', 'MMK', 41994678, 'Burma', 'ISO uses the name Myanmar', 'myanmar-burma'),
(166, 'Namibia', 'WA', 'NA', 'NAM', '516', 'NA', 'Windhoek ', 'Africa ', 'Namibian', 'Namibians', 'Namibian Dollar ', 'NAD', 1797677, 'Namibia', '', 'namibia'),
(167, 'Nauru (Naoero)', 'NR', 'NR', 'NRU', '520', 'NR', '', 'Oceania ', 'Nauruan', 'Nauruans', 'Australian Dollar', 'AUD', 12088, 'Nauru', '', 'nauru-naoero'),
(168, 'Navassa Island', 'BQ', '--', '-- ', '--', '--', '', 'Central America and the Caribbean ', '', '', '', '', 0, 'Navassa Island', '', 'navassa-island'),
(169, 'Nepal (नेपाल)', 'NP', 'NP', 'NPL', '524', 'NP', 'Kathmandu ', 'Asia ', 'Nepalese', 'Nepalese', 'Nepalese Rupee', 'NPR', 25284463, 'Nepal', '', 'nepal'),
(170, 'Netherlands (Nederland)', 'NL', 'NL', 'NLD', '528', 'NL', 'Amsterdam ', 'Europe ', 'Dutchman', 'Dutchmen', 'Euro', 'EUR', 15981472, 'The Netherlands', '', 'netherlands-nederland'),
(171, 'Netherlands Antilles', 'NT', 'AN', 'ANT', '530', 'AN', 'Willemstad ', 'Central America and the Caribbean ', 'Dutch Antillean', 'Dutch Antilleans', 'Netherlands Antillean guilder ', 'ANG', 212226, 'The Netherlands Antilles', '', 'netherlands-antilles'),
(172, 'New Caledonia', 'NC', 'NC', 'NCL', '540', 'NC', 'Noumea ', 'Oceania ', 'New Caledonian', 'New Caledonians', 'CFP Franc', 'XPF', 204863, 'New Caledonia', '', 'new-caledonia'),
(173, 'New Zealand', 'NZ', 'NZ', 'NZL', '554', 'NZ', 'Wellington ', 'Oceania ', 'New Zealand', 'New Zealanders', 'New Zealand Dollar', 'NZD', 3864129, 'New Zealand', '', 'new-zealand'),
(174, 'Nicaragua', 'NU', 'NI', 'NIC', '558', 'NI', 'Managua ', 'Central America and the Caribbean ', 'Nicaraguan', 'Nicaraguans', 'Cordoba Oro', 'NIO', 4918393, 'Nicaragua', '', 'nicaragua'),
(175, 'Niger', 'NG', 'NE', 'NER', '562', 'NE', 'Niamey ', 'Africa ', 'Nigerien', 'Nigeriens', 'CFA Franc BCEAO', 'XOF', 10355156, 'Niger', '', 'niger'),
(176, 'Nigeria', 'NI', 'NG', 'NGA', '566', 'NG', 'Abuja', 'Africa ', 'Nigerian', 'Nigerians', 'Naira', 'NGN', 126635626, 'Nigeria', '', 'nigeria'),
(177, 'Niue', 'NE', 'NU', 'NIU', '570', 'NU', 'Alofi ', 'Oceania ', 'Niuean', 'Niueans', 'New Zealand Dollar', 'NZD', 2124, 'Niue', '', 'niue'),
(178, 'Norfolk Island', 'NF', 'NF', 'NFK', '574', 'NF', 'Kingston ', 'Oceania ', 'Norfolk Islander', 'Norfolk Islanders', 'Australian Dollar', 'AUD', 1879, 'Norfolk Island', '', 'norfolk-island'),
(179, 'North Korea (조선)', 'KN', 'KP', 'PRK', '408', 'KP', 'P''yongyang ', 'Asia ', 'Korean', 'Koreans', 'North Korean Won', 'KPW', 21968228, 'North Korea', '', 'north-korea'),
(180, 'Northern Mariana Islands', 'CQ', 'MP', 'MNP', '580', 'MP', 'Saipan ', 'Oceania ', '', '', 'US Dollar', 'USD', 74612, 'The Northern Mariana Islands', '', 'northern-mariana-islands'),
(181, 'Norway (Norge)', 'NO', 'NO', 'NOR', '578', 'NO', 'Oslo ', 'Europe ', 'Norwegian', 'Norwegians', 'Norwegian Krone', 'NOK', 4503440, 'Norway', '', 'norway-norge'),
(182, 'Oman (عمان)', 'MU', 'OM', 'OMN', '512', 'OM', 'Muscat ', 'Middle East ', 'Omani', 'Omanis', 'Rial Omani', 'OMR', 2622198, 'Oman', '', 'oman'),
(183, 'Pakistan (پاکستان)', 'PK', 'PK', 'PAK', '586', 'PK', 'Islamabad ', 'Asia ', 'Pakistani', 'Pakistanis', 'Pakistan Rupee', 'PKR', 144616639, 'Pakistan', '', 'pakistan'),
(184, 'Palau (Belau)', 'PS', 'PW', 'PLW', '585', 'PW', 'Koror ', 'Oceania ', 'Palauan', 'Palauans', 'US Dollar', 'USD', 19092, 'Palau', '', 'palau-belau'),
(185, 'Palestinian Territories', '--', 'PS', 'PSE', '275', 'PS', '', '', '', '', '', '', 0, 'Palestine', 'NULL', 'palestinian-territories'),
(186, 'Palmyra Atoll', 'LQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Palmyra Atoll', 'ISO includes with the US Minor Outlying Islands', 'palmyra-atoll'),
(187, 'Panama (Panamá)', 'PM', 'PA', 'PAN', '591', 'PA', 'Panama ', 'Central America and the Caribbean ', 'Panamanian', 'Panamanians', 'balboa ', 'PAB', 2845647, 'Panama', '', 'panama-panam'),
(188, 'Papua New Guinea', 'PP', 'PG', 'PNG', '598', 'PG', 'Port Moresby ', 'Oceania ', 'Papua New Guinean', 'Papua New Guineans', 'Kina', 'PGK', 5049055, 'Papua New Guinea', '', 'papua-new-guinea'),
(189, 'Paracel Islands', 'PF', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Paracel Islands', '', 'paracel-islands'),
(190, 'Paraguay', 'PA', 'PY', 'PRY', '600', 'PY', 'Asuncion ', 'South America ', 'Paraguayan', 'Paraguayans', 'Guarani', 'PYG', 5734139, 'Paraguay', '', 'paraguay'),
(191, 'Peru (Perú)', 'PE', 'PE', 'PER', '604', 'PE', 'Lima ', 'South America ', 'Peruvian', 'Peruvians', 'Nuevo Sol', 'PEN', 27483864, 'Peru', '', 'peru-per'),
(192, 'Philippines (Pilipinas)', 'RP', 'PH', 'PHL', '608', 'PH', 'Manila ', 'Southeast Asia ', 'Philippine', 'Filipinos', 'Philippine Peso', 'PHP', 82841518, 'The Philippines', '', 'philippines-pilipinas'),
(193, 'Pitcairn', 'PC', 'PN', 'PCN', '612', 'PN', 'Adamstown ', 'Oceania ', 'Pitcairn Islander', 'Pitcairn Islanders', 'New Zealand Dollar', 'NZD', 47, 'The Pitcairn Islands', '', 'pitcairn'),
(194, 'Poland (Polska)', 'PL', 'PL', 'POL', '616', 'PL', 'Warsaw ', 'Europe ', 'Polish', 'Poles', 'Zloty', 'PLN', 38633912, 'Poland', '', 'poland-polska'),
(195, 'Portugal', 'PO', 'PT', 'PRT', '620', 'PT', 'Lisbon ', 'Europe ', 'Portuguese', 'Portuguese', 'Euro', 'EUR', 10066253, 'Portugal', '', 'portugal'),
(196, 'Puerto Rico', 'RQ', 'PR', 'PRI', '630', 'PR', 'San Juan ', 'Central America and the Caribbean ', 'Puerto Rican', 'Puerto Ricans', 'US Dollar', 'USD', 3937316, 'Puerto Rico', '', 'puerto-rico'),
(197, 'Qatar (قطر)', 'QA', 'QA', 'QAT', '634', 'QA', 'Doha ', 'Middle East ', 'Qatari', 'Qataris', 'Qatari Rial', 'QAR', 769152, 'Qatar', '', 'qatar'),
(198, 'Reunion', 'RE', 'RE', 'REU', '638', 'RE', 'Saint-Denis', 'World', 'Reunionese', 'Reunionese', 'Euro', 'EUR', 732570, 'Réunion', '', 'reunion'),
(199, 'Romania (România)', 'RO', 'RO', 'ROU', '642', 'RO', 'Bucharest ', 'Europe ', 'Romanian', 'Romanians', 'Leu', 'ROL', 22364022, 'Romania', '', 'romania-rom-nia'),
(200, 'Russia (Россия)', 'RS', 'RU', 'RUS', '643', 'RU', 'Moscow ', 'Asia ', 'Russian', 'Russians', 'Russian Ruble', 'RUB', 145470197, 'Russia', '', 'russia'),
(201, 'Rwanda', 'RW', 'RW', 'RWA', '646', 'RW', 'Kigali ', 'Africa ', 'Rwandan', 'Rwandans', 'Rwanda Franc', 'RWF', 7312756, 'Rwanda', '', 'rwanda'),
(202, 'Saint Helena', 'SH', 'SH', 'SHN', '654', 'SH', 'Jamestown ', 'Africa ', 'Saint Helenian', 'Saint Helenians', 'Saint Helenian Pound ', 'SHP', 7266, 'Saint Helena', '', 'saint-helena'),
(203, 'Saint Kitts and Nevis', 'SC', 'KN', 'KNA', '659', 'KN', 'Basseterre ', 'Central America and the Caribbean ', 'Kittitian and Nevisian', 'Kittitians and Nevisians', 'East Caribbean Dollar ', 'XCD', 38756, 'Saint Kitts and Nevis', '', 'saint-kitts-and-nevis'),
(204, 'Saint Lucia', 'ST', 'LC', 'LCA', '662', 'LC', 'Castries ', 'Central America and the Caribbean ', 'Saint Lucian', 'Saint Lucians', 'East Caribbean Dollar ', 'XCD', 158178, 'Saint Lucia', '', 'saint-lucia'),
(205, 'Saint Pierre and Miquelon', 'SB', 'PM', 'SPM', '666', 'PM', 'Saint-Pierre ', 'North America ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 6928, 'Saint Pierre and Miquelon', '', 'saint-pierre-and-miquelon'),
(206, 'Saint Vincent and the Grenadines', 'VC', 'VC', 'VCT', '670', 'VC', 'Kingstown ', 'Central America and the Caribbean ', 'Saint Vincentian', 'Saint Vincentians', 'East Caribbean Dollar ', 'XCD', 115942, 'Saint Vincent and the Grenadines', '', 'saint-vincent-and-the-grenadines'),
(207, 'Samoa', 'WS', 'WS', 'WSM', '882', 'WS', 'Apia ', 'Oceania ', 'Samoan', 'Samoans', 'Tala', 'WST', 179058, 'Samoa', 'NULL', 'samoa'),
(208, 'San Marino', 'SM', 'SM', 'SMR', '674', 'SM', 'San Marino ', 'Europe ', 'Sammarinese', 'Sammarinese', 'Euro', 'EUR', 27336, 'San Marino', '', 'san-marino'),
(209, 'São Tomé and Príncipe', 'TP', 'ST', 'STP', '678', 'ST', 'Sao Tome', 'Africa', 'Sao Tomean', 'Sao Tomeans', 'Dobra', 'STD', 165034, 'São Tomé and Príncipe', '', 's-o-tom-and-pr-ncipe'),
(210, 'Saudi Arabia (المملكة العربية السعودية)', 'SA', 'SA', 'SAU', '682', 'SA', 'Riyadh ', 'Middle East ', 'Saudi Arabian ', 'Saudis', 'Saudi Riyal', 'SAR', 22757092, 'Saudi Arabia', '', 'saudi-arabia'),
(211, 'Senegal (Sénégal)', 'SG', 'SN', 'SEN', '686', 'SN', 'Dakar ', 'Africa ', 'Senegalese', 'Senegalese', 'CFA Franc BCEAO', 'XOF', 10284929, 'Senegal', '', 'senegal-s-n-gal'),
(212, 'Serbia', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia', 'now included as region within Yugoslavia', 'serbia'),
(213, 'Serbia and Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia and Montenegro', 'See Yugoslavia', 'serbia-and-montenegro'),
(214, 'Seychelles', 'SE', 'SC', 'SYC', '690', 'SC', 'Victoria ', 'Africa ', 'Seychellois', 'Seychellois', 'Seychelles Rupee', 'SCR', 79715, 'Seychelles', '', 'seychelles'),
(215, 'Sierra Leone', 'SL', 'SL', 'SLE', '694', 'SL', 'Freetown ', 'Africa ', 'Sierra Leonean', 'Sierra Leoneans', 'Leone', 'SLL', 5426618, 'Sierra Leone', '', 'sierra-leone'),
(216, 'Singapore (Singapura)', 'SN', 'SG', 'SGP', '702', 'SG', 'Singapore ', 'Southeast Asia ', 'Singaporeian', 'Singaporeans', 'Singapore Dollar', 'SGD', 4300419, 'Singapore', '', 'singapore-singapura'),
(217, 'Slovakia (Slovensko)', 'LO', 'SK', 'SVK', '703', 'SK', 'Bratislava ', 'Europe ', 'Slovakian', 'Slovaks', 'Slovak Koruna', 'SKK', 5414937, 'Slovakia', '', 'slovakia-slovensko'),
(218, 'Slovenia (Slovenija)', 'SI', 'SI', 'SVN', '705', 'SI', 'Ljubljana ', 'Europe ', 'Slovenian', 'Slovenes', 'Euro', 'EUR', 1930132, 'Slovenia', '', 'slovenia-slovenija'),
(219, 'Solomon Islands', 'BP', 'SB', 'SLB', '90', 'SB', 'Honiara ', 'Oceania ', 'Solomon Islander', 'Solomon Islanders', 'Solomon Islands Dollar', 'SBD', 480442, 'The Solomon Islands', '', 'solomon-islands'),
(220, 'Somalia (Soomaaliya)', 'SO', 'SO', 'SOM', '706', 'SO', 'Mogadishu ', 'Africa ', 'Somali', 'Somalis', 'Somali Shilling', 'SOS', 7488773, 'Somalia', '', 'somalia-soomaaliya'),
(221, 'South Africa', 'SF', 'ZA', 'ZAF', '710', 'ZA', 'Pretoria', 'Africa ', 'South African', 'South Africans', 'Rand', 'ZAR', 43586097, 'South Africa', '', 'south-africa'),
(222, 'South Georgia and the South Sandwich Islands', 'SX', 'GS', 'SGS', '239', 'GS', '', 'Antarctic Region ', '', '', 'Pound Sterling', 'GBP', 0, 'The South Georgia and the South Sandwich Islands', '', 'south-georgia-and-the-south-sandwich-islands'),
(223, 'South Korea (한국)', 'KS', 'KR', 'KOR', '410', 'KR', 'Seoul ', 'Asia ', 'Korean', 'Koreans', 'Won', 'KRW', 47904370, 'South Korea', '', 'south-korea'),
(224, 'Spain (España)', 'SP', 'ES', 'ESP', '724', 'ES', 'Madrid ', 'Europe ', 'Spanish', 'Spaniards', 'Euro', 'EUR', 40037995, 'Spain', '', 'spain-espa-a'),
(225, 'Spratly Islands', 'PG', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Spratly Islands', '', 'spratly-islands'),
(226, 'Sri Lanka', 'CE', 'LK', 'LKA', '144', 'LK', 'Colombo', 'Asia ', 'Sri Lankan', 'Sri Lankans', 'Sri Lanka Rupee', 'LKR', 19408635, 'Sri Lanka', '', 'sri-lanka'),
(227, 'Sudan (السودان)', 'SU', 'SD', 'SDN', '736', 'SD', 'Khartoum ', 'Africa ', 'Sudanese', 'Sudanese', 'Sudanese Dinar', 'SDD', 36080373, 'Sudan', '', 'sudan'),
(228, 'Suriname', 'NS', 'SR', 'SUR', '740', 'SR', 'Paramaribo ', 'South America ', 'Surinamese', 'Surinamers', 'Suriname Guilder', 'SRG', 433998, 'Suriname', '', 'suriname'),
(229, 'Svalbard and Jan Mayen', 'SV', 'SJ', 'SJM', '744', 'SJ', 'Longyearbyen ', 'Arctic Region ', '', '', 'Norwegian Krone', 'NOK', 2332, 'Svalbard', 'ISO includes Jan Mayen', 'svalbard-and-jan-mayen'),
(230, 'Swaziland', 'WZ', 'SZ', 'SWZ', '748', 'SZ', 'Mbabane ', 'Africa ', 'Swazi', 'Swazis', 'Lilangeni', 'SZL', 1104343, 'Swaziland', '', 'swaziland'),
(231, 'Sweden (Sverige)', 'SW', 'SE', 'SWE', '752', 'SE', 'Stockholm ', 'Europe ', 'Swedish', 'Swedes', 'Swedish Krona', 'SEK', 8875053, 'Sweden', '', 'sweden-sverige'),
(232, 'Switzerland (Schweiz)', 'SZ', 'CH', 'CHE', '756', 'CH', 'Bern ', 'Europe ', 'Swiss', 'Swiss', 'Swiss Franc', 'CHF', 7283274, 'Switzerland', '', 'switzerland-schweiz'),
(233, 'Syria (سوريا)', 'SY', 'SY', 'SYR', '760', 'SY', 'Damascus ', 'Middle East ', 'Syrian', 'Syrians', 'Syrian Pound', 'SYP', 16728808, 'Syria', '', 'syria'),
(234, 'Taiwan (台灣)', 'TW', 'TW', 'TWN', '158', 'TW', 'Taipei ', 'Southeast Asia ', 'Taiwanese', 'Taiwanese', 'New Taiwan Dollar', 'TWD', 22370461, 'Taiwan', '', 'taiwan'),
(235, 'Tajikistan (Тоҷикистон)', 'TI', 'TJ', 'TJK', '762', 'TJ', 'Dushanbe ', 'Commonwealth of Independent States ', 'Tajikistani', 'Tajikistanis', 'Somoni', 'TJS', 6578681, 'Tajikistan', '', 'tajikistan'),
(236, 'Tanzania', 'TZ', 'TZ', 'TZA', '834', 'TZ', 'Dar es Salaam', 'Africa ', 'Tanzanian', 'Tanzanians', 'Tanzanian Shilling', 'TZS', 36232074, 'Tanzania', '', 'tanzania'),
(237, 'Thailand (ราชอาณาจักรไทย)', 'TH', 'TH', 'THA', '764', 'TH', 'Bangkok ', 'Southeast Asia ', 'Thai', 'Thai', 'Baht', 'THB', 61797751, 'Thailand', '', 'thailand'),
(238, 'Timor-Leste', 'TT', 'TL', 'TLS', '626', 'TP', '', '', '', '', 'Timor Escudo', 'TPE', 1040880, 'East Timor', 'NULL', 'timor-leste'),
(239, 'Togo', 'TO', 'TG', 'TGO', '768', 'TG', 'Lome ', 'Africa ', 'Togolese', 'Togolese', 'CFA Franc BCEAO', 'XOF', 5153088, 'Togo', '', 'togo'),
(240, 'Tokelau', 'TL', 'TK', 'TKL', '772', 'TK', '', 'Oceania ', 'Tokelauan', 'Tokelauans', 'New Zealand Dollar', 'NZD', 1445, 'Tokelau', '', 'tokelau'),
(241, 'Tonga', 'TN', 'TO', 'TON', '776', 'TO', 'Nuku''alofa ', 'Oceania ', 'Tongan', 'Tongans', 'Pa''anga', 'TOP', 104227, 'Tonga', '', 'tonga'),
(242, 'Trinidad and Tobago', 'TD', 'TT', 'TTO', '780', 'TT', 'Port-of-Spain ', 'Central America and the Caribbean ', 'Trinidadian and Tobagonian', 'Trinidadians and Tobagonians', 'Trinidad and Tobago Dollar', 'TTD', 1169682, 'Trinidad and Tobago', '', 'trinidad-and-tobago'),
(243, 'Tromelin Island', 'TE', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Tromelin Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'tromelin-island'),
(244, 'Tunisia (تونس)', 'TS', 'TN', 'TUN', '788', 'TN', 'Tunis ', 'Africa ', 'Tunisian', 'Tunisians', 'Tunisian Dinar', 'TND', 9705102, 'Tunisia', '', 'tunisia'),
(245, 'Turkey (Türkiye)', 'TU', 'TR', 'TUR', '792', 'TR', 'Ankara ', 'Middle East ', 'Turkish', 'Turks', 'Turkish Lira', 'TRL', 66493970, 'Turkey', '', 'turkey-t-rkiye'),
(246, 'Turkmenistan (Türkmenistan)', 'TX', 'TM', 'TKM', '795', 'TM', 'Ashgabat ', 'Commonwealth of Independent States ', 'Turkmen', 'Turkmens', 'Manat', 'TMM', 4603244, 'Turkmenistan', '', 'turkmenistan-t-rkmenistan'),
(247, 'Turks and Caicos Islands', 'TK', 'TC', 'TCA', '796', 'TC', 'Cockburn Town ', 'Central America and the Caribbean ', '', '', 'US Dollar', 'USD', 18122, 'The Turks and Caicos Islands', '', 'turks-and-caicos-islands'),
(248, 'Tuvalu', 'TV', 'TV', 'TUV', '798', 'TV', 'Funafuti ', 'Oceania ', 'Tuvaluan', 'Tuvaluans', 'Australian Dollar', 'AUD', 10991, 'Tuvalu', '', 'tuvalu'),
(249, 'Uganda', 'UG', 'UG', 'UGA', '800', 'UG', 'Kampala ', 'Africa ', 'Ugandan', 'Ugandans', 'Uganda Shilling', 'UGX', 23985712, 'Uganda', '', 'uganda'),
(250, 'Ukraine (Україна)', 'UP', 'UA', 'UKR', '804', 'UA', 'Kiev ', 'Commonwealth of Independent States ', 'Ukrainian', 'Ukrainians', 'Hryvnia', 'UAH', 48760474, 'The Ukraine', '', 'ukraine'),
(251, 'United Arab Emirates (الإمارات العربيّة المتّحدة)', 'AE', 'AE', 'ARE', '784', 'AE', 'Abu Dhabi ', 'Middle East ', 'Emirati', 'Emiratis', 'UAE Dirham', 'AED', 2407460, 'The United Arab Emirates', '', 'united-arab-emirates'),
(252, 'United Kingdom', 'UK', 'GB', 'GBR', '826', 'UK', 'London ', 'Europe ', 'British', 'Britons', 'Pound Sterling', 'GBP', 59647790, 'The United Kingdom', 'ISO includes Guernsey, Isle of Man, Jersey', 'united-kingdom'),
(253, 'United States', 'US', 'US', 'USA', '840', 'US', 'Washington, DC ', 'North America ', 'American', 'Americans', 'US Dollar', 'USD', 278058881, 'The United States', '', 'united-states'),
(254, 'United States minor outlying islands', '--', 'UM', 'UMI', '581', 'UM', '', '', '', '', 'US Dollar', 'USD', 0, 'The United States Minor Outlying Islands', 'ISO includes Baker Island, Howland Island, Jarvis Island, Johnston Atoll, Kingman Reef, Midway Islands, Palmyra Atoll, Wake Island', 'united-states-minor-outlying-islands'),
(255, 'Uruguay', 'UY', 'UY', 'URY', '858', 'UY', 'Montevideo ', 'South America ', 'Uruguayan', 'Uruguayans', 'Peso Uruguayo', 'UYU', 3360105, 'Uruguay', '', 'uruguay'),
(256, 'Uzbekistan (O&#39;zbekiston)', 'UZ', 'UZ', 'UZB', '860', 'UZ', 'Tashkent', 'Commonwealth of Independent States ', 'Uzbekistani', 'Uzbekistanis', 'Uzbekistan Sum', 'UZS', 25155064, 'Uzbekistan', '', 'uzbekistan-o-39-zbekiston'),
(257, 'Vanuatu', 'NH', 'VU', 'VUT', '548', 'VU', 'Port-Vila ', 'Oceania ', 'Ni-Vanuatu', 'Ni-Vanuatu', 'Vatu', 'VUV', 192910, 'Vanuatu', '', 'vanuatu'),
(258, 'Vatican City (Città del Vaticano)', 'VT', 'VA', 'VAT', '336', 'VA', 'Vatican City ', 'Europe ', '', '', 'Euro', 'EUR', 890, 'The Vatican City', '', 'vatican-city-citt-del-vaticano'),
(259, 'Venezuela', 'VE', 'VE', 'VEN', '862', 'VE', 'Caracas ', 'South America, Central America and the Caribbean ', 'Venezuelan', 'Venezuelans', 'Bolivar', 'VEB', 23916810, 'Venezuela', '', 'venezuela'),
(260, 'Vietnam (Việt Nam)', 'VM', 'VN', 'VNM', '704', 'VN', 'Hanoi ', 'Southeast Asia ', 'Vietnamese', 'Vietnamese', 'Dong', 'VND', 79939014, 'Vietnam', '', 'vietnam-vi-t-nam'),
(261, 'Virgin Islands (UK)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (UK)', 'see British Virgin Islands', 'virgin-islands-uk'),
(262, 'Virgin Islands (US)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (US)', 'see Virgin Islands', 'virgin-islands-us'),
(263, 'Virgin Islands, British', 'VI', 'VG', 'VGB', '92', 'VG', 'Road Town ', 'Central America and the Caribbean ', 'British Virgin Islander', 'British Virgin Islanders', 'US Dollar', 'USD', 20812, 'The British Virgin Islands', '', 'virgin-islands-british'),
(264, 'Virgin Islands, U.S.', 'VQ', 'VI', 'VIR', '850', 'VI', 'Charlotte Amalie ', 'Central America and the Caribbean ', 'Virgin Islander', 'Virgin Islanders', 'US Dollar', 'USD', 122211, 'The Virgin Islands', '', 'virgin-islands-u-s'),
(265, 'Wake Island', 'WQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'US Dollar', 'USD', 0, 'Wake Island', 'ISO includes with the US Minor Outlying Islands', 'wake-island'),
(266, 'Wallis and Futuna', 'WF', 'WF', 'WLF', '876', 'WF', 'Mata-Utu', 'Oceania ', 'Wallis and Futuna Islander', 'Wallis and Futuna Islanders', 'CFP Franc', 'XPF', 15435, 'Wallis and Futuna', '', 'wallis-and-futuna'),
(267, 'West Bank', 'WE', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel ', 'ILS', 2090713, 'The West Bank', '', 'west-bank'),
(268, 'Western Sahara (الصحراء الغربية)', 'WI', 'EH', 'ESH', '732', 'EH', '', 'Africa ', 'Sahrawian', 'Sahrawis', 'Moroccan Dirham', 'MAD', 250559, 'Western Sahara', '', 'western-sahara'),
(269, 'Western Samoa', '--', '--', '-- ', '--', '--', '', '', '', '', 'Tala', 'WST', 0, 'Western Samoa', 'see Samoa', 'western-samoa'),
(270, 'World', '--', '--', '-- ', '--', '--', '', 'World, Time Zones ', '', '', '', '', 1862433264, 'The World', 'NULL', 'world'),
(271, 'Yemen (اليمن)', 'YM', 'YE', 'YEM', '887', 'YE', 'Sanaa ', 'Middle East ', 'Yemeni', 'Yemenis', 'Yemeni Rial', 'YER', 18078035, 'Yemen', '', 'yemen'),
(272, 'Yugoslavia', 'YI', 'YU', 'YUG', '891', 'YU', 'Belgrade ', 'Europe ', 'Serbian', 'Serbs', 'Yugoslavian Dinar ', 'YUM', 10677290, 'Yugoslavia', 'NULL', 'yugoslavia'),
(273, 'Zaire', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Zaire', 'see Democratic Republic of the Congo', 'zaire'),
(274, 'Zambia', 'ZA', 'ZM', 'ZWB', '894', 'ZM', 'Lusaka ', 'Africa ', 'Zambian', 'Zambians', 'Kwacha', 'ZMK', 9770199, 'Zambia', '', 'zambia'),
(275, 'Zimbabwe', 'ZI', 'ZW', 'ZWE', '716', 'ZW', 'Harare ', 'Africa ', 'Zimbabwean', 'Zimbabweans', 'Zimbabwe Dollar', 'ZWD', 11365366, 'Zimbabwe', '', 'zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `sid` bigint(20) NOT NULL,
  `cid` varchar(250) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL default '0',
  `category_id` bigint(20) default '0',
  `coupon_type_id` tinyint(20) NOT NULL default '2',
  `affiliate_site_id` bigint(20) NOT NULL default '1',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `jump` varchar(250) collate utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `url` varchar(250) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) collate utf8_unicode_ci default NULL,
  `meta_keywords` varchar(250) collate utf8_unicode_ci default NULL,
  `meta_description` text collate utf8_unicode_ci,
  `coupon_impression_count` bigint(20) NOT NULL,
  `admin_suspend` tinyint(1) NOT NULL,
  `is_system_flagged` bigint(20) NOT NULL default '0',
  `detected_suspicious_words` varchar(225) collate utf8_unicode_ci NOT NULL,
  `coupon_view_count` bigint(20) NOT NULL,
  `coupon_favorite_count` bigint(20) NOT NULL,
  `coupon_print_count` bigint(20) NOT NULL,
  `coupon_comment_count` bigint(20) NOT NULL,
  `coupon_tag_count` bigint(20) NOT NULL,
  `coupon_flag_count` bigint(20) NOT NULL,
  `coupon_feedback_count` bigint(20) NOT NULL,
  `coupon_worked_count` bigint(20) NOT NULL,
  `coupon_not_worked_count` bigint(20) NOT NULL,
  `average_savings_amount` double(10,2) NOT NULL,
  `is_percentage` tinyint(1) NOT NULL,
  `is_popular` tinyint(1) NOT NULL,
  `is_free_shipping` tinyint(1) NOT NULL,
  `is_printable` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `is_ongoing` tinyint(1) NOT NULL,
  `is_special_offer` tinyint(1) NOT NULL,
  `is_waiting_admin_approval` tinyint(1) NOT NULL default '1',
  `is_paid` tinyint(1) NOT NULL,
  `is_partner` tinyint(1) NOT NULL,
  `is_mail_sent` tinyint(1) NOT NULL,
  `status_id` int(11) NOT NULL,
  `coupon_status_id` tinyint(2) NOT NULL default '3',
  `coupon_type_status_id` bigint(20) NOT NULL,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`),
  KEY `coupon_code` (`coupon_code`),
  KEY `store_id` (`store_id`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`status_id`),
  KEY `coupon_status_id` (`coupon_status_id`),
  KEY `category_id` (`category_id`),
  KEY `coupon_type_id` (`coupon_type_id`),
  KEY `sid` (`sid`),
  KEY `cid` (`cid`),
  KEY `ip_id` (`ip_id`),
  KEY `coupon_type_status_id` (`coupon_type_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupons`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupons_coupon_tags`
--

DROP TABLE IF EXISTS `coupons_coupon_tags`;
CREATE TABLE IF NOT EXISTS `coupons_coupon_tags` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `coupon_tag_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `coupon_tag_id` (`coupon_tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupons_coupon_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_comments`
--

DROP TABLE IF EXISTS `coupon_comments`;
CREATE TABLE IF NOT EXISTS `coupon_comments` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `comment` text collate utf8_unicode_ci NOT NULL,
  `ip_id` bigint(20) default '0',
  `is_system_flagged` bigint(20) NOT NULL,
  `detected_suspicious_words` varchar(255) collate utf8_unicode_ci NOT NULL,
  `admin_suspend` tinyint(2) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_favorites`
--

DROP TABLE IF EXISTS `coupon_favorites`;
CREATE TABLE IF NOT EXISTS `coupon_favorites` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` decimal(10,0) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_favorites`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_feedbacks`
--

DROP TABLE IF EXISTS `coupon_feedbacks`;
CREATE TABLE IF NOT EXISTS `coupon_feedbacks` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `purchased` varchar(250) collate utf8_unicode_ci NOT NULL,
  `purchased_price` double(10,2) NOT NULL,
  `is_worked` tinyint(1) NOT NULL default '0',
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_feedbacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_flags`
--

DROP TABLE IF EXISTS `coupon_flags`;
CREATE TABLE IF NOT EXISTS `coupon_flags` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) default '0',
  `coupon_id` bigint(20) unsigned NOT NULL,
  `coupon_flag_category_id` bigint(20) unsigned NOT NULL,
  `message` text collate utf8_unicode_ci,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `coupon_flag_category_id` (`coupon_flag_category_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_flags`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_flag_categories`
--

DROP TABLE IF EXISTS `coupon_flag_categories`;
CREATE TABLE IF NOT EXISTS `coupon_flag_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  `coupon_flag_count` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `user_id` (`user_id`),
  KEY `coupon_flag_count` (`coupon_flag_count`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_flag_categories`
--

INSERT INTO `coupon_flag_categories` (`id`, `created`, `modified`, `user_id`, `name`, `coupon_flag_count`, `is_active`) VALUES
(1, '2010-05-14', '2010-05-14', 0, 'Sexual Content', 0, 1),
(2, '2010-05-14', '2010-05-14', 0, 'Violent or Repulsive Content', 0, 1),
(3, '2010-05-14', '2010-05-14', 0, 'Hatful or Abusive Content', 0, 1),
(4, '2010-05-14', '2010-05-14', 0, 'Ham Dangerous Acts', 0, 1),
(5, '2010-05-14', '2010-05-14', 0, 'Spam', 0, 1),
(6, '2010-05-14', '2010-05-14', 0, 'Infrings My Rights', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_impressions`
--

DROP TABLE IF EXISTS `coupon_impressions`;
CREATE TABLE IF NOT EXISTS `coupon_impressions` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `store_id` (`store_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_impressions`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_statuses`
--

DROP TABLE IF EXISTS `coupon_statuses`;
CREATE TABLE IF NOT EXISTS `coupon_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_statuses`
--

INSERT INTO `coupon_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Check Store'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'New Coupon'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected Store'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active Coupon'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected Coupon'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Outdated Coupon');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_tags`
--

DROP TABLE IF EXISTS `coupon_tags`;
CREATE TABLE IF NOT EXISTS `coupon_tags` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(250) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `coupon_count` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon_types`
--

DROP TABLE IF EXISTS `coupon_types`;
CREATE TABLE IF NOT EXISTS `coupon_types` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `title` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_types`
--

INSERT INTO `coupon_types` (`id`, `created`, `modified`, `name`) VALUES
(2, '2011-02-14 18:57:33', '2011-02-14 18:57:33', 'Coupon Codes'),
(1, '2011-02-14 18:57:33', '2011-02-14 18:57:33', 'Shopping Tips'),
(3, '2011-02-14 18:57:33', '2011-02-14 18:57:33', 'Printable Coupons');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_type_statuses`
--

DROP TABLE IF EXISTS `coupon_type_statuses`;
CREATE TABLE IF NOT EXISTS `coupon_type_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon_type_statuses`
--

INSERT INTO `coupon_type_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Special Offer'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Unreliable'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Normal coupon');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `from` varchar(500) collate utf8_unicode_ci NOT NULL,
  `reply_to` varchar(500) collate utf8_unicode_ci NOT NULL,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `subject` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email_content` text collate utf8_unicode_ci NOT NULL,
  `email_variables` varchar(1000) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Email Templates';

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_content`, `email_variables`) VALUES
(1, '2009-02-20 10:24:49', '2011-09-08 05:53:24', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Forgot Password', 'we will send this mail, when user submit the forgot password form.', 'Forgot password', 'Hi ##USERNAME##,\r\n\r\nA password reset request has been made for your user account at ##SITE_NAME##.\r\n\r\nIf you made this request, please click on the following link:\r\n\r\n##RESET_URL##\r\n\r\nIf you did not request this action and feel this is in error, please contact us.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'USERNAME,RESET_URL,SITE_NAME,SITE_URL'),
(2, '2009-02-20 10:15:57', '2011-09-08 05:55:33', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Activation Request', 'we will send this mail, when user registering an account he/she will get an activation request.', 'Please activate your ##SITE_NAME## account', 'Hi ##USERNAME##,\r\n\r\nYour account has been created. \r\nPlease visit the following URL to activate your account.\r\n##ACTIVATION_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME,ACTIVATION_URL,SITE_URL'),
(3, '2009-02-20 10:15:19', '2011-09-08 05:56:41', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New User Join', 'we will send this mail to admin, when a new user registered in the site. For this you have to enable "admin mail after register" in the settings page.', 'New user joined in ##SITE_NAME## account', 'Hi,\n\nA new user named "##USERNAME##" has joined in ##SITE_NAME##.\n\nUsername: ##USERNAME##\nEmail: ##USEREMAIL##\nSignup IP: ##SIGNUPIP##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', 'SITE_NAME,USERNAME,SITE_URL'),
(4, '2009-03-02 00:00:00', '2011-09-08 05:58:40', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Add', 'we will send this mail to user, when a admin add a new user.', 'Welcome to ##SITE_NAME##', 'Hi ##USERNAME##,\r\n\r\n##SITE_NAME## team added you as a user in ##SITE_NAME##.\r\n\r\nYour account details,\r\n##LOGINLABEL##: ##USEDTOLOGIN##\r\nPassword: ##PASSWORD##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME,PASSWORD, LOGINLABEL, USEDTOLOGIN,SITE_URL'),
(5, '2009-05-22 16:51:14', '2011-09-08 05:59:46', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Welcome Email', 'we will send this mail, when user register in this site and get activate.', 'Welcome to ##SITE_NAME##', 'Hi ##USERNAME##,\r\n\r\nWe wish to say a quick hello and thanks for registering at ##SITE_NAME##.\r\n\r\nIf you did not request this account and feel this is in error, please\r\ncontact us at ##CONTACT_MAIL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME, USERNAME, CONTACT_EMAIL,SITE_URL'),
(7, '2009-05-22 16:45:38', '2011-09-08 06:02:06', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Active ', 'We will send this mail to user, when user active   \r\nby administator.', 'Your ##SITE_NAME## account has been activated', 'Hi ##USERNAME##,\r\n\r\nYour account has been activated.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME'),
(8, '2009-05-22 16:48:38', '2011-09-08 06:02:37', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Deactivate', 'We will send this mail to user, when user deactive by administator.', 'Your ##SITE_NAME## account has been deactivated', 'Hi ##USERNAME##,\r\n\r\nYour ##SITE_NAME## account has been deactivated.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME'),
(9, '2009-05-22 16:50:25', '2011-09-08 06:03:05', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Delete', 'We will send this mail to user, when user delete by administrator.', 'Your ##SITE_NAME## account has been removed', 'Hi ##USERNAME##,\r\n\r\nYour ##SITE_NAME## account has been removed.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME'),
(10, '2009-07-07 15:47:09', '2011-09-08 06:03:50', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin Change Password', 'we will send this mail to user, when admin change user''s password.', 'Password changed', 'Hi ##USERNAME##,\r\n\r\nAdmin reset your password for your ##SITE_NAME## account.\r\n\r\nYour new password: ##PASSWORD##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,PASSWORD,USERNAME'),
(11, '2009-10-14 18:31:14', '2009-10-14 18:31:14', '##FIRST_NAME####LAST_NAME## <##FROM_EMAIL##>', '##FROM_EMAIL##', 'Contact Us ', 'We will send this mail to admin, when user submit any contact form.', '[##SITE_NAME##] ##SUBJECT##', '##MESSAGE##\r\n\r\n----------------------------------------------------\r\nTelephone    : ##TELEPHONE##\r\nIP           : ##IP##, ##SITE_ADDR##\r\nWhois        : http://whois.sc/##IP##\r\nURL          : ##FROM_URL##\r\n----------------------------------------------------', 'FROM_URL, IP, TELEPHONE, MESSAGE, SITE_NAME, SUBJECT, FROM_EMAIL, LAST_NAME, FIRST_NAME'),
(12, '2009-10-14 19:20:59', '2009-10-14 19:20:59', '"##SITE_NAME## (auto response)" <##FROM_EMAIL##>', '', 'Contact Us Auto Reply', 'we will send this mail ti user, when user submit the contact us form.', '[##SITE_NAME##] RE: ##SUBJECT##', 'Hi ##FIRST_NAME####LAST_NAME##,\r\n\r\n   Thanks for contacting us. We''ll get back to you shortly.\r\n\r\n   Please do not reply to this automated response. If you have not contacted us and if you feel this is an error, please contact us through our site ##CONTACT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##\r\n\r\n------ On ##POST_DATE## you wrote from ##IP## -----\r\n\r\n##MESSAGE##\r\n', 'MESSAGE, POST_DATE, SITE_NAME, CONTACT_URL, FIRST_NAME, LAST_NAME, SUBJECT, SITE_URL'),
(15, '2010-05-24 00:00:00', '2011-09-08 06:16:56', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Subscription Welcome Mail', 'We will send this mail, when user subscribed for a city ', 'Welcome to ##SITE_NAME##!', 'Hi,\r\n\r\nYour subscription request has been activated. \r\nYou will receive mail from ##SITE_NAME## while new coupon arrived.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME, SITE_LOGO, FROM_EMAIL, LEARN_HOW_LINK, SITE_LINK, REFERRAL_AMOUNT, REFER_FRIEND_LINK, FACEBOOK_LINK, TWITTER_LINK, RECENT_DEALS, CONTACT_US_LINK,CONTACT_URL'),
(16, '2009-09-11 19:52:06', '2011-09-08 07:01:04', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Coupon of the day', 'This email will be sent to all the subscribers of a particular city, when there is a deal available for that particular day.', 'New Coupon added', 'Hi,\r\n\r\nNew coupon added in store ##STORE_NAME##.\r\nPlease click the following link to see the coupon,\r\n##COUPON_LINK##\r\n\r\nYou are receiving this email because you signed up for email alerts. If you prefer not to receive promotional email from ##SITE_NAME##, you can always unsubscribe at anytime using below link,\r\n##UNSUBSCRIBE_LINK##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'FROM_EMAIL, REPLY_TO_EMAIL, SITE_LINK, SITE_NAME, USERNAME,  COUPON_NAME, BUY_PRICE, DISCOUNT, SAVINGS, STORE_NAME, STORE_ADDRESS, CITY_NAME, RATING,  DESCRIPTION, UNSUBSCRIBE_LINK ,CONTACT_URL,COUPON_NAME,COUPON_LINK,DISCOUNT'),
(18, '2009-02-20 10:15:57', '2011-09-08 07:03:02', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Subscription Activation Request', 'we will send this mail, when user registering an account he/she will get an activation request.', 'Please activate your ##SITE_NAME## Subscription', 'Hi,\r\n\r\nYour subscription has been created. \r\nPlease visit the following URL to activate your subscription confirmation.\r\n##ACTIVATION_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'SITE_NAME,USERNAME,ACTIVATION_URL'),
(17, '2009-09-11 19:52:06', '2011-09-08 07:08:25', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Store of the day', 'This email will be sent to all the subscribers of a particular city, when there is a deal available for that particular day.', 'New store added', 'Hi,\r\n\r\nNew store named "##STORE_NAME##" was added in our site.\r\nPlease click the following link to see the store,\r\n##STORE_LINK##\r\n\r\nYou are receiving this email because you signed up for email alerts. If you prefer not to receive promotional email from ##SITE_NAME##, you can always unsubscribe at anytime using below link,\r\n##UNSUBSCRIBE_LINK##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'FROM_EMAIL, REPLY_TO_EMAIL, SITE_LINK, SITE_NAME, USERNAME, DEAL_LINK, DEAL_NAME, BUY_PRICE, ORIGINAL_PRICE, DISCOUNT, SAVINGS, COMPANY_NAME, COMPANY_SITE, COMPANY_ADDRESS, CITY_NAME, RATING, DEAL_NAME, DESCRIPTION, UNSUBSCRIBE_LINK ,CONTACT_URL,STORE_NAME,STORE_LINK'),
(19, '2009-09-11 19:52:06', '2011-09-08 07:01:04', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New coupon added', 'We will send this email to administrator when new coupon added in store by the users/guest users', 'New coupon added', 'Hi,\r\n\r\nNew coupon added by the ##USER_INFO##.\r\n\r\nStore Name:##STORE##\r\nStore url: ##STORE_LINK##\r\nCoupon Code:##CODE##\r\nCoupon Type:##COUPON_TYPE##\r\nCoupon:##DESCRIPTION##\r\nIP:##IP##\r\n\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##\r\n', 'FROM_EMAIL, REPLY_TO_EMAIL, SITE_LINK, SITE_NAME,USER_INFO,STORE,STORE_LINK,IP,SITE_URL,CODE,COUPON_TYPE,DESCRIPTION,IP'),
(20, '2009-09-11 19:52:06', '2011-09-08 07:01:04', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New store added', 'We will send this email to administrator when new store added by the users/guest users', 'New store added', 'Hi,\r\n\r\nNew store added by the ##USER_INFO##.\r\n\r\nStore Name:##STORE##\r\nStore url: ##STORE_LINK##\r\nIP:##IP##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'FROM_EMAIL, REPLY_TO_EMAIL, SITE_LINK, SITE_NAME,USER_INFO,STORE,STORE_LINK,IP,SITE_URL');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Gender details';

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `created`, `modified`, `name`) VALUES
(1, '2009-02-12 09:41:37', '2009-02-12 09:41:37', 'Male'),
(2, '2009-02-12 09:41:37', '2009-02-12 09:41:37', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `google_ads`
--

DROP TABLE IF EXISTS `google_ads`;
CREATE TABLE IF NOT EXISTS `google_ads` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `title` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Google Ads';

--
-- Dumping data for table `google_ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

DROP TABLE IF EXISTS `ips`;
CREATE TABLE IF NOT EXISTS `ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ip` varchar(255) collate utf8_unicode_ci default NULL,
  `host` varchar(255) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `timezone_id` bigint(20) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `timezone_id` (`timezone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Ips Details';

--
-- Dumping data for table `ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `iso2` varchar(5) collate utf8_unicode_ci default NULL,
  `iso3` varchar(5) collate utf8_unicode_ci default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Language List ';

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `created`, `modified`, `name`, `iso2`, `iso3`, `is_active`) VALUES
(1, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Abkhazian', 'ab', 'abk', 1),
(2, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afar', 'aa', 'aar', 1),
(3, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afrikaans', 'af', 'afr', 1),
(4, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Akan', 'ak', 'aka', 1),
(5, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Albanian', 'sq', 'sqi', 1),
(6, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Amharic', 'am', 'amh', 1),
(7, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Arabic', 'ar', 'ara', 1),
(8, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aragonese', 'an', 'arg', 1),
(9, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Armenian', 'hy', 'hye', 1),
(10, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Assamese', 'as', 'asm', 1),
(11, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avaric', 'av', 'ava', 1),
(12, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avestan', 'ae', 'ave', 1),
(13, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aymara', 'ay', 'aym', 1),
(14, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Azerbaijani', 'az', 'aze', 1),
(15, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bambara', 'bm', 'bam', 1),
(16, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bashkir', 'ba', 'bak', 1),
(17, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Basque', 'eu', 'eus', 1),
(18, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Belarusian', 'be', 'bel', 1),
(19, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bengali', 'bn', 'ben', 1),
(20, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bihari', 'bh', 'bih', 1),
(21, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bislama', 'bi', 'bis', 1),
(22, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bosnian', 'bs', 'bos', 1),
(23, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Breton', 'br', 'bre', 1),
(24, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bulgarian', 'bg', 'bul', 1),
(25, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Burmese', 'my', 'mya', 1),
(26, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Catalan', 'ca', 'cat', 1),
(27, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chamorro', 'ch', 'cha', 1),
(28, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chechen', 'ce', 'che', 1),
(29, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chichewa', 'ny', 'nya', 1),
(30, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chinese', 'zh', 'zho', 1),
(31, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Church Slavic', 'cu', 'chu', 1),
(32, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chuvash', 'cv', 'chv', 1),
(33, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cornish', 'kw', 'cor', 1),
(34, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Corsican', 'co', 'cos', 1),
(35, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cree', 'cr', 'cre', 1),
(36, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Croatian', 'hr', 'hrv', 1),
(37, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Czech', 'cs', 'ces', 1),
(38, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Danish', 'da', 'dan', 1),
(39, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Divehi', 'dv', 'div', 1),
(40, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dutch', 'nl', 'nld', 1),
(41, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dzongkha', 'dz', 'dzo', 1),
(42, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'English', 'en', 'eng', 1),
(43, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Esperanto', 'eo', 'epo', 1),
(44, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Estonian', 'et', 'est', 1),
(45, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ewe', 'ee', 'ewe', 1),
(46, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Faroese', 'fo', 'fao', 1),
(47, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fijian', 'fj', 'fij', 1),
(48, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Finnish', 'fi', 'fin', 1),
(49, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'French', 'fr', 'fra', 1),
(50, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fulah', 'ff', 'ful', 1),
(51, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Galician', 'gl', 'glg', 1),
(52, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ganda', 'lg', 'lug', 1),
(53, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Georgian', 'ka', 'kat', 1),
(54, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'German', 'de', 'deu', 1),
(55, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Greek', 'el', 'ell', 1),
(56, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Guaraní', 'gn', 'grn', 1),
(57, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Gujarati', 'gu', 'guj', 1),
(58, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Haitian', 'ht', 'hat', 1),
(59, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hausa', 'ha', 'hau', 1),
(60, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hebrew', 'he', 'heb', 1),
(61, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Herero', 'hz', 'her', 1),
(62, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hindi', 'hi', 'hin', 1),
(63, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hiri Motu', 'ho', 'hmo', 1),
(64, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hungarian', 'hu', 'hun', 1),
(65, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Icelandic', 'is', 'isl', 1),
(66, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ido', 'io', 'ido', 1),
(67, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Igbo', 'ig', 'ibo', 1),
(68, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Indonesian', 'id', 'ind', 1),
(69, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingua (International Auxiliary Language Association)', 'ia', 'ina', 1),
(70, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingue', 'ie', 'ile', 1),
(71, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inuktitut', 'iu', 'iku', 1),
(72, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inupiaq', 'ik', 'ipk', 1),
(73, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Irish', 'ga', 'gle', 1),
(74, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Italian', 'it', 'ita', 1),
(75, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Japanese', 'ja', 'jpn', 1),
(76, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Javanese', 'jv', 'jav', 1),
(77, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kalaallisut', 'kl', 'kal', 1),
(78, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kannada', 'kn', 'kan', 1),
(79, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kanuri', 'kr', 'kau', 1),
(80, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kashmiri', 'ks', 'kas', 1),
(81, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kazakh', 'kk', 'kaz', 1),
(82, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Khmer', 'km', 'khm', 1),
(83, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kikuyu', 'ki', 'kik', 1),
(84, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kinyarwanda', 'rw', 'kin', 1),
(85, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirghiz', 'ky', 'kir', 1),
(86, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirundi', 'rn', 'run', 1),
(87, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Komi', 'kv', 'kom', 1),
(88, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kongo', 'kg', 'kon', 1),
(89, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Korean', 'ko', 'kor', 1),
(90, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kurdish', 'ku', 'kur', 1),
(91, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kwanyama', 'kj', 'kua', 1),
(92, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lao', 'lo', 'lao', 1),
(93, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latin', 'la', 'lat', 1),
(94, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latvian', 'lv', 'lav', 1),
(95, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Limburgish', 'li', 'lim', 1),
(96, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lingala', 'ln', 'lin', 1),
(97, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lithuanian', 'lt', 'lit', 1),
(98, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luba-Katanga', 'lu', 'lub', 1),
(99, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luxembourgish', 'lb', 'ltz', 1),
(100, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Macedonian', 'mk', 'mkd', 1),
(101, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malagasy', 'mg', 'mlg', 1),
(102, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malay', 'ms', 'msa', 1),
(103, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malayalam', 'ml', 'mal', 1),
(104, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Maltese', 'mt', 'mlt', 1),
(105, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Manx', 'gv', 'glv', 1),
(106, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Māori', 'mi', 'mri', 1),
(107, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marathi', 'mr', 'mar', 1),
(108, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marshallese', 'mh', 'mah', 1),
(109, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Mongolian', 'mn', 'mon', 1),
(110, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nauru', 'na', 'nau', 1),
(111, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Navajo', 'nv', 'nav', 1),
(112, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ndonga', 'ng', 'ndo', 1),
(113, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nepali', 'ne', 'nep', 1),
(114, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'North Ndebele', 'nd', 'nde', 1),
(115, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Northern Sami', 'se', 'sme', 1),
(116, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian', 'no', 'nor', 1),
(117, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian Bokmål', 'nb', 'nob', 1),
(118, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian Nynorsk', 'nn', 'nno', 1),
(119, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Occitan', 'oc', 'oci', 1),
(120, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ojibwa', 'oj', 'oji', 1),
(121, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oriya', 'or', 'ori', 1),
(122, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oromo', 'om', 'orm', 1),
(123, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ossetian', 'os', 'oss', 1),
(124, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Pāli', 'pi', 'pli', 1),
(125, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Panjabi', 'pa', 'pan', 1),
(126, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Pashto', 'ps', 'pus', 1),
(127, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Persian', 'fa', 'fas', 1),
(128, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Polish', 'pl', 'pol', 1),
(129, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Portuguese', 'pt', 'por', 1),
(130, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Quechua', 'qu', 'que', 1),
(131, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Raeto-Romance', 'rm', 'roh', 1),
(132, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Romanian', 'ro', 'ron', 1),
(133, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Russian', 'ru', 'rus', 1),
(134, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Samoan', 'sm', 'smo', 1),
(135, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sango', 'sg', 'sag', 1),
(136, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sanskrit', 'sa', 'san', 1),
(137, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sardinian', 'sc', 'srd', 1),
(138, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Scottish Gaelic', 'gd', 'gla', 1),
(139, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Serbian', 'sr', 'srp', 1),
(140, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Shona', 'sn', 'sna', 1),
(141, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sichuan Yi', 'ii', 'iii', 1),
(142, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sindhi', 'sd', 'snd', 1),
(143, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sinhala', 'si', 'sin', 1),
(144, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovak', 'sk', 'slk', 1),
(145, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovenian', 'sl', 'slv', 1),
(146, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Somali', 'so', 'som', 1),
(147, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'South Ndebele', 'nr', 'nbl', 1),
(148, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Southern Sotho', 'st', 'sot', 1),
(149, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Spanish', 'es', 'spa', 1),
(150, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sundanese', 'su', 'sun', 1),
(151, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swahili', 'sw', 'swa', 1),
(152, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swati', 'ss', 'ssw', 1),
(153, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swedish', 'sv', 'swe', 1),
(154, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tagalog', 'tl', 'tgl', 1),
(155, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tahitian', 'ty', 'tah', 1),
(156, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tajik', 'tg', 'tgk', 1),
(157, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tamil', 'ta', 'tam', 1),
(158, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tatar', 'tt', 'tat', 1),
(159, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Telugu', 'te', 'tel', 1),
(160, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Thai', 'th', 'tha', 1),
(161, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Tibetan', 'bo', 'bod', 1),
(162, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tigrinya', 'ti', 'tir', 1),
(163, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tonga', 'to', 'ton', 1),
(164, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Traditional Chinese', 'zh-TW', 'zh-TW', 1),
(165, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tsonga', 'ts', 'tso', 1),
(166, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tswana', 'tn', 'tsn', 1),
(167, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Turkish', 'tr', 'tur', 1),
(168, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Turkmen', 'tk', 'tuk', 1),
(169, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Twi', 'tw', 'twi', 1),
(170, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uighur', 'ug', 'uig', 1),
(171, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ukrainian', 'uk', 'ukr', 1),
(172, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Urdu', 'ur', 'urd', 1),
(173, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uzbek', 'uz', 'uzb', 1),
(174, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Venda', 've', 'ven', 1),
(175, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Vietnamese', 'vi', 'vie', 1),
(176, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Volapük', 'vo', 'vol', 1),
(177, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Walloon', 'wa', 'wln', 1),
(178, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Welsh', 'cy', 'cym', 1),
(179, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Western Frisian', 'fy', 'fry', 1),
(180, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Wolof', 'wo', 'wol', 1),
(181, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Xhosa', 'xh', 'xho', 1),
(182, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yiddish', 'yi', 'yid', 1),
(183, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yoruba', 'yo', 'yor', 1),
(184, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zhuang', 'za', 'zha', 1),
(185, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zulu', 'zu', 'zul', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci,
  `template` varchar(255) collate utf8_unicode_ci default NULL,
  `draft` tinyint(1) NOT NULL default '0',
  `lft` bigint(20) default NULL,
  `rght` bigint(20) default NULL,
  `level` int(3) NOT NULL default '0',
  `description_meta_tag` text collate utf8_unicode_ci,
  `url` text collate utf8_unicode_ci,
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Page Details';

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `created`, `modified`, `parent_id`, `title`, `content`, `template`, `draft`, `lft`, `rght`, `level`, `description_meta_tag`, `url`, `slug`, `is_default`) VALUES
(1, '2009-07-11 11:16:29', '2009-07-21 15:52:58', NULL, 'home', 'Comming soon', 'home.ctp', 0, NULL, NULL, 0, NULL, NULL, 'home', 1),
(2, '2009-07-11 11:16:54', '2009-07-21 15:53:27', NULL, 'about', 'Comming soon', 'about.ctp', 0, NULL, NULL, 0, NULL, NULL, 'about', 0),
(3, '2009-07-11 11:17:27', '2009-07-21 15:54:02', NULL, 'Contact Us', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'contact-us', 0),
(6, '2009-07-17 07:55:38', '2009-07-21 15:54:33', NULL, 'FAQ', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'faq', 0),
(7, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Term and conditions', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'term-and-conditions', 0),
(8, '2009-07-11 11:16:54', '2009-07-21 15:53:27', NULL, 'Tips', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'tips', 0),
(9, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Offers', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'offers', 0),
(10, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Privacy policy', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'privacy', 0),
(11, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Advertiser', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'advetiser', 0),
(12, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Press', 'Comming soon', '', 0, NULL, NULL, 0, NULL, NULL, 'press', 0);

-- --------------------------------------------------------

--
-- Table structure for table `search_keywords`
--

DROP TABLE IF EXISTS `search_keywords`;
CREATE TABLE IF NOT EXISTS `search_keywords` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `keyword` varchar(255) collate utf8_unicode_ci default NULL,
  `search_log_count` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='search keywords Lists';

--
-- Dumping data for table `search_keywords`
--


-- --------------------------------------------------------

--
-- Table structure for table `search_logs`
--

DROP TABLE IF EXISTS `search_logs`;
CREATE TABLE IF NOT EXISTS `search_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `search_keyword_id` bigint(20) default NULL,
  `ip_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `search_keyword_id` (`search_keyword_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Logging search with Ips';

--
-- Dumping data for table `search_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `setting_category_id` int(11) NOT NULL,
  `setting_category_parent_id` bigint(20) default '0',
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `value` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `type` varchar(8) collate utf8_unicode_ci default NULL,
  `options` text collate utf8_unicode_ci COMMENT 'Its only use, when we select type = select. Here we can give otpions value',
  `label` varchar(255) collate utf8_unicode_ci default NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `setting_category_id` (`setting_category_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Site Setting Details';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_category_id`, `setting_category_parent_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`) VALUES
(1, 21, 1, 'site.name', 'Couponator', 'This name will used in all pages, emails.', 'text', NULL, 'Name', 1),
(2, 0, 65, 'site.version', 'v1.0b7', 'This is the current version of the site, which will be displayed in the footer.', 'text', NULL, 'Version', 3),
(3, 24, 3, 'meta.keywords', 'meta keywords', 'These are the keywords used for improving search engine results of our site. (Comma separated for multiple keywords.)', 'text', NULL, 'Keywords', 1),
(4, 24, 3, 'meta.description', 'meta description', 'This is the short description of your site, used by search engines on search result pages to display preview snippets for a given page.', 'textarea', NULL, 'Description', 2),
(5, 22, 1, 'site.contact_email', '', 'This is the email address to which you will receive the mail from contact form.', 'text', NULL, 'Contact Email Address', 11),
(9, 29, 5, 'user.using_to_login', 'username', 'Users will be able to login with chosen login handle (username or email address) along with their password.', 'select', 'username, email', 'Login Handle', 1),
(10, 25, 3, 'site.tracking_script', '<script type="text/javascript">var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");document.write(unescape("%3Cscript src=\\''"+gaJsHost+"google-analytics.com/ga.js\\'' type=\\''text/javascript\\''%3E%3C/script%3E"));</script><script type="text/javascript">var pageTracker=_gat._getTracker("UA-4819298-1");pageTracker._initData();pageTracker._trackPageview();</script>', 'This is the site tracker script, used for track and analyze data about how people are getting to your website. e.g., Google Analytics. <a href="http://www.google.com/analytics/">http://www.google.com/analytics/</a>', 'textarea', NULL, 'Site Tracker Code', 26),
(25, 0, 65, 'thumb_size.micro_thumb.width', '18', '', 'text', NULL, 'Micro thumb', 0),
(26, 0, 65, 'thumb_size.micro_thumb.height', '18', '', 'text', NULL, '', 0),
(27, 0, 65, 'thumb_size.small_thumb.width', '34', '', 'text', NULL, 'Small thumb', 0),
(28, 0, 65, 'thumb_size.small_thumb.height', '24', '', 'text', NULL, '', 0),
(29, 0, 65, 'thumb_size.medium_thumb.width', '65', '', 'text', NULL, 'Medium thumb', 0),
(30, 0, 65, 'thumb_size.medium_thumb.height', '47', '', 'text', NULL, '', 0),
(31, 0, 65, 'thumb_size.normal_thumb.width', '110', '', 'text', NULL, 'Normal thumb', 0),
(32, 0, 65, 'thumb_size.normal_thumb.height', '80', '', 'text', NULL, '', 0),
(33, 0, 65, 'thumb_size.big_thumb.width', '106', '', 'text', NULL, 'Big thumb', 0),
(34, 0, 65, 'thumb_size.big_thumb.height', '76', '', 'text', NULL, '', 0),
(35, 0, 65, 'thumb_size.small_big_thumb.width', '150', '', 'text', NULL, 'Small big thumb', 0),
(36, 0, 65, 'thumb_size.small_big_thumb.height', '150', '', 'text', NULL, '', 0),
(37, 0, 65, 'thumb_size.medium_big_thumb.width', '300', '', 'text', NULL, 'Medium big thumb', 0),
(38, 0, 65, 'thumb_size.medium_big_thumb.height', '260', '', 'text', NULL, '', 0),
(39, 0, 65, 'thumb_size.very_big_thumb.width', '600', '', 'text', NULL, 'Very big thumb', 0),
(40, 0, 65, 'thumb_size.very_big_thumb.height', '600', '', 'text', NULL, '', 0),
(41, 30, 5, 'user.is_admin_activate_after_register', '0', 'On enabling this feature, admin need to approve each user after registration (User cannot login until admin approves)', 'checkbox', NULL, 'Enable Administrator Approval After Registration', 3),
(42, 30, 5, 'user.is_email_verification_for_register', '0', 'On enabling this feature, user need to verify their email address provided during registration. (User cannot login until email address is verified)', 'checkbox', NULL, 'Enable Email Verification After Registration', 4),
(43, 30, 5, 'user.is_auto_login_after_register', '1', 'On enabling this feature, users will be automatically logged-in after registration. (Only when "Email Verification" & "Admin Approval" is disabled)', 'checkbox', NULL, 'Enable Auto Login After Registration', 5),
(44, 30, 5, 'user.is_admin_mail_after_register', '1', 'On enabling this feature, notification mail will be sent to administrator on each registration.', 'checkbox', NULL, 'Enable Notify Administrator on Each Registration', 6),
(45, 30, 5, 'user.is_welcome_mail_after_register', '1', 'On enabling this feature, users will receive a welcome mail after registration.', 'checkbox', NULL, 'Enable Sending Welcome Mail After Registration', 7),
(47, 30, 5, 'user.is_logout_after_change_password', '1', 'On enabling this feature, users will be asked to log-in again.', 'checkbox', NULL, 'Enable Auto-Logout After Password Change', 8),
(53, 29, 5, 'user.is_enable_openid', '1', 'On enabling this feature, users can authenticate their site account using OpenID.', 'checkbox', NULL, 'Enable OpenID', 2),
(303, 38, 7, 'connectcommerce.ftp_username', '', '', 'text', NULL, 'FTP Username', 3),
(304, 38, 7, 'connectcommerce.ftp_password', '', '', 'text', NULL, 'FTP Password', 4),
(300, 38, 7, 'connectcommerce.is_connectcommerce_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable Google Affiliates Network', 0),
(301, 38, 7, 'connectcommerce.ftp_host', '', '', 'text', NULL, 'FTP Host', 1),
(267, 39, 8, 'facebook.enable_facebook_post_coupon', '1', 'On enabling this feature, Post Newly Posted Coupon in Site''s Facebook Wall', 'checkbox', '', 'Post New Coupon on Facebook Wall', 6),
(268, 40, 8, 'twitter.enable_twitter_post_of_coupon', '1', 'On enabling this feature, Post Newly Posted Coupon in Site''s Twitter Account', 'checkbox', NULL, 'Post New Coupon on Twitter', 6),
(71, 23, 2, 'site.maintenance_mode', '0', 'On enabling this feature, only administrator can access the site (e.g., http://yourdomain.com/admin). Users will see a temporary page until you return to turn this off. (Turn this on, whenever you need to perform maintenance in the site.)', 'checkbox', NULL, 'Enable Maintenance Mode', 29),
(72, 26, 4, 'site.language', 'en', 'The selected language will be used as default language all over the site (also for emails)', 'select', NULL, 'Site Language', 4),
(73, 25, 3, 'site.robots', '', 'Content for robots.txt; (search engine) robots specific instructions. Refer,<a href="http://www.robotstxt.org/">http://www.robotstxt.org/</a> for syntax and usage.', 'textarea', NULL, 'robots.txt', 27),
(121, 29, 5, 'facebook.is_enabled_facebook_connect', '1', 'On enabling this feature, users can authenticate their site account using Facebook.', 'checkbox', NULL, 'Enable Facebook', 1),
(123, 39, 8, 'facebook.secrect_key', '', 'This is the Facebook secret key used for authentication', 'text', NULL, 'Secret Key', 2),
(176, 40, 8, 'twitter.consumer_key', '', 'This is the consumer key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer Key', 1),
(177, 40, 8, 'twitter.consumer_secret', '', 'This is the consumer secret key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer Secret Key', 2),
(179, 40, 8, 'twitter.site_user_access_key', '', 'This will be automatically updated when on clicking "Update Twitter Credentials" link. (Required for posting in Twitter)', 'text', NULL, 'Access Key', 3),
(180, 40, 8, 'twitter.site_user_access_token', '', 'This will be automatically updated when on clicking "Update Twitter Credentials" link. (Required for posting in Twitter)', 'text', NULL, 'Access Token', 4),
(58, 28, 4, 'site.time.format', '%I:%M %p', 'This is the time format which is displayed in our site.', 'text', NULL, 'Time Format', 8),
(59, 28, 4, 'site.date.tooltip', '%b %d, %Y %I:%M %p', 'This is the date tooltip format which is displayed in our site.', 'text', NULL, 'Date Tooltip Format', 7),
(60, 28, 4, 'site.time.tooltip', '%B %d, %Y (%A) %Z', 'This is the time tooltip format which is displayed in our site.', 'text', NULL, 'Time Tooltip Format', 9),
(61, 28, 4, 'site.datetime.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'This is the date-time tooltip format which is displayed in our site.', 'text', NULL, 'Date-Time Tooltip Format', 11),
(57, 28, 4, 'site.datetime.format', '%b %d, %Y %I:%M %p', 'This is the date-time format which is displayed in our site.', 'text', NULL, 'Date-Time Format', 10),
(56, 28, 4, 'site.date.format', '%b %d, %Y', 'This is the date format which is displayed in our site.', 'text', NULL, 'Date Format', 6),
(211, 29, 5, 'twitter.is_enabled_twitter_connect', '1', 'On enabling this feature, users can authenticate their site account using Twitter.', 'checkbox', NULL, 'Enable Twitter', 1),
(219, 22, 1, 'site.from_email', '', 'This is the email address that will appear in the "From" field of all emails sent from the site.', 'text', NULL, 'From Email Address', 13),
(220, 22, 1, 'site.reply_to_email', '', '"Reply-To" email header for all emails. Leave it empty to receive replies as usual (to "From" email address).', 'text', NULL, 'Reply To Email Address', 14),
(224, 39, 8, 'facebook.fb_access_token', '', 'This will be automatically updated when on clicking "Update Facebook Credentials" link. (Required for posting in Facebook)', 'text', NULL, 'Access Token', 3),
(225, 39, 8, 'facebook.fb_user_id', '', 'This will be automatically updated when on clicking "Update Facebook Credentials" link. (Required for posting in Facebook)', 'text', '', 'User ID', 4),
(229, 39, 8, 'facebook.app_id', '', 'This is the application ID used in login and post.', 'text', NULL, 'Application ID', 1),
(233, 23, 2, 'site.look_up_url', 'http://whois.sc/', 'URL prefix for whois lookup service. Will be used in whois links found in ##USER_LOGIN## pages to resolve users'' IP to where they are from&mdash;often down to the city or neighborhood or country. This is a security feature.', 'text', '', 'Whois Lookup URL', 15),
(203, 43, 9, 'suspicious_detector.suspiciouswords', 'stupid\nfool\n\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*\n^0[234679]{1}[\\s]{0,1}[\\-]{0,1}[\\s]{0,1}[1-9]{1}[0-9]{6}$\n', 'The suspicious words given will be matched with user given message and will be auto flagged if such words are found. (Note: Suspicious detection will be checked during coupon & store creation. Detection words should be newline separated.)', 'textarea', NULL, 'Suspicious Words', 0),
(235, 44, 9, 'coupon.auto_suspend_coupon_on_system_flag', '1', 'Auto suspended coupons will not display in site.', 'checkbox', NULL, 'Enable Auto Suspend Coupon On System Flag', 0),
(236, 44, 9, 'store.auto_suspend_store_on_system_flag', '1', 'Auto suspended stores will not display in site.', 'checkbox', NULL, 'Enable Auto Suspend Store On System Flag', 0),
(241, 39, 8, 'facebook.site_facebook_url', '', 'This is the site Facebook URL used displayed in the right sidebar.', 'text', 'NULL', 'Facebook Account URL', 5),
(242, 40, 8, 'twitter.site_twitter_url', '', 'This is the site Twitter URL used displayed in the sidebar.', 'text', NULL, 'Twitter Account URL', 5),
(252, 32, 6, 'displaysettings.coupon_display', 'Click to copy', 'This is the option used to specify how to display coupon. If "Click to reveal" is select coupon code will be hidden by an image. If "Click to copy" is select coupon code will be visible.', 'select', 'Click to copy, Click to reveal', 'Coupon Display Format', 1),
(251, 32, 6, 'coupon.point_value', '1', 'Number of points added for each feedback to user''s contribution.', 'text', NULL, 'Contribution Point', 7),
(254, 32, 6, 'coupon.shared_days', '7', 'Number of days to calculate latest coupons to display in user view page', 'text', NULL, 'Number of days for latest coupons', 8),
(256, 33, 7, 'linkshare.token', '', '', 'text', NULL, 'Link Share Token', 2),
(257, 34, 7, 'cj.websiteid', '', '', 'text', NULL, 'Website id', 3),
(258, 34, 7, 'cj.developerkey', '', '', 'text', NULL, 'Deveoper Key', 4),
(260, 32, 6, 'coupon.printable_coupons_limit', '10', 'Given number of printable coupons will be listed in single page', 'text', NULL, 'Printable Coupons Record Limit', 6),
(275, 45, 10, 'googleads.is_show_top_of_the_page', '1', 'On enabling this feature, ads will display below average discount in store view page.', 'checkbox', '', 'Enable ads display below average discount', 1),
(272, 0, 65, 'thumb_size.nano_thumb.width', '16', '', 'text', NULL, 'Nano  thumb', 0),
(273, 0, 65, 'thumb_size.nano_thumb.height', '16', '', 'text', NULL, '', 0),
(274, 17, 0, 'store.recent-visit-limit', '5', 'Store records display limit for recent visit store', 'text', NULL, 'Store Records  Display Limit for Recent Vistit Store', 1),
(276, 45, 10, 'googleads.is_show_ads at_the_ bottom_of_the_page', '1', 'On enabling this feature, ads will display below subscription box in store view page.', 'checkbox', '', 'Enable ads display below subscription', 1),
(278, 45, 10, 'googleads.is_show_mixed_of_the_page', '1', 'On enabling this feature, ads will display in between coupon list in store view page.', 'checkbox', '', 'Enable ads display in between coupons list', 1),
(279, 45, 10, 'googleads.no_of_records_display_between_ads', '2', 'After every given number of coupons ads will be displayed in between the store view page, if "Enable ads display in between coupons list" is enabled.', 'text', NULL, 'Number of records between coupons', 1),
(280, 0, 65, 'thumb_size.store_thumb.width', '65', '', 'text', NULL, 'Store  thumb', 0),
(281, 0, 65, 'thumb_size.store_thumb.height', '47', '', 'text', NULL, 'Store Thumb', 0),
(282, 0, 65, 'thumb_size.print_thumb.width', '94', '', 'text', NULL, 'Print thumb', 0),
(283, 0, 65, 'thumb_size.print_thumb.height', '67', '', 'text', NULL, '', 0),
(284, 0, 65, 'thumb_size.nano_medium_thumb.width', '32', '', 'text', NULL, 'nano_medium_thumb', 0),
(285, 0, 65, 'thumb_size.nano_medium_thumb.height', '32', '', 'text', NULL, 'nano_medium_thumb', 0),
(159, 0, 65, 'site.datetimehighlight.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'This is the date-time highlight tooltip format which is displayed in our site.', 'text', NULL, 'Date-Time Highlight Tooltip', 12),
(290, 31, 5, 'user.is_allow_user_to_switch_language', '1', 'On enabling this feature, users can change site language to their choice.', 'checkbox', '', 'Enable User to Switch Language', 14),
(291, 33, 7, 'linkshare.is_linkshare_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable Link Share', 0),
(292, 34, 7, 'cj.is_cj_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable Community Junction', 0),
(293, 27, 4, 'site.currency', '$', 'The entered currency symbol will be display in amount.', 'text', NULL, 'Site Currency Symbol', 4),
(294, 32, 6, 'coupon.is_downvote_restrict', '1', 'On disabling this feature, down vote option will be display for coupon.', 'checkbox', NULL, 'Restrict Down Vote', 2),
(295, 35, 7, 'pepperjam.is_pepperjam_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable PepperJam', 0),
(296, 35, 7, 'pepperjam.affiliate_id', '', '', 'text', NULL, 'Affiliate ID', 1),
(297, 42, 8, 'thumbalizr.api_key', '', '', 'text', NULL, 'API Key', 0),
(298, 32, 6, 'coupon.is_allow_coupon_flag', '1', 'On enabling this feature, guest or user can report about coupon.', 'checkbox', NULL, 'Enable Coupon Flag', 10),
(302, 38, 7, 'connectcommerce.ftp_port', '', '', 'text', NULL, 'FTP Port Number', 2),
(305, 32, 6, 'coupon.is_store_show_in_iframe', '1', 'On enabling this feature, store will display in Iframe instead of redirect to store URL when guest or user click coupon link.', 'checkbox', '', 'Store Show in Iframe', 2),
(308, 36, 7, 'shareasale.is_shareasale_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable ShareASale', 0),
(309, 36, 7, 'shareasale.affiliateID', '', '', 'text', NULL, 'Affiliate ID', 1),
(310, 36, 7, 'shareasale.token', '', '', 'text', NULL, 'Token', 2),
(311, 37, 7, 'formetocoupon.is_formetocoupon_enable', '1', 'On disabling this feature, our program will stop fetching the coupons & stores from feed and also coupons inserted via this affiliate will not display in site.', 'checkbox', NULL, 'Enable For Me To Coupon', 0),
(312, 37, 7, 'formetocoupon.access_key', '', '', 'text', NULL, 'Access Key', 1),
(313, 41, 8, 'google.translation_api_key', '', 'This is the configured Google Translate API key.', 'text', NULL, 'API Key', 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting_categories`
--

DROP TABLE IF EXISTS `setting_categories`;
CREATE TABLE IF NOT EXISTS `setting_categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` bigint(20) default '0',
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Setting Category Details';

--
-- Dumping data for table `setting_categories`
--

INSERT INTO `setting_categories` (`id`, `created`, `modified`, `parent_id`, `name`, `description`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'System', 'Manage site name, contact email, from email, reply to email.'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Developments', 'Manage Maintenance mode.'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'SEO', 'Manage content, meta data and other information relevant to browsers or search engines'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Regional, Currency & Language', 'Manage site default language, currency, date-time format and timezone'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Account', 'Manage different type of login option such as Facebook, Twitter, Yahoo and Gmail'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Coupons', 'Manage & configure settings related to coupons'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Affiliate', 'Manage affiliate sites such as CJ, Link Share, PepperJam.'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Third Party API', 'Manage third party settings such as Facebook, Twitter for authentication.'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Suspicious Words Detector', 'Manage Suspicious word detector feature, Auto suspend coupons on system flag, Auto suspend stores on system flag.'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Google Ads', 'Manage ads display in store list & view page'),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Site Information', 'Here you can modify site related settings such as site name.'),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'E-mails', 'Here you can modify email related settings such as contact email, from email, reply-to email.'),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'Server', 'Here you can change server settings such as maintenance mode.'),
(24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Metadata', 'Here you can set metadata settings such as meta keyword and description.'),
(25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'SEO', 'Here you can set SEO settings such as inserting tracker code and robots.'),
(26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Regional', 'Here you can change regional setting such as site language.'),
(27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Currency Settings', 'Here you can modify site currency settings such as default currency.'),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Date and Time', 'Here you can modify date time settings such as date time format.'),
(29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 'Logins', 'Here you can modify user login settings such as enabling 3rd party logins and other login options.'),
(30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 'Account Settings', 'Here you can modify account settings such as admin approval, email verification, and other site account settings.'),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 'Configuration', 'Here you can modify settings such as allowing user language change.'),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Configuration', 'Here you can modify coupon related settings such as enable coupon flag, records limit to display.'),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Link Share', 'To enable this you must have an existing account in this URL <a href="https://cli.linksynergy.com/cli/publisher/registration/registration.php">https://cli.linksynergy.com/cli/publisher/registration/registration.php</a>.'),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Community Junction', 'To enable this you must have an existing account in this URL <a href="http://www.cj.com/webservices/publisher-apis">http://www.cj.com/webservices/publisher-apis</a>'),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'PepperJam', 'To enable this you must have an existing account in this URL <a href="https://www.pepperjamnetwork.com/affiliate/registration.php">https://www.pepperjamnetwork.com/affiliate/registration.php</a>'),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'ShareASale', 'To enable this you must have an existing account in this URL <a href="https://www.shareasale.com/newsignup.cfm">https://www.shareasale.com/newsignup.cfm</a>'),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'For Me To Coupon', 'To enable this you must have an existing account in this URL <a href="http://www.formetocoupon.com/">http://www.formetocoupon.com/</a>'),
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Google Affiliates Network', 'To enable this you must have an existing account in this URL <a href="http://www.google.com/affiliatenetwork/ntn.html">http://www.google.com/affiliatenetwork/ntn.html</a>'),
(39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Facebook', 'Facebook is used for login and posting message using its account details. For doing above, our site must be configured with existing Facebook account. <a href="http://dev1products.dev.agriya.com/doku.php?id=facebook-setup"> http://dev1products.dev.agriya.com/doku.php?id=facebook-setup </a>'),
(40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Twitter', 'Twitter is used for login and posting message using its account details. For doing above, our site must be configured with existing Twitter account. <a href="http://dev1products.dev.agriya.com/doku.php?id=twitter-setup"> http://dev1products.dev.agriya.com/doku.php?id=twitter-setup </a>'),
(41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Google Translations', '<p>We use this service for quick translation to support new languages in ##TRANSLATIONADD##.</p> <p>Note that Google Translate API is now a <a href="http://code.google.com/apis/language/translate/v2/pricing.html" target="_blank">paid service</a>. Getting Api key, refer <a href="http://dev1products.dev.agriya.com/doku.php?id=google-translation-setup" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=google-translation-setup</a>.</p>'),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Thumbalizr', 'Register in this URL <a href="http://www.thumbalizr.com/apitools.php">http://www.thumbalizr.com/apitools.php</a> and get API key'),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 'Configuration', '<p>Here you can update the Suspicious Words Detector related settings.</p>\r\n<p>Here you can place various words, which accepts regular expressions also, to match with your terms and policies.  </p>\r\n<h4>Common Regular expressions</h4>\r\n<dl class="list clearfix">\r\n	<dt>Email</dt>\r\n<dd>\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*</dd>\r\n	<dt>Phone Number</dt>\r\n<dd>\r\n^0[234679]{1}[\\s]{0,1}[\\-]{0,1}[\\s]{0,1}[1-9]{1}[0-9]{6}$</dt>\r\n	<dt>URL</dt>\r\n<dd>((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\\\\\))+[\\w\\d:#@%/;$()~_?\\+-=\\\\\\.&]*)</dd>\r\n\r\n</dl>'),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 'Auto Suspend Module', 'Here you can modify auto suspend modules as stores & coupons.'),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 'Configuration', 'Here you can modify ads display related settings.');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) NOT NULL auto_increment,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(45) collate utf8_unicode_ci NOT NULL,
  `code` varchar(8) collate utf8_unicode_ci NOT NULL,
  `adm1code` char(4) collate utf8_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--


-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(250) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `sid` bigint(20) NOT NULL,
  `affiliate_site_id` bigint(20) NOT NULL default '1',
  `url` varchar(250) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(250) collate utf8_unicode_ci default NULL,
  `meta_description` text collate utf8_unicode_ci NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `latitude` float(10,6) default NULL,
  `longitude` float(10,6) default NULL,
  `admin_suspend` tinyint(1) NOT NULL,
  `is_manual_update` int(10) NOT NULL default '0',
  `is_system_flagged` bigint(20) NOT NULL,
  `detected_suspicious_words` varchar(255) collate utf8_unicode_ci NOT NULL,
  `coupon_count` bigint(20) default NULL,
  `out_link_count` bigint(20) default NULL,
  `store_view_count` bigint(20) default NULL,
  `coupon_impression_count` bigint(20) NOT NULL,
  `coupon_print_count` bigint(20) default NULL,
  `store_status_id` tinyint(2) NOT NULL,
  `is_featured` tinyint(2) NOT NULL,
  `is_thumblized` tinyint(1) NOT NULL default '0',
  `is_partner` tinyint(1) NOT NULL,
  `is_mail_sent` tinyint(1) NOT NULL,
  `average_discount` int(4) NOT NULL,
  `ip_id` bigint(20) default '0',
  `rank` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `slug` (`slug`),
  KEY `city_id` (`city_id`),
  KEY `store_status_id` (`store_status_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `ip_id` (`ip_id`),
  KEY `affiliate_site_id` (`affiliate_site_id`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stores`
--


-- --------------------------------------------------------

--
-- Table structure for table `store_statuses`
--

DROP TABLE IF EXISTS `store_statuses`;
CREATE TABLE IF NOT EXISTS `store_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store_statuses`
--

INSERT INTO `store_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'New Store'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active Store'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected Store');

-- --------------------------------------------------------

--
-- Table structure for table `store_views`
--

DROP TABLE IF EXISTS `store_views`;
CREATE TABLE IF NOT EXISTS `store_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL default '0',
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `store_id` (`store_id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `subnets`
--

DROP TABLE IF EXISTS `subnets`;
CREATE TABLE IF NOT EXISTS `subnets` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `subnet_address` varchar(11) collate utf8_unicode_ci NOT NULL,
  `certainty` smallint(6) default NULL,
  `city_id` bigint(20) default NULL,
  `state_id` bigint(20) default NULL,
  `country_id` bigint(20) default NULL,
  `dma_id` smallint(6) default NULL,
  `region_certainty` smallint(6) default NULL,
  `country_certainty` smallint(6) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subnets`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned default '0',
  `store_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_subscribed` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `store_id` (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscriptions`
--


-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `key` text collate utf8_unicode_ci NOT NULL,
  `lang_text` text collate utf8_unicode_ci NOT NULL,
  `is_translated` tinyint(1) NOT NULL,
  `is_google_translate` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Are you sure you want to', 'Are you sure you want to', 0, 0, 0),
(2, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Cool, how much did you save?', 'Cool, how much did you save?', 0, 0, 0),
(3, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'And I purchased a...', 'And I purchased a...', 0, 0, 0),
(4, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Share Result', 'Share Result', 0, 0, 0),
(5, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Nice one- thanks for sharing!', 'Nice one- thanks for sharing!', 0, 0, 0),
(6, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Tell the World:', 'Tell the World:', 0, 0, 0),
(7, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'sa', 'sa', 0, 0, 0),
(8, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Sorry. We have disabled this action in demo mode', 'Sorry. We have disabled this action in demo mode', 0, 0, 0),
(9, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Invalid request', 'Invalid request', 0, 0, 0),
(10, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Site is in maintenance mode', 'Site is in maintenance mode', 0, 0, 0),
(11, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Authorisation Required', 'Authorisation Required', 0, 0, 0),
(12, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been deactivated', 'Checked records has been deactivated', 0, 0, 0),
(13, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been activated', 'Checked records has been activated', 0, 0, 0),
(14, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been disapproved', 'Checked records has been disapproved', 0, 0, 0),
(15, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been approved', 'Checked records has been approved', 0, 0, 0),
(16, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been Suspended', 'Checked records has been Suspended', 0, 0, 0),
(17, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been changed to Unsuspended', 'Checked records has been changed to Unsuspended', 0, 0, 0),
(18, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been deleted', 'Checked records has been deleted', 0, 0, 0),
(19, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Store status changed into \\"New store\\"', 'Store status changed into \\"New store\\"', 0, 0, 0),
(20, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Store status changed into \\"Active store\\"', 'Store status changed into \\"Active store\\"', 0, 0, 0),
(21, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Store status changed into \\"Rejected store\\"', 'Store status changed into \\"Rejected store\\"', 0, 0, 0),
(22, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Store status changed into \\"Partner\\"', 'Store status changed into \\"Partner\\"', 0, 0, 0),
(23, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Checked records has been unsubscribed', 'Checked records has been unsubscribed', 0, 0, 0),
(24, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Clicked records has been changed to unflagged', 'Clicked records has been changed to unflagged', 0, 0, 0),
(25, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Clicked records has been changed to flagged', 'Clicked records has been changed to flagged', 0, 0, 0),
(26, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Clicked records has been suspended', 'Clicked records has been suspended', 0, 0, 0),
(27, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Clicked records has been changed to unsuspended', 'Clicked records has been changed to unsuspended', 0, 0, 0),
(28, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, ' - Rated today', ' - Rated today', 0, 0, 0),
(29, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, ' - Rated in this week', ' - Rated in this week', 0, 0, 0),
(30, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, ' - Rated in this month', ' - Rated in this month', 0, 0, 0),
(31, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, '[Image: %s]', '[Image: %s]', 0, 0, 0),
(32, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'shared a new coupon in \\"', 'shared a new coupon in \\"', 0, 0, 0),
(33, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, '\\" in ', '\\" in ', 0, 0, 0),
(34, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'admin', 'admin', 0, 0, 0),
(35, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'shared a new store  \\"', 'shared a new store  \\"', 0, 0, 0),
(36, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'user ', 'user ', 0, 0, 0),
(37, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'guest user', 'guest user', 0, 0, 0),
(38, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Sorry, file can not open', 'Sorry, file can not open', 0, 0, 0),
(39, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Store imported successfully', 'Store imported successfully', 0, 0, 0),
(40, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Coupon imported successfully', 'Coupon imported successfully', 0, 0, 0),
(41, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Banned IPs', 'Banned IPs', 0, 0, 0),
(42, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Add Banned IP', 'Add Banned IP', 0, 0, 0),
(43, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Must be a valid URL', 'Must be a valid URL', 0, 0, 0),
(44, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Banned IP has been added', 'Banned IP has been added', 0, 0, 0),
(45, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Banned IP could not be added. Please, try again', 'Banned IP could not be added. Please, try again', 0, 0, 0),
(46, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'You cannot add your IP address. Please, try again', 'You cannot add your IP address. Please, try again', 0, 0, 0),
(47, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'You cannot add your own domain. Please, try again', 'You cannot add your own domain. Please, try again', 0, 0, 0),
(48, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Banned IP deleted', 'Banned IP deleted', 0, 0, 0),
(49, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Categories', 'Categories', 0, 0, 0),
(50, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, ' - Search - %s', ' - Search - %s', 0, 0, 0),
(51, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Add Category', 'Add Category', 0, 0, 0),
(52, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Category has been added', 'Category has been added', 0, 0, 0),
(53, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Category could not be added. Please, try again.', 'Category could not be added. Please, try again.', 0, 0, 0),
(54, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Edit Category', 'Edit Category', 0, 0, 0),
(55, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Category has been updated', 'Category has been updated', 0, 0, 0),
(56, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Category could not be updated. Please, try again.', 'Category could not be updated. Please, try again.', 0, 0, 0),
(57, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Category has been deleted', 'Category has been deleted', 0, 0, 0),
(58, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Last 7 days', 'Last 7 days', 0, 0, 0),
(59, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Last 4 weeks', 'Last 4 weeks', 0, 0, 0),
(60, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Last 3 months', 'Last 3 months', 0, 0, 0),
(61, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Last 3 years', 'Last 3 years', 0, 0, 0),
(62, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Normal', 'Normal', 0, 0, 0),
(63, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'All', 'All', 0, 0, 0),
(64, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Twitter', 'Twitter', 0, 0, 0),
(65, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Facebook', 'Facebook', 0, 0, 0),
(66, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'OpenID', 'OpenID', 0, 0, 0),
(67, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Gmail', 'Gmail', 0, 0, 0),
(68, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Yahoo', 'Yahoo', 0, 0, 0),
(69, '2011-12-30 12:56:52', '2011-12-30 12:56:52', 42, 'Not Mentioned', 'Not Mentioned', 0, 0, 0),
(70, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '18 - 34 Yrs', '18 - 34 Yrs', 0, 0, 0),
(71, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '35 - 44 Yrs', '35 - 44 Yrs', 0, 0, 0),
(72, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '45 - 54 Yrs', '45 - 54 Yrs', 0, 0, 0),
(73, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '55+ Yrs', '55+ Yrs', 0, 0, 0),
(74, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Cities', 'Cities', 0, 0, 0),
(75, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Approved', ' - Approved', 0, 0, 0),
(76, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Unapproved', ' - Unapproved', 0, 0, 0),
(77, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit City', 'Edit City', 0, 0, 0),
(78, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'City has been updated', 'City has been updated', 0, 0, 0),
(79, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'City could not be updated. Please, try again.', 'City could not be updated. Please, try again.', 0, 0, 0),
(80, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add City', 'Add City', 0, 0, 0),
(81, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' City has been added', ' City has been added', 0, 0, 0),
(82, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' City could not be added. Please, try again.', ' City could not be added. Please, try again.', 0, 0, 0),
(83, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'City deleted', 'City deleted', 0, 0, 0),
(84, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Thank you, we received your message and will get back to you as soon as possible.', 'Thank you, we received your message and will get back to you as soon as possible.', 0, 0, 0),
(85, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Contact Us', 'Contact Us', 0, 0, 0),
(86, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Countries', 'Countries', 0, 0, 0),
(87, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Country', 'Add Country', 0, 0, 0),
(88, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Country has been added', 'Country has been added', 0, 0, 0),
(89, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Country could not be updated. Please, try again', 'Country could not be updated. Please, try again', 0, 0, 0),
(90, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Country', 'Edit Country', 0, 0, 0),
(91, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Country has been updated', 'Country has been updated', 0, 0, 0),
(92, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Country could not be updated. Please, try again.', 'Country could not be updated. Please, try again.', 0, 0, 0),
(93, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Country deleted', 'Country deleted', 0, 0, 0),
(94, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Comments', 'Coupon Comments', 0, 0, 0),
(95, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Comment', 'Coupon Comment', 0, 0, 0),
(96, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Coupon Comment', 'Add Coupon Comment', 0, 0, 0),
(97, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Comment has been added', 'Coupon Comment has been added', 0, 0, 0),
(98, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Comment could not be added. Please, try again.', 'Coupon Comment could not be added. Please, try again.', 0, 0, 0),
(99, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Comment deleted', 'Coupon Comment deleted', 0, 0, 0),
(100, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Coupon Favorite', 'Add Coupon Favorite', 0, 0, 0),
(101, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Favorite has been added', 'Coupon Favorite has been added', 0, 0, 0),
(102, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Favorite is already has been added', 'Coupon Favorite is already has been added', 0, 0, 0),
(103, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Favorite deleted', 'Coupon Favorite deleted', 0, 0, 0),
(104, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Favorites', 'Coupon Favorites', 0, 0, 0),
(105, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Added today', ' - Added today', 0, 0, 0),
(106, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Added in this week', ' - Added in this week', 0, 0, 0),
(107, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Added in this month', ' - Added in this month', 0, 0, 0),
(108, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Coupon Feedback', 'Add Coupon Feedback', 0, 0, 0),
(109, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Feedback has been added', 'Coupon Feedback has been added', 0, 0, 0),
(110, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Feedback could not be added. Please, try again.', 'Coupon Feedback could not be added. Please, try again.', 0, 0, 0),
(111, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Feedbacks', 'Coupon Feedbacks', 0, 0, 0),
(112, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Feedback deleted', 'Coupon Feedback deleted', 0, 0, 0),
(113, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Flag Categories', 'Coupon Flag Categories', 0, 0, 0),
(114, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add', 'Add', 0, 0, 0),
(115, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category', 'Flag Category', 0, 0, 0),
(116, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category has been added', 'Flag Category has been added', 0, 0, 0),
(117, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category could not be added. Please, try again.', 'Flag Category could not be added. Please, try again.', 0, 0, 0),
(118, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Flag Category', 'Edit Flag Category', 0, 0, 0),
(119, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category has been updated', 'Flag Category has been updated', 0, 0, 0),
(120, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category could not be updated. Please, try again.', 'Flag Category could not be updated. Please, try again.', 0, 0, 0),
(121, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag Category deleted', 'Flag Category deleted', 0, 0, 0),
(122, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag has been added', 'Flag has been added', 0, 0, 0),
(123, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag could not be added. Please, try again.', 'Flag could not be added. Please, try again.', 0, 0, 0),
(124, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flags', 'Flags', 0, 0, 0),
(125, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Category - %s', ' - Category - %s', 0, 0, 0),
(126, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - User Flagged ', ' - User Flagged ', 0, 0, 0),
(127, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Flag has been cleared', 'Flag has been cleared', 0, 0, 0),
(128, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Impressions', 'Coupon Impressions', 0, 0, 0),
(129, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Impression deleted', 'Coupon Impression deleted', 0, 0, 0),
(130, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Tags', 'Coupon Tags', 0, 0, 0),
(131, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon Views', 'Coupon Views', 0, 0, 0),
(132, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon View deleted', 'Coupon View deleted', 0, 0, 0),
(133, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' coupon codes. Find and share  coupons, discounts and promotion codes for  ', ' coupon codes. Find and share  coupons, discounts and promotion codes for  ', 0, 0, 0),
(134, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Free Shipping Deals - Coupons and  Discounts for Free Shipping', 'Free Shipping Deals - Coupons and  Discounts for Free Shipping', 0, 0, 0),
(135, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Printable ', 'Printable ', 0, 0, 0),
(136, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' Coupons', ' Coupons', 0, 0, 0),
(137, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Printable Coupons ZIP ', 'Printable Coupons ZIP ', 0, 0, 0),
(138, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'where', 'where', 0, 0, 0),
(139, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'category', 'category', 0, 0, 0),
(140, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Recent Coupons', ' - Recent Coupons', 0, 0, 0),
(141, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Expiry Coupons', ' - Expiry Coupons', 0, 0, 0),
(142, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '  free printable coupons', '  free printable coupons', 0, 0, 0),
(143, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Latest Coupons', 'Latest Coupons', 0, 0, 0),
(144, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon', 'Coupon', 0, 0, 0),
(145, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Coupon', 'Add Coupon', 0, 0, 0),
(146, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon has been added.', 'Coupon has been added.', 0, 0, 0),
(147, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon could not be added. Please, try again.', 'Coupon could not be added. Please, try again.', 0, 0, 0),
(148, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'example.com', 'example.com', 0, 0, 0),
(149, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Free shipping', 'Free shipping', 0, 0, 0),
(150, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupons', 'Coupons', 0, 0, 0),
(151, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '- Category  - %s', '- Category  - %s', 0, 0, 0),
(152, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, '- Store  - %s', '- Store  - %s', 0, 0, 0),
(153, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Simillar tags and stores', 'Simillar tags and stores', 0, 0, 0),
(154, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Coupon', 'Edit Coupon', 0, 0, 0),
(155, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon has been updated.', 'Coupon has been updated.', 0, 0, 0),
(156, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon could not be updated. Please, try again.', 'Coupon could not be updated. Please, try again.', 0, 0, 0),
(157, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon deleted', 'Coupon deleted', 0, 0, 0),
(158, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'CSV Import', 'CSV Import', 0, 0, 0),
(159, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'You have to attach the file or direct url of csv has to give', 'You have to attach the file or direct url of csv has to give', 0, 0, 0),
(160, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupons has been imported successfully', 'Coupons has been imported successfully', 0, 0, 0),
(161, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupons not imported', 'Coupons not imported', 0, 0, 0),
(162, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Checked coupons has been deleted', 'Checked coupons has been deleted', 0, 0, 0),
(163, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupon and user status updated successfully', 'Coupon and user status updated successfully', 0, 0, 0),
(164, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Coupons imported from affiliate sites successfully', 'Coupons imported from affiliate sites successfully', 0, 0, 0),
(165, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Email Templates', 'Email Templates', 0, 0, 0),
(166, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Email Template', 'Edit Email Template', 0, 0, 0),
(167, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Email Template has been updated', 'Email Template has been updated', 0, 0, 0),
(168, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Email Template could not be updated. Please, try again.', 'Email Template could not be updated. Please, try again.', 0, 0, 0),
(169, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ads', 'Google Ads', 0, 0, 0),
(170, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Google Ad', 'Add Google Ad', 0, 0, 0),
(171, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ad has been added', 'Google Ad has been added', 0, 0, 0),
(172, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ad could not be added. Please, try again.', 'Google Ad could not be added. Please, try again.', 0, 0, 0),
(173, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Google Ad', 'Edit Google Ad', 0, 0, 0),
(174, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ad has been updated', 'Google Ad has been updated', 0, 0, 0),
(175, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ad could not be updated. Please, try again.', 'Google Ad could not be updated. Please, try again.', 0, 0, 0),
(176, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Google Ad deleted', 'Google Ad deleted', 0, 0, 0),
(177, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'IPs', 'IPs', 0, 0, 0),
(178, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Ip deleted', 'Ip deleted', 0, 0, 0),
(179, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Languages', 'Languages', 0, 0, 0),
(180, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Language', 'Add Language', 0, 0, 0),
(181, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Language has been added', 'Language has been added', 0, 0, 0),
(182, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Language could not be added. Please, try again.', 'Language could not be added. Please, try again.', 0, 0, 0),
(183, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Language', 'Edit Language', 0, 0, 0),
(184, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Language  has been updated', 'Language  has been updated', 0, 0, 0),
(185, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Language  could not be updated. Please, try again.', 'Language  could not be updated. Please, try again.', 0, 0, 0),
(186, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Add Page', 'Add Page', 0, 0, 0),
(187, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Page has been created', 'Page has been created', 0, 0, 0),
(188, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Page could not be added. Please, try again.', 'Page could not be added. Please, try again.', 0, 0, 0),
(189, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Edit Page', 'Edit Page', 0, 0, 0),
(190, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Page has been Updated', 'Page has been Updated', 0, 0, 0),
(191, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Page could not be Updated. Please, try again.', 'Page could not be Updated. Please, try again.', 0, 0, 0),
(192, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Manage Static Pages', 'Manage Static Pages', 0, 0, 0),
(193, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Page Deleted Successfully', 'Page Deleted Successfully', 0, 0, 0),
(194, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Home', 'Home', 0, 0, 0),
(195, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Search Keywords', 'Search Keywords', 0, 0, 0),
(196, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Search today', ' - Search today', 0, 0, 0),
(197, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Search in this week', ' - Search in this week', 0, 0, 0),
(198, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Search in this month', ' - Search in this month', 0, 0, 0),
(199, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Search Keyword deleted', 'Search Keyword deleted', 0, 0, 0),
(200, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Search Logs', 'Search Logs', 0, 0, 0),
(201, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Registered today', ' - Registered today', 0, 0, 0),
(202, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Registered in this week', ' - Registered in this week', 0, 0, 0),
(203, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, ' - Registered in this month', ' - Registered in this month', 0, 0, 0),
(204, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Search Log deleted', 'Search Log deleted', 0, 0, 0),
(205, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Settings', 'Settings', 0, 0, 0),
(206, '2011-12-30 12:56:53', '2011-12-30 12:56:53', 42, 'Settings updated successfully.', 'Settings updated successfully.', 0, 0, 0),
(207, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Sorry. You Cannot Update the Settings in Demo Mode', 'Sorry. You Cannot Update the Settings in Demo Mode', 0, 0, 0),
(208, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' Settings', ' Settings', 0, 0, 0),
(209, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Update Facebook', 'Update Facebook', 0, 0, 0),
(210, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Update Twitter', 'Update Twitter', 0, 0, 0),
(211, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Facebook credentials updated', 'Facebook credentials updated', 0, 0, 0),
(212, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Facebook credentials could not be updated. Please, try again.', 'Facebook credentials could not be updated. Please, try again.', 0, 0, 0),
(213, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'PNG images crushed successfully', 'PNG images crushed successfully', 0, 0, 0),
(214, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'States', 'States', 0, 0, 0),
(215, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add State', 'Add State', 0, 0, 0),
(216, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'State has been added', 'State has been added', 0, 0, 0),
(217, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'State could not be added. Please, try again.', 'State could not be added. Please, try again.', 0, 0, 0),
(218, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit State', 'Edit State', 0, 0, 0),
(219, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'State has been updated', 'State has been updated', 0, 0, 0),
(220, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'State could not be updated. Please, try again.', 'State could not be updated. Please, try again.', 0, 0, 0),
(221, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'State deleted', 'State deleted', 0, 0, 0),
(222, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store Statuses', 'Store Statuses', 0, 0, 0),
(223, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit Store Status', 'Edit Store Status', 0, 0, 0),
(224, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store Status has been updated', 'Store Status has been updated', 0, 0, 0),
(225, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store Status could not be updated. Please, try again.', 'Store Status could not be updated. Please, try again.', 0, 0, 0),
(226, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store Status deleted', 'Store Status deleted', 0, 0, 0),
(227, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store Views', 'Store Views', 0, 0, 0),
(228, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store View deleted', 'Store View deleted', 0, 0, 0),
(229, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Favorite Coupons', 'Favorite Coupons', 0, 0, 0),
(230, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Popular Stores', 'Popular Stores', 0, 0, 0),
(231, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' Coupon Codes - all coupons , discounts and promo codes for ', ' Coupon Codes - all coupons , discounts and promo codes for ', 0, 0, 0),
(232, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Stores', 'Stores', 0, 0, 0),
(233, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - New Store ', ' - New Store ', 0, 0, 0),
(234, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Active Store ', ' - Active Store ', 0, 0, 0),
(235, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Rejected Store ', ' - Rejected Store ', 0, 0, 0),
(236, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Partner ', ' - Partner ', 0, 0, 0),
(237, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Manaully Updated Store ', ' - Manaully Updated Store ', 0, 0, 0),
(238, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Auto Updated Store ', ' - Auto Updated Store ', 0, 0, 0),
(239, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add Store', 'Add Store', 0, 0, 0),
(240, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store has been added', 'Store has been added', 0, 0, 0),
(241, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store could not be added. Please, try again.', 'Store could not be added. Please, try again.', 0, 0, 0),
(242, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit Store', 'Edit Store', 0, 0, 0),
(243, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store has been updated', 'Store has been updated', 0, 0, 0),
(244, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store could not be updated. Please, try again.', 'Store could not be updated. Please, try again.', 0, 0, 0),
(245, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Store deleted', 'Store deleted', 0, 0, 0),
(246, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Stores has been imported successfully', 'Stores has been imported successfully', 0, 0, 0),
(247, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Stores not imported', 'Stores not imported', 0, 0, 0),
(248, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add Subscription', 'Add Subscription', 0, 0, 0),
(249, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Thanks, check your email for confirmation...', 'Thanks, check your email for confirmation...', 0, 0, 0),
(250, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'We sent mail for confirmation', 'We sent mail for confirmation', 0, 0, 0),
(251, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'You are already subscribed', 'You are already subscribed', 0, 0, 0),
(252, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Subscribe', 'Subscribe', 0, 0, 0),
(253, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Unsubscribe', 'Unsubscribe', 0, 0, 0),
(254, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Please provide a subscribed email', 'Please provide a subscribed email', 0, 0, 0),
(255, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'You have unsubscribed from the subscribers list', 'You have unsubscribed from the subscribers list', 0, 0, 0),
(256, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Subscriptions', 'Subscriptions', 0, 0, 0),
(257, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Subscribed Users', 'Subscribed Users', 0, 0, 0),
(258, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Unsubscribed Users', 'Unsubscribed Users', 0, 0, 0),
(259, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Subscription deleted', 'Subscription deleted', 0, 0, 0),
(260, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Activate your account', 'Activate your account', 0, 0, 0),
(261, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Invalid activation request, please register again', 'Invalid activation request, please register again', 0, 0, 0),
(262, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'You have successfully confirmed your subscription.', 'You have successfully confirmed your subscription.', 0, 0, 0),
(263, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translations', 'Translations', 0, 0, 0),
(264, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation deleted successfully', 'Translation deleted successfully', 0, 0, 0),
(265, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation', 'Translation', 0, 0, 0),
(266, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add New Language Variable', 'Add New Language Variable', 0, 0, 0),
(267, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Language variables has been added', 'Language variables has been added', 0, 0, 0),
(268, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Language variables could not be added', 'Language variables could not be added', 0, 0, 0),
(269, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add Translation', 'Add Translation', 0, 0, 0),
(270, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Default English variable is missing', 'Default English variable is missing', 0, 0, 0),
(271, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation could not be updated. Please, try again.', 'Translation could not be updated. Please, try again.', 0, 0, 0),
(272, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation could not be updated. Please check iso2 of this language and try again', 'Translation could not be updated. Please check iso2 of this language and try again', 0, 0, 0),
(273, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation has been added', 'Translation has been added', 0, 0, 0),
(274, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit Translation', 'Edit Translation', 0, 0, 0),
(275, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, '\\"%s\\" Translation has been updated', '\\"%s\\" Translation has been updated', 0, 0, 0),
(276, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, '\\"%s\\" Translation could not be updated. Please, try again.', '\\"%s\\" Translation could not be updated. Please, try again.', 0, 0, 0),
(277, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation deleted', 'Translation deleted', 0, 0, 0),
(278, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit Translations', 'Edit Translations', 0, 0, 0),
(279, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Translation updated successfully', 'Translation updated successfully', 0, 0, 0),
(280, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Verified ', ' - Verified ', 0, 0, 0),
(281, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, ' - Unverified ', ' - Unverified ', 0, 0, 0),
(282, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'User Comments', 'User Comments', 0, 0, 0),
(283, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'User Comment', 'User Comment', 0, 0, 0),
(284, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Add User Comment', 'Add User Comment', 0, 0, 0),
(285, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'User Comment has been added', 'User Comment has been added', 0, 0, 0),
(286, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'User Comment could not be added. Please, try again.', 'User Comment could not be added. Please, try again.', 0, 0, 0),
(287, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'User Comment deleted', 'User Comment deleted', 0, 0, 0),
(288, '2011-12-30 12:56:54', '2011-12-30 12:56:54', 42, 'Edit User Comment', 'Edit User Comment', 0, 0, 0),
(289, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Comment has been updated', 'User Comment has been updated', 0, 0, 0),
(290, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Comment could not be updated. Please, try again.', 'User Comment could not be updated. Please, try again.', 0, 0, 0),
(291, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Login through OpenID ', ' - Login through OpenID ', 0, 0, 0),
(292, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Active ', ' - Active ', 0, 0, 0),
(293, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Login through Twitter ', ' - Login through Twitter ', 0, 0, 0),
(294, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Login through Facebook ', ' - Login through Facebook ', 0, 0, 0),
(295, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Login through Gmail ', ' - Login through Gmail ', 0, 0, 0),
(296, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Login through Yahoo ', ' - Login through Yahoo ', 0, 0, 0),
(297, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Inactive ', ' - Inactive ', 0, 0, 0),
(298, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Normal Users ', ' - Normal Users ', 0, 0, 0),
(299, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Logins', 'User Logins', 0, 0, 0),
(300, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Login deleted', 'User Login deleted', 0, 0, 0),
(301, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Openids', 'User Openids', 0, 0, 0),
(302, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Add New Openid', 'Add New Openid', 0, 0, 0),
(303, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Authenticated failed or you may not have profile in your OpenID account', 'Authenticated failed or you may not have profile in your OpenID account', 0, 0, 0),
(304, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Openid has been added', 'User Openid has been added', 0, 0, 0),
(305, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Openid could not be added. Please, try again.', 'User Openid could not be added. Please, try again.', 0, 0, 0),
(306, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid OpenID', 'Invalid OpenID', 0, 0, 0),
(307, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Openid deleted', 'User Openid deleted', 0, 0, 0),
(308, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 0, 0, 0),
(309, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Edit Profile', 'Edit Profile', 0, 0, 0),
(310, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Profile has been updated', 'User Profile has been updated', 0, 0, 0),
(311, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'The file uploaded is too big, only files less than %s permitted', 'The file uploaded is too big, only files less than %s permitted', 0, 0, 0),
(312, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Profile could not be updated. Please, try again.', 'User Profile could not be updated. Please, try again.', 0, 0, 0),
(313, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Views', 'User Views', 0, 0, 0),
(314, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User View deleted', 'User View deleted', 0, 0, 0),
(315, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Community', 'Community', 0, 0, 0),
(316, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' Community Profile', ' Community Profile', 0, 0, 0),
(317, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User Registration', 'User Registration', 0, 0, 0),
(318, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Your registration process is not completed. Please, try again.', 'Your registration process is not completed. Please, try again.', 0, 0, 0),
(319, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You have successfully registered with our site.', 'You have successfully registered with our site.', 0, 0, 0),
(320, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 0, 0, 0),
(321, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Your verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 'Your verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 0, 0, 0),
(322, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid activation request', 'Invalid activation request', 0, 0, 0),
(323, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You have successfully activated your account. But you can login after admin activate your account.', 'You have successfully activated your account. But you can login after admin activate your account.', 0, 0, 0),
(324, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You have successfully activated and logged in to your account.', 'You have successfully activated and logged in to your account.', 0, 0, 0),
(325, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Activation mail has been resent.', 'Activation mail has been resent.', 0, 0, 0),
(326, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'A Mail for activating your account has been sent.', 'A Mail for activating your account has been sent.', 0, 0, 0),
(327, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Try some time later as mail could not be dispatched due to some error in the server', 'Try some time later as mail could not be dispatched due to some error in the server', 0, 0, 0),
(328, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid resend activation request, please register again', 'Invalid resend activation request, please register again', 0, 0, 0),
(329, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Problem in Facebook connect. Please try again', 'Problem in Facebook connect. Please try again', 0, 0, 0),
(330, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid Facebook Connection.', 'Invalid Facebook Connection.', 0, 0, 0),
(331, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Login', 'Login', 0, 0, 0),
(332, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Sorry, login failed. Your ', 'Sorry, login failed. Your ', 0, 0, 0),
(333, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' or password are incorrect', ' or password are incorrect', 0, 0, 0),
(334, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Sorry, login failed.  Your %s or password are incorrect', 'Sorry, login failed.  Your %s or password are incorrect', 0, 0, 0),
(335, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Required', 'Required', 0, 0, 0),
(336, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid OpenID entered. Please enter valid OpenID', 'Invalid OpenID entered. Please enter valid OpenID', 0, 0, 0),
(337, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Problem in Twitter connect. Please try again', 'Problem in Twitter connect. Please try again', 0, 0, 0),
(338, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Your Twitter credentials are updated', 'Your Twitter credentials are updated', 0, 0, 0),
(339, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You are now logged out of the site.', 'You are now logged out of the site.', 0, 0, 0),
(340, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Forgot Password', 'Forgot Password', 0, 0, 0),
(341, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'An email has been sent with a link where you can change your password', 'An email has been sent with a link where you can change your password', 0, 0, 0),
(342, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'There is no user registered with the email ', 'There is no user registered with the email ', 0, 0, 0),
(343, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.', 'There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.', 0, 0, 0),
(344, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Reset Password', 'Reset Password', 0, 0, 0),
(345, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Your password has been changed successfully, Please login now', 'Your password has been changed successfully, Please login now', 0, 0, 0),
(346, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Invalid change password request', 'Invalid change password request', 0, 0, 0),
(347, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User cannot be found in server or admin deactivated your account, please register again', 'User cannot be found in server or admin deactivated your account, please register again', 0, 0, 0),
(348, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Change Password', 'Change Password', 0, 0, 0),
(349, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Your password has been changed successfully. Please login now', 'Your password has been changed successfully. Please login now', 0, 0, 0),
(350, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Password has been changed successfully', 'Password has been changed successfully', 0, 0, 0),
(351, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Password could not be changed', 'Password could not be changed', 0, 0, 0),
(352, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Referrer username does not exist.', 'Referrer username does not exist.', 0, 0, 0),
(353, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Active', 'Active', 0, 0, 0),
(354, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Inactive', 'Inactive', 0, 0, 0),
(355, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Yes', 'Yes', 0, 0, 0),
(356, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'No', 'No', 0, 0, 0),
(357, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Users', 'Users', 0, 0, 0),
(358, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Registered through OpenID ', ' - Registered through OpenID ', 0, 0, 0),
(359, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Registered through Gmail ', ' - Registered through Gmail ', 0, 0, 0),
(360, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Registered through Yahoo ', ' - Registered through Yahoo ', 0, 0, 0),
(361, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Registered through Twitter ', ' - Registered through Twitter ', 0, 0, 0),
(362, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, ' - Registered through Facebook ', ' - Registered through Facebook ', 0, 0, 0),
(363, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Add New User/Admin', 'Add New User/Admin', 0, 0, 0),
(364, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User has been added', 'User has been added', 0, 0, 0),
(365, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User could not be added. Please, try again.', 'User could not be added. Please, try again.', 0, 0, 0),
(366, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'User has been deleted', 'User has been deleted', 0, 0, 0),
(367, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Checked users has been inactivated', 'Checked users has been inactivated', 0, 0, 0),
(368, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Checked users has been activated', 'Checked users has been activated', 0, 0, 0),
(369, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Checked users has been deleted', 'Checked users has been deleted', 0, 0, 0),
(370, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Snapshot', 'Snapshot', 0, 0, 0),
(371, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Email to users', 'Email to users', 0, 0, 0),
(372, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Email sent successfully', 'Email sent successfully', 0, 0, 0),
(373, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Email sent successfully. Some emails are not sent', 'Email sent successfully. Some emails are not sent', 0, 0, 0),
(374, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'No email send', 'No email send', 0, 0, 0),
(375, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Email couldn''t be sent! Enter all required fields', 'Email couldn''t be sent! Enter all required fields', 0, 0, 0),
(376, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Contact us - Reply', 'Contact us - Reply', 0, 0, 0),
(377, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Re:', 'Re:', 0, 0, 0),
(378, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Diagnostics', 'Diagnostics', 0, 0, 0),
(379, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Enter number higher than 0', 'Enter number higher than 0', 0, 0, 0),
(380, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You cannot add your own domain in redirect URL', 'You cannot add your own domain in redirect URL', 0, 0, 0),
(381, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Must be a valid URL, starting with http://', 'Must be a valid URL, starting with http://', 0, 0, 0),
(382, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Single IP or hostname', 'Single IP or hostname', 0, 0, 0),
(383, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'IP Range', 'IP Range', 0, 0, 0),
(384, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Referer block', 'Referer block', 0, 0, 0),
(385, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Permanent', 'Permanent', 0, 0, 0),
(386, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Day(s)', 'Day(s)', 0, 0, 0),
(387, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Week(s)', 'Week(s)', 0, 0, 0),
(388, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Delete', 'Delete', 0, 0, 0),
(389, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Category name already exists', 'Category name already exists', 0, 0, 0),
(390, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Unapproved', 'Unapproved', 0, 0, 0),
(391, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Approved', 'Approved', 0, 0, 0),
(392, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Must be a valid email', 'Must be a valid email', 0, 0, 0),
(393, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Please enter valid captcha', 'Please enter valid captcha', 0, 0, 0),
(394, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Give numeric format', 'Give numeric format', 0, 0, 0),
(395, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Requires', 'Requires', 0, 0, 0),
(396, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Enter valid URL', 'Enter valid URL', 0, 0, 0),
(397, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Should be greater than today date', 'Should be greater than today date', 0, 0, 0),
(398, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Should be valid date', 'Should be valid date', 0, 0, 0),
(399, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'End date must be greater than start date', 'End date must be greater than start date', 0, 0, 0),
(400, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'You have to check ongoing, if there is no start and end date', 'You have to check ongoing, if there is no start and end date', 0, 0, 0),
(401, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Special Offer', 'Special Offer', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(402, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Unreliable Coupon', 'Unreliable Coupon', 0, 0, 0),
(403, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Normal coupon', 'Normal coupon', 0, 0, 0),
(404, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Coupon Code', 'Coupon Code', 0, 0, 0),
(405, '2011-12-30 12:56:55', '2011-12-30 12:56:55', 42, 'Shopping Tips', 'Shopping Tips', 0, 0, 0),
(406, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Printable Coupon', 'Printable Coupon', 0, 0, 0),
(407, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Check Store', 'Check Store', 0, 0, 0),
(408, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'New Coupon', 'New Coupon', 0, 0, 0),
(409, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Rejected Store', 'Rejected Store', 0, 0, 0),
(410, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Active Coupon', 'Active Coupon', 0, 0, 0),
(411, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Rejected Coupon', 'Rejected Coupon', 0, 0, 0),
(412, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Outdated Coupon', 'Outdated Coupon', 0, 0, 0),
(413, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Partner', 'Partner', 0, 0, 0),
(414, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'New Store', 'New Store', 0, 0, 0),
(415, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Active Store', 'Active Store', 0, 0, 0),
(416, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Please enter valid email address', 'Please enter valid email address', 0, 0, 0),
(417, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Must be maximum of 12 characters', 'Must be maximum of 12 characters', 0, 0, 0),
(418, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Must be a valid character', 'Must be a valid character', 0, 0, 0),
(419, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Username is already exist', 'Username is already exist', 0, 0, 0),
(420, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Must be start with an alphabets', 'Must be start with an alphabets', 0, 0, 0),
(421, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Email address is already exist', 'Email address is already exist', 0, 0, 0),
(422, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Must be at least 6 characters', 'Must be at least 6 characters', 0, 0, 0),
(423, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Your old password is incorrect, please try again', 'Your old password is incorrect, please try again', 0, 0, 0),
(424, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'New and confirm password field must match, please try again', 'New and confirm password field must match, please try again', 0, 0, 0),
(425, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'You must agree to the terms and conditions', 'You must agree to the terms and conditions', 0, 0, 0),
(426, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Export', 'Export', 0, 0, 0),
(427, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'All Users', 'All Users', 0, 0, 0),
(428, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Inactive Users', 'Inactive Users', 0, 0, 0),
(429, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Active Users', 'Active Users', 0, 0, 0),
(430, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'OpenID already exist', 'OpenID already exist', 0, 0, 0),
(431, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Enter valid OpenID', 'Enter valid OpenID', 0, 0, 0),
(432, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Your IP:', 'Your IP:', 0, 0, 0),
(433, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Your Hostname:', 'Your Hostname:', 0, 0, 0),
(434, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Type', 'Type', 0, 0, 0),
(435, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Select method', 'Select method', 0, 0, 0),
(436, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Address/Range', 'Address/Range', 0, 0, 0),
(437, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, '(IP address, domain or hostname)', '(IP address, domain or hostname)', 0, 0, 0),
(438, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, '(optional, shown to victim)', '(optional, shown to victim)', 0, 0, 0),
(439, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'How long', 'How long', 0, 0, 0),
(440, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 0, 0, 0),
(441, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Select', 'Select', 0, 0, 0),
(442, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Actions', 'Actions', 0, 0, 0),
(443, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Victims', 'Victims', 0, 0, 0),
(444, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Redirect to', 'Redirect to', 0, 0, 0),
(445, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Date Set', 'Date Set', 0, 0, 0),
(446, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Expiry Date', 'Expiry Date', 0, 0, 0),
(447, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Action', 'Action', 0, 0, 0),
(448, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Never', 'Never', 0, 0, 0),
(449, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'No Banned Ips available', 'No Banned Ips available', 0, 0, 0),
(450, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Select:', 'Select:', 0, 0, 0),
(451, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'None', 'None', 0, 0, 0),
(452, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, '-- More actions --', '-- More actions --', 0, 0, 0),
(453, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Edit this category', 'Edit this category', 0, 0, 0),
(454, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Delete this category', 'Delete this category', 0, 0, 0),
(455, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Update', 'Update', 0, 0, 0),
(456, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Search', 'Search', 0, 0, 0),
(457, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Title', 'Title', 0, 0, 0),
(458, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Edit', 'Edit', 0, 0, 0),
(459, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'No Categories available', 'No Categories available', 0, 0, 0),
(460, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Category', 'Category', 0, 0, 0),
(461, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Id', 'Id', 0, 0, 0),
(462, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Parent Id', 'Parent Id', 0, 0, 0),
(463, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Lft', 'Lft', 0, 0, 0),
(464, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Rght', 'Rght', 0, 0, 0),
(465, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Slug', 'Slug', 0, 0, 0),
(466, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Printable Coupon Categories', 'Printable Coupon Categories', 0, 0, 0),
(467, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'No categories available.', 'No categories available.', 0, 0, 0),
(468, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'User Login', 'User Login', 0, 0, 0),
(469, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'User', 'User', 0, 0, 0),
(470, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Select Range', 'Select Range', 0, 0, 0),
(471, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Registration', 'Registration', 0, 0, 0),
(472, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Demographics', 'Demographics', 0, 0, 0),
(473, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Affiliates/Coupons', 'Affiliates/Coupons', 0, 0, 0),
(474, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Coupon Types', 'Coupon Types', 0, 0, 0),
(475, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Coupon Options', 'Coupon Options', 0, 0, 0),
(476, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Affiliates/Stores', 'Affiliates/Stores', 0, 0, 0),
(477, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Please Select', 'Please Select', 0, 0, 0),
(478, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Add New City', 'Add New City', 0, 0, 0),
(479, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Approved Records', 'Approved Records', 0, 0, 0),
(480, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Disapproved Records', 'Disapproved Records', 0, 0, 0),
(481, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Total Records', 'Total Records', 0, 0, 0),
(482, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Disapproved', 'Disapproved', 0, 0, 0),
(483, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'No cities available', 'No cities available', 0, 0, 0),
(484, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Like to see All city?', 'Like to see All city?', 0, 0, 0),
(485, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Suggest a City', 'Suggest a City', 0, 0, 0),
(486, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'First Name', 'First Name', 0, 0, 0),
(487, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Last Name', 'Last Name', 0, 0, 0),
(488, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', 0, 0, 0),
(489, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'CAPTCHA image', 'CAPTCHA image', 0, 0, 0),
(490, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Reload CAPTCHA', 'Reload CAPTCHA', 0, 0, 0),
(491, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Click to play', 'Click to play', 0, 0, 0),
(492, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Security Code', 'Security Code', 0, 0, 0),
(493, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Send', 'Send', 0, 0, 0),
(494, '2011-12-30 12:56:56', '2011-12-30 12:56:56', 42, 'Filter', 'Filter', 0, 0, 0),
(495, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Add New Country', 'Add New Country', 0, 0, 0),
(496, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Nationality', 'Nationality', 0, 0, 0),
(497, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Currency', 'Currency', 0, 0, 0),
(498, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Singular', 'Singular', 0, 0, 0),
(499, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Plural', 'Plural', 0, 0, 0),
(500, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Name', 'Name', 0, 0, 0),
(501, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Code', 'Code', 0, 0, 0),
(502, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No countries available', 'No countries available', 0, 0, 0),
(503, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Add Your Comment', 'Add Your Comment', 0, 0, 0),
(504, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Post Comment', 'Post Comment', 0, 0, 0),
(505, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Description', 'Coupon Description', 0, 0, 0),
(506, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Store', 'Store', 0, 0, 0),
(507, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Comment', 'Comment', 0, 0, 0),
(508, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Auto detected', 'Auto detected', 0, 0, 0),
(509, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'IP', 'IP', 0, 0, 0),
(510, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'City', 'City', 0, 0, 0),
(511, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'State', 'State', 0, 0, 0),
(512, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Country', 'Country', 0, 0, 0),
(513, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Latitude', 'Latitude', 0, 0, 0),
(514, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Longitude', 'Longitude', 0, 0, 0),
(515, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Comments available', 'No Coupon Comments available', 0, 0, 0),
(516, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Latest comments made:', 'Latest comments made:', 0, 0, 0),
(517, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Created', 'Created', 0, 0, 0),
(518, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Modified', 'Modified', 0, 0, 0),
(519, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Ip', 'Ip', 0, 0, 0),
(520, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'said', 'said', 0, 0, 0),
(521, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'posted %s', 'posted %s', 0, 0, 0),
(522, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Favorites available', 'No Coupon Favorites available', 0, 0, 0),
(523, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Purchased', 'Purchased', 0, 0, 0),
(524, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Purchased Price', 'Purchased Price', 0, 0, 0),
(525, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Guest', 'Guest', 0, 0, 0),
(526, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Feedbacks available', 'No Coupon Feedbacks available', 0, 0, 0),
(527, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, ' Category', ' Category', 0, 0, 0),
(528, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Edit Coupon Flag Category', 'Edit Coupon Flag Category', 0, 0, 0),
(529, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Flag Categories', 'Flag Categories', 0, 0, 0),
(530, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Approved Records : ', 'Approved Records : ', 0, 0, 0),
(531, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Disapproved Records : ', 'Disapproved Records : ', 0, 0, 0),
(532, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Total Records : ', 'Total Records : ', 0, 0, 0),
(533, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Active?', 'Active?', 0, 0, 0),
(534, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Flag Categories available', 'No Coupon Flag Categories available', 0, 0, 0),
(535, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Submit', 'Submit', 0, 0, 0),
(536, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Flag This Coupon', 'Flag This Coupon', 0, 0, 0),
(537, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Reason', 'Reason', 0, 0, 0),
(538, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Message', 'Message', 0, 0, 0),
(539, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Username', 'Username', 0, 0, 0),
(540, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Posted on', 'Posted on', 0, 0, 0),
(541, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Remove this flag', 'Remove this flag', 0, 0, 0),
(542, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Delete Coupon', 'Delete Coupon', 0, 0, 0),
(543, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'All Coupon flagged by %s', 'All Coupon flagged by %s', 0, 0, 0),
(544, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Show all coupons flagged by %s ', 'Show all coupons flagged by %s ', 0, 0, 0),
(545, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'whois', 'whois', 0, 0, 0),
(546, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Flags available', 'No Flags available', 0, 0, 0),
(547, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Impressions available', 'No Coupon Impressions available', 0, 0, 0),
(548, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Related Coupon Categories', 'Related Coupon Categories', 0, 0, 0),
(549, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Browse Coupons', 'Browse Coupons', 0, 0, 0),
(550, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Find a Tag', 'Find a Tag', 0, 0, 0),
(551, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Sorry, no tags found', 'Sorry, no tags found', 0, 0, 0),
(552, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'No Coupon Views available', 'No Coupon Views available', 0, 0, 0),
(553, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Share Your Coupon', 'Share Your Coupon', 0, 0, 0),
(554, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Found a coupon for', 'Found a coupon for', 0, 0, 0),
(555, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Enter the details below to share with other users', 'Enter the details below to share with other users', 0, 0, 0),
(556, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Type keyword to find existing store name', 'Type keyword to find existing store name', 0, 0, 0),
(557, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Store URL', 'Store URL', 0, 0, 0),
(558, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'http://www.example.com', 'http://www.example.com', 0, 0, 0),
(559, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Leave as blank, if no coupon code', 'Leave as blank, if no coupon code', 0, 0, 0),
(560, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Tips', 'Tips', 0, 0, 0),
(561, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Discount', 'Discount', 0, 0, 0),
(562, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'eg:15% Off Entire Purchase', 'eg:15% Off Entire Purchase', 0, 0, 0),
(563, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon URL', 'Coupon URL', 0, 0, 0),
(564, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'e.g. http://address.coupon.com', 'e.g. http://address.coupon.com', 0, 0, 0),
(565, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Please select', 'Please select', 0, 0, 0),
(566, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Share', 'Share', 0, 0, 0),
(567, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Ensure your file has a ', 'Ensure your file has a ', 0, 0, 0),
(568, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, '.CSV ', '.CSV ', 0, 0, 0),
(569, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'extension.', 'extension.', 0, 0, 0),
(570, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, '<span>IMPORTANT</span>: Your file must be a valid CSV file in order for the import to work successfully. You can filter the imported coupons under the check store and approve manually after your changes.', '<span>IMPORTANT</span>: Your file must be a valid CSV file in order for the import to work successfully. You can filter the imported coupons under the check store and approve manually after your changes.', 0, 0, 0),
(571, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'View Sample CSV File', 'View Sample CSV File', 0, 0, 0),
(572, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Choose your file from your desktop.', 'Choose your file from your desktop.', 0, 0, 0),
(573, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, '(OR)', '(OR)', 0, 0, 0),
(574, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon CSV URL', 'Coupon CSV URL', 0, 0, 0),
(575, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'e.g. http://www.example.com/coupons.csv', 'e.g. http://www.example.com/coupons.csv', 0, 0, 0),
(576, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Import', 'Import', 0, 0, 0),
(577, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Type Status', 'Coupon Type Status', 0, 0, 0),
(578, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Normal  Coupons:', 'Normal  Coupons:', 0, 0, 0),
(579, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Live Coupons', 'Live Coupons', 0, 0, 0),
(580, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'SpecialOffer:', 'SpecialOffer:', 0, 0, 0),
(581, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'SpecialOffer', 'SpecialOffer', 0, 0, 0),
(582, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Unreliable Coupons:', 'Unreliable Coupons:', 0, 0, 0),
(583, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Unreliable Coupons', 'Unreliable Coupons', 0, 0, 0),
(584, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Status', 'Coupon Status', 0, 0, 0),
(585, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Check Store:', 'Check Store:', 0, 0, 0),
(586, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'New Coupons:', 'New Coupons:', 0, 0, 0),
(587, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'New Coupons', 'New Coupons', 0, 0, 0),
(588, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Active Coupons:', 'Active Coupons:', 0, 0, 0),
(589, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Active Coupons', 'Active Coupons', 0, 0, 0),
(590, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Rejected Store:', 'Rejected Store:', 0, 0, 0),
(591, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Rejected Coupons:', 'Rejected Coupons:', 0, 0, 0),
(592, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Rejected Coupons', 'Rejected Coupons', 0, 0, 0),
(593, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Outdated Coupons:', 'Outdated Coupons:', 0, 0, 0),
(594, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Outdated Coupons', 'Outdated Coupons', 0, 0, 0),
(595, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Partner:', 'Partner:', 0, 0, 0),
(596, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon code:', 'Coupon code:', 0, 0, 0),
(597, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon code', 'Coupon code', 0, 0, 0),
(598, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Shopping Tips:', 'Shopping Tips:', 0, 0, 0),
(599, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Printable:', 'Printable:', 0, 0, 0),
(600, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Printable', 'Printable', 0, 0, 0),
(601, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Freeshipping:', 'Freeshipping:', 0, 0, 0),
(602, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Freeshipping', 'Freeshipping', 0, 0, 0),
(603, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Affiliate', 'Affiliate', 0, 0, 0),
(604, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Permanent delete system for expired coupons', 'Permanent delete system for expired coupons', 0, 0, 0),
(605, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'You can use this to delete coupons permanently which are marked as expired', 'You can use this to delete coupons permanently which are marked as expired', 0, 0, 0),
(606, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Clear flag', 'Clear flag', 0, 0, 0),
(607, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Flag', 'Flag', 0, 0, 0),
(608, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Unsuspend', 'Unsuspend', 0, 0, 0),
(609, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Suspend', 'Suspend', 0, 0, 0),
(610, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Count', 'Count', 0, 0, 0),
(611, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Feedback', 'Coupon Feedback', 0, 0, 0),
(612, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Worked', 'Coupon Worked', 0, 0, 0),
(613, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Coupon Not Worked', 'Coupon Not Worked', 0, 0, 0),
(614, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Impression', 'Impression', 0, 0, 0),
(615, '2011-12-30 12:56:57', '2011-12-30 12:56:57', 42, 'Tag', 'Tag', 0, 0, 0),
(616, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'View', 'View', 0, 0, 0),
(617, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Favorite', 'Favorite', 0, 0, 0),
(618, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'URL', 'URL', 0, 0, 0),
(619, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Status: ', 'Status: ', 0, 0, 0),
(620, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Marked as deleted', 'Marked as deleted', 0, 0, 0),
(621, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Admin Suspended', 'Admin Suspended', 0, 0, 0),
(622, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Flagged', 'Flagged', 0, 0, 0),
(623, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'System Flagged', 'System Flagged', 0, 0, 0),
(624, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Added 0n', 'Added 0n', 0, 0, 0),
(625, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No Coupons available', 'No Coupons available', 0, 0, 0),
(626, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, '-- Change Coupon Status --', '-- Change Coupon Status --', 0, 0, 0),
(627, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'List of All Coupons', 'List of All Coupons', 0, 0, 0),
(628, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, '0 - 9 ', '0 - 9 ', 0, 0, 0),
(629, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No coupons available', 'No coupons available', 0, 0, 0),
(630, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Latest coupons used:', 'Latest coupons used:', 0, 0, 0),
(631, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Latest coupons down-voted:', 'Latest coupons down-voted:', 0, 0, 0),
(632, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Latest Contributions:', 'Latest Contributions:', 0, 0, 0),
(633, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Latest coupons submitted:', 'Latest coupons submitted:', 0, 0, 0),
(634, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No coupons used (don''t forget to click on the tick when you have used a coupon successfully)', 'No coupons used (don''t forget to click on the tick when you have used a coupon successfully)', 0, 0, 0),
(635, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No latest coupons voted', 'No latest coupons voted', 0, 0, 0),
(636, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No latest Contributions:', 'No latest Contributions:', 0, 0, 0),
(637, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'No coupons shared :(', 'No coupons shared :(', 0, 0, 0),
(638, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'If this coupon is for saver offers choose the saver type otherwise leave empty.', 'If this coupon is for saver offers choose the saver type otherwise leave empty.', 0, 0, 0),
(639, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'If this coupon is branded then choose the brand type.', 'If this coupon is branded then choose the brand type.', 0, 0, 0),
(640, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Or', 'Or', 0, 0, 0),
(641, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Main Description', 'Main Description', 0, 0, 0),
(642, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Secondary Description', 'Secondary Description', 0, 0, 0),
(643, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Percentage Offer', 'Percentage Offer', 0, 0, 0),
(644, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'if you not check this then it will be in $ offer', 'if you not check this then it will be in $ offer', 0, 0, 0),
(645, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Tags', 'Tags', 0, 0, 0),
(646, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Coupon Tag will be helpful for customer while search coupons. (Comma separated Coupon tags)', 'Coupon Tag will be helpful for customer while search coupons. (Comma separated Coupon tags)', 0, 0, 0),
(647, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'View coupons', 'View coupons', 0, 0, 0),
(648, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Current Special Offers', 'Current Special Offers', 0, 0, 0),
(649, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Unreliable Coupons ', 'Unreliable Coupons ', 0, 0, 0),
(650, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Top Coupons', 'Top Coupons', 0, 0, 0),
(651, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'New!', 'New!', 0, 0, 0),
(652, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Success', 'Success', 0, 0, 0),
(653, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Visit Store', 'Visit Store', 0, 0, 0),
(654, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Print coupon', 'Print coupon', 0, 0, 0),
(655, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Click to redeem', 'Click to redeem', 0, 0, 0),
(656, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Like it?', 'Like it?', 0, 0, 0),
(657, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, '♥ avg saving: ', '♥ avg saving: ', 0, 0, 0),
(658, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Shared', 'Shared', 0, 0, 0),
(659, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Remove favorites', 'Remove favorites', 0, 0, 0),
(660, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Add to favorites', 'Add to favorites', 0, 0, 0),
(661, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' comments', ' comments', 0, 0, 0),
(662, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Add comment', 'Add comment', 0, 0, 0),
(663, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Close comments', 'Close comments', 0, 0, 0),
(664, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Flag this coupon', 'Flag this coupon', 0, 0, 0),
(665, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'posted this', 'posted this', 0, 0, 0),
(666, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Current Top %s Coupons', 'Current Top %s Coupons', 0, 0, 0),
(667, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Search Results', 'Search Results', 0, 0, 0),
(668, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Top Free Shipping Coupons', 'Top Free Shipping Coupons', 0, 0, 0),
(669, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Today''s Top Coupons', 'Today''s Top Coupons', 0, 0, 0),
(670, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'coupon codes', 'coupon codes', 0, 0, 0),
(671, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'More ', 'More ', 0, 0, 0),
(672, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'coupons', 'coupons', 0, 0, 0),
(673, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Loading...', 'Loading...', 0, 0, 0),
(674, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Find Local Printable Coupons', 'Find Local Printable Coupons', 0, 0, 0),
(675, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Zoom in and pan around to see the individual coupons in your area.', 'Zoom in and pan around to see the individual coupons in your area.', 0, 0, 0),
(676, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'National ', 'National ', 0, 0, 0),
(677, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Local ', 'Local ', 0, 0, 0),
(678, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Top National Printable Coupons', 'Top National Printable Coupons', 0, 0, 0),
(679, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'posted this ', 'posted this ', 0, 0, 0),
(680, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'What', 'What', 0, 0, 0),
(681, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Where', 'Where', 0, 0, 0),
(682, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'e.g.Pizza', 'e.g.Pizza', 0, 0, 0),
(683, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'e.g 92630 or houston', 'e.g 92630 or houston', 0, 0, 0),
(684, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Search coupon codes for ', 'Search coupon codes for ', 0, 0, 0),
(685, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' stores...', ' stores...', 0, 0, 0),
(686, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Special Offers', 'Special Offers', 0, 0, 0),
(687, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Send to a Friend', 'Send to a Friend', 0, 0, 0),
(688, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Coupon Code: ', 'Coupon Code: ', 0, 0, 0),
(689, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Shopping Tip: ', 'Shopping Tip: ', 0, 0, 0),
(690, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Pritable Coupons: ', 'Pritable Coupons: ', 0, 0, 0),
(691, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'open site', 'open site', 0, 0, 0),
(692, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'more on ', 'more on ', 0, 0, 0),
(693, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'It Will', 'It Will', 0, 0, 0),
(694, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Sale', 'Sale', 0, 0, 0),
(695, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Did this coupon work for you?', 'Did this coupon work for you?', 0, 0, 0),
(696, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' Click send coupon to my mobile', ' Click send coupon to my mobile', 0, 0, 0),
(697, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' Click Send coupon to my mobile', ' Click Send coupon to my mobile', 0, 0, 0),
(698, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Shared  ', 'Shared  ', 0, 0, 0),
(699, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Current Top Coupons', 'Current Top Coupons', 0, 0, 0),
(700, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' Coupon Codes', ' Coupon Codes', 0, 0, 0),
(701, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Discount Amount', 'Discount Amount', 0, 0, 0),
(702, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Coupon View', 'Coupon View', 0, 0, 0),
(703, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Remove from favorites', 'Remove from favorites', 0, 0, 0),
(704, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Send coupon to my mobile', 'Send coupon to my mobile', 0, 0, 0),
(705, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'for', 'for', 0, 0, 0),
(706, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'email', 'email', 0, 0, 0),
(707, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Cool! I found someone that will ', 'Cool! I found someone that will ', 0, 0, 0),
(708, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, ' for ', ' for ', 0, 0, 0),
(709, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'Hi, Check it out: ', 'Hi, Check it out: ', 0, 0, 0),
(710, '2011-12-30 12:56:58', '2011-12-30 12:56:58', 42, 'mail', 'mail', 0, 0, 0),
(711, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Tweet!', 'Tweet!', 0, 0, 0),
(712, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Did this coupon work?', 'Did this coupon work?', 0, 0, 0),
(713, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Please %s to post comment', 'Please %s to post comment', 0, 0, 0),
(714, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'login', 'login', 0, 0, 0),
(715, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Tell a friend', 'Tell a friend', 0, 0, 0),
(716, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Ratings', 'Ratings', 0, 0, 0),
(717, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Price: ', 'Price: ', 0, 0, 0),
(718, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'url', 'url', 0, 0, 0),
(719, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Description', 'Description', 0, 0, 0),
(720, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon View Count', 'Coupon View Count', 0, 0, 0),
(721, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Favorite Count', 'Coupon Favorite Count', 0, 0, 0),
(722, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Comment Count', 'Coupon Comment Count', 0, 0, 0),
(723, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Rating Count', 'Coupon Rating Count', 0, 0, 0),
(724, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Admin side links', 'Admin side links', 0, 0, 0),
(725, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Dashboard', 'Dashboard', 0, 0, 0),
(726, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Dashboard ', 'Dashboard ', 0, 0, 0),
(727, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Send Email to Users', 'Send Email to Users', 0, 0, 0),
(728, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Add', 'Coupon Add', 0, 0, 0),
(729, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Flags', 'Coupon Flags', 0, 0, 0),
(730, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Setting Overview', 'Setting Overview', 0, 0, 0),
(731, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'System', 'System', 0, 0, 0),
(732, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Developments', 'Developments', 0, 0, 0),
(733, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'SEO', 'SEO', 0, 0, 0),
(734, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Regional, Currency & Language', 'Regional, Currency & Language', 0, 0, 0),
(735, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Account ', 'Account ', 0, 0, 0),
(736, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Account', 'Account', 0, 0, 0),
(737, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Affiliates', 'Affiliates', 0, 0, 0),
(738, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Third Party API', 'Third Party API', 0, 0, 0),
(739, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Suspicious Word Detector', 'Suspicious Word Detector', 0, 0, 0),
(740, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Masters', 'Masters', 0, 0, 0),
(741, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Warning! Please edit with caution.', 'Warning! Please edit with caution.', 0, 0, 0),
(742, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Regional', 'Regional', 0, 0, 0),
(743, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Static pages', 'Static pages', 0, 0, 0),
(744, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Email', 'Email', 0, 0, 0),
(745, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Others', 'Others', 0, 0, 0),
(746, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Education', 'Education', 0, 0, 0),
(747, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Relationship', 'Relationship', 0, 0, 0),
(748, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Employment', 'Employment', 0, 0, 0),
(749, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Income', 'Income', 0, 0, 0),
(750, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Gender', 'Gender', 0, 0, 0),
(751, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Age', 'Age', 0, 0, 0),
(752, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'If there is no coupon code, leave it as blank', 'If there is no coupon code, leave it as blank', 0, 0, 0),
(753, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Ongoing', 'Ongoing', 0, 0, 0),
(754, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'When enable, there is no end point and currently in', 'When enable, there is no end point and currently in', 0, 0, 0),
(755, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, '15% Off Entire Purchase', '15% Off Entire Purchase', 0, 0, 0),
(756, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Tag will be helpful for customer while search coupons.(Comma separated Coupon tags)', 'Coupon Tag will be helpful for customer while search coupons.(Comma separated Coupon tags)', 0, 0, 0),
(757, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Status', 'Status', 0, 0, 0),
(758, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Note: Sytem will change the status based on store status. eg: store status in \\"New store\\", coupon will be stored as \\"Check Store\\"', 'Note: Sytem will change the status based on store status. eg: store status in \\"New store\\", coupon will be stored as \\"Check Store\\"', 0, 0, 0),
(759, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Type Status', 'Type Status', 0, 0, 0),
(760, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, '1. Speical offer coupon - Specially offered coupon <br> 2. Normal Coupon - Active and trustable coupon <br> 3. Unreliable Coupon - Not sure it will work or not', '1. Speical offer coupon - Specially offered coupon <br> 2. Normal Coupon - Active and trustable coupon <br> 3. Unreliable Coupon - Not sure it will work or not', 0, 0, 0),
(761, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Code: ', 'Code: ', 0, 0, 0),
(762, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Hi, Check it out', 'Hi, Check it out', 0, 0, 0),
(763, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Free Shipping', 'Free Shipping', 0, 0, 0),
(764, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Free Shipping Coupons! Click Here', 'Free Shipping Coupons! Click Here', 0, 0, 0),
(765, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Draft', 'Draft', 0, 0, 0),
(766, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', 0, 0, 0),
(767, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Prev', 'Prev', 0, 0, 0),
(768, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Next', 'Next', 0, 0, 0),
(769, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Power Tools', 'Power Tools', 0, 0, 0),
(770, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'RSS', 'RSS', 0, 0, 0),
(771, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'RSS Feed', 'RSS Feed', 0, 0, 0),
(772, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Links and Goodies', 'Links and Goodies', 0, 0, 0),
(773, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Popular Coupons Newsletter', 'Popular Coupons Newsletter', 0, 0, 0),
(774, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Admin', 'Admin', 0, 0, 0),
(775, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Revision ', 'Revision ', 0, 0, 0),
(776, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Revision', 'Revision', 0, 0, 0),
(777, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'saved', 'saved', 0, 0, 0),
(778, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'by', 'by', 0, 0, 0),
(779, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign In', 'Sign In', 0, 0, 0),
(780, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'It''s easy to participate- sign in to the community with an existing service account:', 'It''s easy to participate- sign in to the community with an existing service account:', 0, 0, 0),
(781, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in using your account with', 'Sign in using your account with', 0, 0, 0),
(782, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in with Facebook', 'Sign in with Facebook', 0, 0, 0),
(783, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in with Gmail', 'Sign in with Gmail', 0, 0, 0),
(784, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in with Twitter', 'Sign in with Twitter', 0, 0, 0),
(785, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in with Yahoo', 'Sign in with Yahoo', 0, 0, 0),
(786, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Sign in with Open ID', 'Sign in with Open ID', 0, 0, 0),
(787, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'e.g., http://www.example.com', 'e.g., http://www.example.com', 0, 0, 0),
(788, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Locate yourself on google maps', 'Locate yourself on google maps', 0, 0, 0),
(789, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'List of All Stores', 'List of All Stores', 0, 0, 0),
(790, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, '(e.g. \\"displayname &lt;email address>\\")', '(e.g. \\"displayname &lt;email address>\\")', 0, 0, 0),
(791, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'No e-mail templates added yet.', 'No e-mail templates added yet.', 0, 0, 0),
(792, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Add Ads', 'Add Ads', 0, 0, 0),
(793, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Google Add', 'Google Add', 0, 0, 0),
(794, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'No Google Ads available', 'No Google Ads available', 0, 0, 0),
(795, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Keyword', 'Keyword', 0, 0, 0),
(796, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'No Ips available', 'No Ips available', 0, 0, 0),
(797, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'No Languages available', 'No Languages available', 0, 0, 0),
(798, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Admin - %s', 'Admin - %s', 0, 0, 0),
(799, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Visit site', 'Visit site', 0, 0, 0),
(800, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Tools', 'Tools', 0, 0, 0),
(801, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'View Site', 'View Site', 0, 0, 0),
(802, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'My Account', 'My Account', 0, 0, 0),
(803, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Logout', 'Logout', 0, 0, 0),
(804, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Back to Settings', 'Back to Settings', 0, 0, 0),
(805, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'All rights reserved', 'All rights reserved', 0, 0, 0),
(806, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Powered by Couponator', 'Powered by Couponator', 0, 0, 0),
(807, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'made in', 'made in', 0, 0, 0),
(808, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, ' You are logged in as Admin', ' You are logged in as Admin', 0, 0, 0),
(809, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupon Codes', 'Coupon Codes', 0, 0, 0),
(810, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Printable Coupons', 'Printable Coupons', 0, 0, 0),
(811, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Language', 'Language', 0, 0, 0),
(812, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Join the crew:', 'Join the crew:', 0, 0, 0),
(813, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'sign in to the community', 'sign in to the community', 0, 0, 0),
(814, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'View your profile', 'View your profile', 0, 0, 0),
(815, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Live chat', 'Live chat', 0, 0, 0),
(816, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Stats', 'Stats', 0, 0, 0),
(817, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'points', 'points', 0, 0, 0),
(818, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Explanation', 'Explanation', 0, 0, 0),
(819, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Community rank:', 'Community rank:', 0, 0, 0),
(820, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Points this week:', 'Points this week:', 0, 0, 0),
(821, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupons used:', 'Coupons used:', 0, 0, 0),
(822, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupons rejected:', 'Coupons rejected:', 0, 0, 0),
(823, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Coupons submitted:', 'Coupons submitted:', 0, 0, 0),
(824, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Money saved:', 'Money saved:', 0, 0, 0),
(825, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Saved others:', 'Saved others:', 0, 0, 0),
(826, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Comments made:', 'Comments made:', 0, 0, 0),
(827, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'You earn a point every time another user votes ''yes'' for a coupon you''ve shared.', 'You earn a point every time another user votes ''yes'' for a coupon you''ve shared.', 0, 0, 0),
(828, '2011-12-30 12:56:59', '2011-12-30 12:56:59', 42, 'Community members are ranked on the total points they''ve earned and can win great prizes and giveaways.', 'Community members are ranked on the total points they''ve earned and can win great prizes and giveaways.', 0, 0, 0),
(829, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'To earn points, simply find and share coupons with the community.', 'To earn points, simply find and share coupons with the community.', 0, 0, 0),
(830, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Number of points are calculated hourly.', 'Number of points are calculated hourly.', 0, 0, 0),
(831, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Note: shopping tips do not count towards your points.', 'Note: shopping tips do not count towards your points.', 0, 0, 0),
(832, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Shop', 'Shop', 0, 0, 0),
(833, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'subscribe', 'subscribe', 0, 0, 0),
(834, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Offers', 'Offers', 0, 0, 0),
(835, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Terms Of Use', 'Terms Of Use', 0, 0, 0),
(836, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Privacy Policy', 'Privacy Policy', 0, 0, 0),
(837, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Advertise', 'Advertise', 0, 0, 0),
(838, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Press', 'Press', 0, 0, 0),
(839, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Did this coupon work? Don''t forget to use it. \\"Click I Got It\\" if its worked!', 'Did this coupon work? Don''t forget to use it. \\"Click I Got It\\" if its worked!', 0, 0, 0),
(840, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'i got it', 'i got it', 0, 0, 0),
(841, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Page Tags available', 'No Page Tags available', 0, 0, 0),
(842, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'About', 'About', 0, 0, 0),
(843, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Coming soon', 'Coming soon', 0, 0, 0),
(844, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Preview', 'Preview', 0, 0, 0),
(845, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Change', 'Change', 0, 0, 0),
(846, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Page title', 'Page title', 0, 0, 0),
(847, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Body', 'Body', 0, 0, 0),
(848, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_EMAIL##', 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_EMAIL##', 0, 0, 0),
(849, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Cancel', 'Cancel', 0, 0, 0),
(850, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Content', 'Content', 0, 0, 0),
(851, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Pages available', 'No Pages available', 0, 0, 0),
(852, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'The %s is being used for caching. To change the config edit APP/config/core.php ', 'The %s is being used for caching. To change the config edit APP/config/core.php ', 0, 0, 0),
(853, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Install', 'Install', 0, 0, 0),
(854, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Write Permission Check', 'Write Permission Check', 0, 0, 0),
(855, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Cache Settings Check', 'Cache Settings Check', 0, 0, 0),
(856, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Your cache is NOT working. Please check the settings in APP/config/core.php', 'Your cache is NOT working. Please check the settings in APP/config/core.php', 0, 0, 0),
(857, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Database Check', 'Database Check', 0, 0, 0),
(858, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Your database configuration file is present.', 'Your database configuration file is present.', 0, 0, 0),
(859, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Your database configuration file is NOT present.', 'Your database configuration file is NOT present.', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(860, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Rename config/database.php.default to config/database.php', 'Rename config/database.php.default to config/database.php', 0, 0, 0),
(861, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Cake is able to connect to the database.', 'Cake is able to connect to the database.', 0, 0, 0),
(862, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Cake is NOT able to connect to the database.', 'Cake is NOT able to connect to the database.', 0, 0, 0),
(863, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Configurations', 'Configurations', 0, 0, 0),
(864, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Source Code Analysis', 'Source Code Analysis', 0, 0, 0),
(865, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Technical News', 'Technical News', 0, 0, 0),
(866, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Coming soon ', 'Coming soon ', 0, 0, 0),
(867, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Terms and Policies', 'Terms and Policies', 0, 0, 0),
(868, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ', 'When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ', 0, 0, 0),
(869, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Manually trigger cron to update coupon status, user rankings', 'Manually trigger cron to update coupon status, user rankings', 0, 0, 0),
(870, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'You can use this to update various status. This will be used in the scenario where cron is not working.', 'You can use this to update various status. This will be used in the scenario where cron is not working.', 0, 0, 0),
(871, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Manually trigger cron to import coupons from affiliate sites', 'Manually trigger cron to import coupons from affiliate sites', 0, 0, 0),
(872, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Added On', 'Added On', 0, 0, 0),
(873, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Searched Count', 'Searched Count', 0, 0, 0),
(874, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Search Keywords available', 'No Search Keywords available', 0, 0, 0),
(875, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Search Logs available', 'No Search Logs available', 0, 0, 0),
(876, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Value', 'Value', 0, 0, 0),
(877, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Label', 'Label', 0, 0, 0),
(878, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Setting Category', 'Setting Category', 0, 0, 0),
(879, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Translations add', 'Translations add', 0, 0, 0),
(880, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Application Info', 'Application Info', 0, 0, 0),
(881, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Credentials', 'Credentials', 0, 0, 0),
(882, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Other Info', 'Other Info', 0, 0, 0),
(883, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(884, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 0, 0, 0),
(885, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, '<span>Update Facebook Credentials</span>', '<span>Update Facebook Credentials</span>', 0, 0, 0),
(886, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(887, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, '<span>Update Twitter Credentials</span>', '<span>Update Twitter Credentials</span>', 0, 0, 0),
(888, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 0, 0, 0),
(889, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'registration', 'registration', 0, 0, 0),
(890, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Not Allow Beyond Original', 'Not Allow Beyond Original', 0, 0, 0),
(891, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Allow Handle Aspect', 'Allow Handle Aspect', 0, 0, 0),
(892, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No settings available', 'No settings available', 0, 0, 0),
(893, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Add New State', 'Add New State', 0, 0, 0),
(894, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Approved Records: ', 'Approved Records: ', 0, 0, 0),
(895, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Disapproved Records: ', 'Disapproved Records: ', 0, 0, 0),
(896, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Total Records: ', 'Total Records: ', 0, 0, 0),
(897, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No states available', 'No states available', 0, 0, 0),
(898, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Store Statuses available', 'No Store Statuses available', 0, 0, 0),
(899, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Similar Discounts', 'Similar Discounts', 0, 0, 0),
(900, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No stores available', 'No stores available', 0, 0, 0),
(901, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Store Views available', 'No Store Views available', 0, 0, 0),
(902, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Meta Keywords', 'Meta Keywords', 0, 0, 0),
(903, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Meta Description', 'Meta Description', 0, 0, 0),
(904, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Address', 'Address', 0, 0, 0),
(905, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Note: Address required for printable coupon google map listing, if not given then store will not be listed in google map', 'Note: Address required for printable coupon google map listing, if not given then store will not be listed in google map', 0, 0, 0),
(906, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Please select correct address value', 'Please select correct address value', 0, 0, 0),
(907, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Zipcode', 'Zipcode', 0, 0, 0),
(908, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Note: zip code required for site address search and google map', 'Note: zip code required for site address search and google map', 0, 0, 0),
(909, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Rank', 'Rank', 0, 0, 0),
(910, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Note: Low rank will affect the coupon listing weightage', 'Note: Low rank will affect the coupon listing weightage', 0, 0, 0),
(911, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'File', 'File', 0, 0, 0),
(912, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, '<span>IMPORTANT</span>: Your file must be a valid CSV file in order for the import to work successfully. You can filter the imported stores under the new store and approve manually after your changes.', '<span>IMPORTANT</span>: Your file must be a valid CSV file in order for the import to work successfully. You can filter the imported stores under the new store and approve manually after your changes.', 0, 0, 0),
(913, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Store CSV URL', 'Store CSV URL', 0, 0, 0),
(914, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'e.g. http://www.example.com/stores.csv', 'e.g. http://www.example.com/stores.csv', 0, 0, 0),
(915, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Store Status', 'Store Status', 0, 0, 0),
(916, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'New Store:', 'New Store:', 0, 0, 0),
(917, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Active Store:', 'Active Store:', 0, 0, 0),
(918, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Manually Updated:', 'Manually Updated:', 0, 0, 0),
(919, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Manually Updated', 'Manually Updated', 0, 0, 0),
(920, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Auto Updated:', 'Auto Updated:', 0, 0, 0),
(921, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Auto Updated', 'Auto Updated', 0, 0, 0),
(922, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Click', 'Click', 0, 0, 0),
(923, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Stores available', 'No Stores available', 0, 0, 0),
(924, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Favorite Stores', 'Favorite Stores', 0, 0, 0),
(925, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Favorites Stores available', 'No Favorites Stores available', 0, 0, 0),
(926, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, ' Search Results', ' Search Results', 0, 0, 0),
(927, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Top ', 'Top ', 0, 0, 0),
(928, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, ' Stores', ' Stores', 0, 0, 0),
(929, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'stores', 'stores', 0, 0, 0),
(930, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Recently visited stores', 'Recently visited stores', 0, 0, 0),
(931, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Top %s stores', 'Top %s stores', 0, 0, 0),
(932, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Stores found', 'No Stores found', 0, 0, 0),
(933, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Average discount', 'Average discount', 0, 0, 0),
(934, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Latest', 'Latest', 0, 0, 0),
(935, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Coupons Via Email', 'Coupons Via Email', 0, 0, 0),
(936, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Receive an email when new', 'Receive an email when new', 0, 0, 0),
(937, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'coupons are added (it&acute;s cool, we hate spam too):', 'coupons are added (it&acute;s cool, we hate spam too):', 0, 0, 0),
(938, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Enter Your Email', 'Enter Your Email', 0, 0, 0),
(939, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Monitor', 'Monitor', 0, 0, 0),
(940, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Get our newsletter', 'Get our newsletter', 0, 0, 0),
(941, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Get It', 'Get It', 0, 0, 0),
(942, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Don''t worry, your email is safe and secure with us.', 'Don''t worry, your email is safe and secure with us.', 0, 0, 0),
(943, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Hot Coupons Newsletter', 'Hot Coupons Newsletter', 0, 0, 0),
(944, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Receive a weekly email featuring the best coupon codes as voted by the users of ', 'Receive a weekly email featuring the best coupon codes as voted by the users of ', 0, 0, 0),
(945, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, ':', ':', 0, 0, 0),
(946, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Subscription is free, you can unsubscribe at any time and we will never use your email address for any other purpose.', 'Subscription is free, you can unsubscribe at any time and we will never use your email address for any other purpose.', 0, 0, 0),
(947, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Edit Subscription', 'Edit Subscription', 0, 0, 0),
(948, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Subscribed Users:', 'Subscribed Users:', 0, 0, 0),
(949, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Unsubscribed Users:', 'Unsubscribed Users:', 0, 0, 0),
(950, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Total:', 'Total:', 0, 0, 0),
(951, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Total', 'Total', 0, 0, 0),
(952, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Subscribed On', 'Subscribed On', 0, 0, 0),
(953, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Subscribed', 'Subscribed', 0, 0, 0),
(954, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'No Subscriptions available', 'No Subscriptions available', 0, 0, 0),
(955, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Unsubscribed', 'Unsubscribed', 0, 0, 0),
(956, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Manage Your Subscription', 'Manage Your Subscription', 0, 0, 0),
(957, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Are sure you want to unsubscribe?', 'Are sure you want to unsubscribe?', 0, 0, 0),
(958, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Oops, i changed my mind', 'Oops, i changed my mind', 0, 0, 0),
(959, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'English', 'English', 0, 0, 0),
(960, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'To Language', 'To Language', 0, 0, 0),
(961, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'It will only populate site labels for selected new language. You need to manually enter all the equivalent translated labels.', 'It will only populate site labels for selected new language. You need to manually enter all the equivalent translated labels.', 0, 0, 0),
(962, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'It will automatically translate site labels into selected language with Google. You may then edit necessary labels.', 'It will automatically translate site labels into selected language with Google. You may then edit necessary labels.', 0, 0, 0),
(963, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Google Translate service is currently a paid service and you''d need API key to use it.', 'Google Translate service is currently a paid service and you''d need API key to use it.', 0, 0, 0),
(964, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Please enter Google Translate API key in ', 'Please enter Google Translate API key in ', 0, 0, 0),
(965, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, ' page', ' page', 0, 0, 0),
(966, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Original', 'Original', 0, 0, 0),
(967, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Make New Translation', 'Make New Translation', 0, 0, 0),
(968, '2011-12-30 12:57:00', '2011-12-30 12:57:00', 42, 'Add New Text', 'Add New Text', 0, 0, 0),
(969, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sorry, in order to translate, default English strings should be extracted and available. Please contact support.', 'Sorry, in order to translate, default English strings should be extracted and available. Please contact support.', 0, 0, 0),
(970, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Verified', 'Verified', 0, 0, 0),
(971, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Not Verified', 'Not Verified', 0, 0, 0),
(972, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Manage', 'Manage', 0, 0, 0),
(973, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Delete Translation', 'Delete Translation', 0, 0, 0),
(974, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No Translations available', 'No Translations available', 0, 0, 0),
(975, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Unverified', 'Unverified', 0, 0, 0),
(976, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Verified: ', 'Verified: ', 0, 0, 0),
(977, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 0, 0, 0),
(978, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Translated', 'Translated', 0, 0, 0),
(979, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No translations available', 'No translations available', 0, 0, 0),
(980, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Key', 'Key', 0, 0, 0),
(981, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Lang Text', 'Lang Text', 0, 0, 0),
(982, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Write to', 'Write to', 0, 0, 0),
(983, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Edit Comment', 'Edit Comment', 0, 0, 0),
(984, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Commented By', 'Commented By', 0, 0, 0),
(985, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No User Comments available', 'No User Comments available', 0, 0, 0),
(986, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Comments for ', 'Comments for ', 0, 0, 0),
(987, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Leave a comment', 'Leave a comment', 0, 0, 0),
(988, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' posted this ', ' posted this ', 0, 0, 0),
(989, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No comments available', 'No comments available', 0, 0, 0),
(990, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Leave a comment for ', 'Leave a comment for ', 0, 0, 0),
(991, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Login Time', 'Login Time', 0, 0, 0),
(992, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'User login IP', 'User login IP', 0, 0, 0),
(993, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'User agent', 'User agent', 0, 0, 0),
(994, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Ban Login IP', 'Ban Login IP', 0, 0, 0),
(995, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No User Logins available', 'No User Logins available', 0, 0, 0),
(996, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Add New OpenID', 'Add New OpenID', 0, 0, 0),
(997, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'User openids', 'User openids', 0, 0, 0),
(998, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Add User Openid', 'Add User Openid', 0, 0, 0),
(999, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No User Openids available', 'No User Openids available', 0, 0, 0),
(1000, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Manage your OpenIDs', 'Manage your OpenIDs', 0, 0, 0),
(1001, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 0, 0, 0),
(1002, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No OpenIDs available', 'No OpenIDs available', 0, 0, 0),
(1003, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Attach a new OpenID', 'Attach a new OpenID', 0, 0, 0),
(1004, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Edit Profile - %s', 'Edit Profile - %s', 0, 0, 0),
(1005, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'DOB', 'DOB', 0, 0, 0),
(1006, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Viewed Time', 'Viewed Time', 0, 0, 0),
(1007, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Viewed User', 'Viewed User', 0, 0, 0),
(1008, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No User Views available', 'No User Views available', 0, 0, 0),
(1009, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 0, 0, 0),
(1010, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Password', 'Password', 0, 0, 0),
(1011, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Diagnostics are for developer purpose only.', 'Diagnostics are for developer purpose only.', 0, 0, 0),
(1012, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Search by keywords', 'Search by keywords', 0, 0, 0),
(1013, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Debug & Error Log', 'Debug & Error Log', 0, 0, 0),
(1014, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'View debug, error log, used cache memory and used log memory', 'View debug, error log, used cache memory and used log memory', 0, 0, 0),
(1015, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Active Users:', 'Active Users:', 0, 0, 0),
(1016, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Active users', 'Active users', 0, 0, 0),
(1017, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Inactive Users:', 'Inactive Users:', 0, 0, 0),
(1018, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Inactive users', 'Inactive users', 0, 0, 0),
(1019, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'OpenID Users:', 'OpenID Users:', 0, 0, 0),
(1020, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'OpenID users', 'OpenID users', 0, 0, 0),
(1021, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Gmail Users:', 'Gmail Users:', 0, 0, 0),
(1022, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Gmail users', 'Gmail users', 0, 0, 0),
(1023, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Yahoo Users:', 'Yahoo Users:', 0, 0, 0),
(1024, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Yahoo users', 'Yahoo users', 0, 0, 0),
(1025, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Facebook Users:', 'Facebook Users:', 0, 0, 0),
(1026, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Facebook users', 'Facebook users', 0, 0, 0),
(1027, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Twitter Users:', 'Twitter Users:', 0, 0, 0),
(1028, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Twitter users', 'Twitter users', 0, 0, 0),
(1029, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Total Users:', 'Total Users:', 0, 0, 0),
(1030, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Total Users', 'Total Users', 0, 0, 0),
(1031, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'User Type', 'User Type', 0, 0, 0),
(1032, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'CSV', 'CSV', 0, 0, 0),
(1033, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Email Confirmed', 'Email Confirmed', 0, 0, 0),
(1034, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Login count', 'Login count', 0, 0, 0),
(1035, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'View count', 'View count', 0, 0, 0),
(1036, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Signup IP', 'Signup IP', 0, 0, 0),
(1037, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Resend Activation', 'Resend Activation', 0, 0, 0),
(1038, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Change password', 'Change password', 0, 0, 0),
(1039, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No users available', 'No users available', 0, 0, 0),
(1040, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Bulk Mail Option', 'Bulk Mail Option', 0, 0, 0),
(1041, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Send To', 'Send To', 0, 0, 0),
(1042, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Timings', 'Timings', 0, 0, 0),
(1043, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Current time: ', 'Current time: ', 0, 0, 0),
(1044, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Last login: ', 'Last login: ', 0, 0, 0),
(1045, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Recently registered users', 'Recently registered users', 0, 0, 0),
(1046, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Recently no users registered', 'Recently no users registered', 0, 0, 0),
(1047, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Online users', 'Online users', 0, 0, 0),
(1048, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Recently no users online', 'Recently no users online', 0, 0, 0),
(1049, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Version', 'Version', 0, 0, 0),
(1050, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Product Support', 'Product Support', 0, 0, 0),
(1051, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Product Manual', 'Product Manual', 0, 0, 0),
(1052, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'CSSilize', 'CSSilize', 0, 0, 0),
(1053, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'PSD to XHTML Conversion and ', 'PSD to XHTML Conversion and ', 0, 0, 0),
(1054, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' theming', ' theming', 0, 0, 0),
(1055, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Agriya Blog', 'Agriya Blog', 0, 0, 0),
(1056, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'to', 'to', 0, 0, 0),
(1057, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Redirecting you to authorize %s', 'Redirecting you to authorize %s', 0, 0, 0),
(1058, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'If your browser doesn''t redirect you please %s to continue.', 'If your browser doesn''t redirect you please %s to continue.', 0, 0, 0),
(1059, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'click here', 'click here', 0, 0, 0),
(1060, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Old password', 'Old password', 0, 0, 0),
(1061, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Enter a new password', 'Enter a new password', 0, 0, 0),
(1062, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Confirm Password', 'Confirm Password', 0, 0, 0),
(1063, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Forgot your password?', 'Forgot your password?', 0, 0, 0),
(1064, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Enter your Email, and we will send you instructions for resetting your password.', 'Enter your Email, and we will send you instructions for resetting your password.', 0, 0, 0),
(1065, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Top Contributors:', 'Top Contributors:', 0, 0, 0),
(1066, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Last', 'Last', 0, 0, 0),
(1067, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'days:', 'days:', 0, 0, 0),
(1068, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'No results found', 'No results found', 0, 0, 0),
(1069, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign In using: ', 'Sign In using: ', 0, 0, 0),
(1070, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Remember me on this computer.', 'Remember me on this computer.', 0, 0, 0),
(1071, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Signup', 'Signup', 0, 0, 0),
(1072, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, '[Image: Yahoo]', '[Image: Yahoo]', 0, 0, 0),
(1073, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, '[Image: Gmail]', '[Image: Gmail]', 0, 0, 0),
(1074, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Register', 'Register', 0, 0, 0),
(1075, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Welcome to the community', 'Welcome to the community', 0, 0, 0),
(1076, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Tell us what to improve', 'Tell us what to improve', 0, 0, 0),
(1077, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' - share feedback and ideas for what we should be working on.', ' - share feedback and ideas for what we should be working on.', 0, 0, 0),
(1078, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'The ', 'The ', 0, 0, 0),
(1079, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' Community is a place for like-minded bargain hunters to share and discuss the latest and greatest online shopping deals.', ' Community is a place for like-minded bargain hunters to share and discuss the latest and greatest online shopping deals.', 0, 0, 0),
(1080, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign up with Facebook', 'Sign up with Facebook', 0, 0, 0),
(1081, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign up with Twitter', 'Sign up with Twitter', 0, 0, 0),
(1082, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign up with Yahoo', 'Sign up with Yahoo', 0, 0, 0),
(1083, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign up with Gmail', 'Sign up with Gmail', 0, 0, 0),
(1084, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Sign up with Open ID', 'Sign up with Open ID', 0, 0, 0),
(1085, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Terms & Policies', 'Terms & Policies', 0, 0, 0),
(1086, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' I have read, understood &amp; agree to the', ' I have read, understood &amp; agree to the', 0, 0, 0),
(1087, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'I have read, understood &amp; agree to the', 'I have read, understood &amp; agree to the', 0, 0, 0),
(1088, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Reset your password', 'Reset your password', 0, 0, 0),
(1089, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' joined the community', ' joined the community', 0, 0, 0),
(1090, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, ' and is a ', ' and is a ', 0, 0, 0),
(1091, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Email confirmed', 'Email confirmed', 0, 0, 0),
(1092, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'OpenID count', 'OpenID count', 0, 0, 0),
(1093, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Facebook user id', 'Facebook user id', 0, 0, 0),
(1094, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'twitter user id', 'twitter user id', 0, 0, 0),
(1095, '2011-12-30 12:57:01', '2011-12-30 12:57:01', 42, 'Debug setting does not allow access to this url.', 'Debug setting does not allow access to this url.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_type_id` int(5) unsigned NOT NULL,
  `username` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `password` varchar(100) collate utf8_unicode_ci NOT NULL,
  `fb_user_id` bigint(20) default NULL,
  `user_openid_count` bigint(20) unsigned NOT NULL,
  `user_login_count` bigint(20) unsigned NOT NULL,
  `user_view_count` bigint(20) unsigned NOT NULL,
  `cookie_hash` varchar(50) collate utf8_unicode_ci NOT NULL,
  `cookie_time_modified` datetime NOT NULL,
  `is_openid_register` tinyint(1) NOT NULL default '0',
  `is_gmail_register` tinyint(1) NOT NULL default '0',
  `is_yahoo_register` tinyint(1) NOT NULL default '0',
  `is_facebook_register` tinyint(1) NOT NULL,
  `is_twitter_register` tinyint(1) NOT NULL,
  `twitter_access_token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `twitter_access_key` varchar(255) collate utf8_unicode_ci NOT NULL,
  `twitter_user_id` bigint(20) NOT NULL default '0',
  `avatar_url` varchar(500) collate utf8_unicode_ci NOT NULL,
  `is_agree_terms_conditions` tinyint(1) NOT NULL,
  `coupon_points` bigint(20) NOT NULL,
  `rank` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_email_confirmed` tinyint(1) NOT NULL,
  `ip_id` varchar(15) collate utf8_unicode_ci default NULL,
  `last_login_ip_id` varchar(15) collate utf8_unicode_ci default NULL,
  `last_logged_in_time` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `twitter_user_id` (`twitter_user_id`),
  KEY `fb_user_id` (`fb_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Details';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `modified`, `user_type_id`, `username`, `email`, `password`, `fb_user_id`, `user_openid_count`, `user_login_count`, `user_view_count`, `cookie_hash`, `cookie_time_modified`, `is_openid_register`, `is_gmail_register`, `is_yahoo_register`, `is_facebook_register`, `is_twitter_register`, `twitter_access_token`, `twitter_access_key`, `twitter_user_id`, `avatar_url`, `is_agree_terms_conditions`, `coupon_points`, `rank`, `is_active`, `is_email_confirmed`, `ip_id`, `last_login_ip_id`, `last_logged_in_time`) VALUES
(1, '2011-09-19 09:53:13', '2011-09-19 09:53:13', 1, 'admin', 'productdemo.admin@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', NULL, 0, 16, 1, '0682b4ee5683deadfc5c3d56d73e947f', '2011-07-11 07:47:41', 0, 0, 0, 0, 0, '', '', 0, '', 1, 57, 0, 1, 1, '', '41.238.112.186', '2011-11-12 07:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

DROP TABLE IF EXISTS `user_comments`;
CREATE TABLE IF NOT EXISTS `user_comments` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `to_user_id` bigint(20) NOT NULL,
  `comment` text collate utf8_unicode_ci NOT NULL,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_login_ip_id` varchar(20) collate utf8_unicode_ci default NULL,
  `user_agent` varchar(500) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Login Details';

--
-- Dumping data for table `user_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_openids`
--

DROP TABLE IF EXISTS `user_openids`;
CREATE TABLE IF NOT EXISTS `user_openids` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `openid` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User OpenID Details';

--
-- Dumping data for table `user_openids`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `language_id` bigint(20) default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `middle_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `gender_id` int(2) NOT NULL,
  `dob` date NOT NULL,
  `about_me` text collate utf8_unicode_ci NOT NULL,
  `address` varchar(500) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `zip_code` int(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `gender_id` (`gender_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Profile Details';

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `created`, `modified`, `user_id`, `language_id`, `first_name`, `last_name`, `middle_name`, `gender_id`, `dob`, `about_me`, `address`, `city_id`, `state_id`, `country_id`, `zip_code`) VALUES
(2, '2009-05-04 07:59:48', '2011-07-06 07:41:58', 1, 156, '', '', '', 1, '2009-05-04', '', '', 42395, 3948, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Type Details';

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `created`, `modified`, `name`) VALUES
(1, NULL, NULL, 'admin'),
(2, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

DROP TABLE IF EXISTS `user_views`;
CREATE TABLE IF NOT EXISTS `user_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `viewing_user_id` bigint(20) default NULL,
  `ip_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `viewing_user_id` (`viewing_user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User View Details';

--
-- Dumping data for table `user_views`
--

