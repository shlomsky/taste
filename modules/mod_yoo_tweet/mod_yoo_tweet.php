<?php
/**
* @package   YOOtweet Module
* @file      mod_yoo_tweet.php
* @version   1.5.4 April 2009
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// include helper
require_once(dirname(__FILE__).DS.'helper.php');

// init vars
$style       = $params->get('style', 'list');
$show_image  = $params->get('image', 1);
$show_author = $params->get('author', 1);
$show_date   = $params->get('date', 1);
$image_size  = $params->get('image_size', 48);
$module_base = JURI::base().'modules/mod_yoo_tweet/';

// get tweet feed
if ($feed = modYOOtweetHelper::getFeed($params)) {
	switch ($style) {
		case "single":
			require(JModuleHelper::getLayoutPath('mod_yoo_tweet', 'single'));
			break;
		default:
			require(JModuleHelper::getLayoutPath('mod_yoo_tweet', 'list'));
	}
}

$document =& JFactory::getDocument();
$document->addStyleSheet($module_base . 'mod_yoo_tweet.css.php');