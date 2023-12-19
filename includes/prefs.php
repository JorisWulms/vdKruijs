<?php
$tempAbsMainDir = str_replace('includes', '', rtrim(__DIR__, DIRECTORY_SEPARATOR));
$tempBaseDir = trim(isset($_SERVER['BASE']) ? $_SERVER['BASE'] : '', '/');
$absMainDirElements = explode(DIRECTORY_SEPARATOR, $tempAbsMainDir);
$lastAbsMainDirElement = end($absMainDirElements);
$tempWebThisDir = rtrim((isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : '') . '://' . (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '') . '/' . $tempBaseDir, '/') . '/';

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'garageboxen_krui');
define('DB_PASSWORD', '5dPdd1b8');
define('DB_DATABASE', 'garageboxen_krui');
define('DB_PREFIX', '');
define('DIR_SYSTEM', $tempAbsMainDir);

// BLOG IMAGES MAP VOOR AFBEELDINGEN BLOG
define('DIR_IMAGE', $tempAbsMainDir.'/images/blog/');
define('HTTP_IMAGE', $tempWebThisDir . 'images/blog/');

//HOOFD IMAGES MAP VOOR AFBEELDINGEN VIA EDITOR
define('DIR_USERFILES', $tempAbsMainDir.'/images/');
define('HTTP_USERFILES', $tempWebThisDir . 'images/');

//HOOFD IMAGES MAP VOOR AFBEELDINGEN VIA GALLERIJ
define('DIR_GALLERYFILES', $tempAbsMainDir.'/images/gallery/');
define('HTTP_GALLERYFILES', $tempWebThisDir . '/images/gallery/');

// BLOG IMAGES MAP VOOR AFBEELDINGEN NIEUWS
define('DIR_NEWSIMAGE', $tempAbsMainDir.'/images/news/');
define('HTTP_NEWSIMAGE', $tempWebThisDir . 'images/news/');

define('SHOP_PATH', 'shop');
define('ADMIN_PATH', 'admin');