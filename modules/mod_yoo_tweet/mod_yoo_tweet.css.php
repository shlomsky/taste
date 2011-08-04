<?php 
/**
* @package   YOOtweet Module
* @file      mod_yoo_tweet.css.php
* @version   1.5.4 April 2009
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) @ob_start('ob_gzhandler');
header('Content-type: text/css; charset=UTF-8');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__) . DS);

/* ie browser */
$is_ie7 = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie 7') !== false;
$is_ie6 = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie 6') !== false;

/* list styling */
include(PATH_ROOT . 'styles/list/style.css');
include(PATH_ROOT . 'styles/list/black/style.css');

if ($is_ie6 && !$is_ie7) include(PATH_ROOT . 'styles/list/ie6hacks.css');

/* single styling */
include(PATH_ROOT . 'styles/single/style.css');
include(PATH_ROOT . 'styles/single/black/style.css');

if ($is_ie6 && !$is_ie7) include(PATH_ROOT . 'styles/single/ie6hacks.css');

?>