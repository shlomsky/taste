<?php
/**
* @package   YOOsearch Module
* @file      mod_yoo_search.php
* @version   1.5.6 April 2009
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

global $mainframe, $Itemid;

// count instances
if (!isset($GLOBALS['yoo_searchs'])) {
	$GLOBALS['yoo_searchs'] = 1;
} else {
	$GLOBALS['yoo_searchs']++;
}

// include helper
require_once (dirname(__FILE__).DS.'helper.php');

// init vars
$style            = $params->get('style', 'default');
$box_width	      = $params->get('box_width', 400);
$moduleclass_sfx  = $params->get('moduleclass_sfx', '');
$field_text	      = JText::_('search...');
$msg_results      = JText::_('Search results');
$msg_categories   = JText::_('Search categories');
$msg_no_results   = JText::_('No results found');
$msg_more_results = JText::_('More results');
$url              = JURI::base() . 'index.php?option=com_search&tmpl=raw&type=json&ordering=&searchphrase=all&Itemid=' . $Itemid;
$module_base      = JURI::base() . 'modules/mod_yoo_search/';

// css parameters
$search_id     = 'yoo-search-' . $GLOBALS['yoo_searchs'];
$css_box_width = 'width: ' . $box_width . 'px;';

// js parameters
$javascript = "new YOOsearch('" . $search_id . "', { 'url': '" . $url . "', 'fieldText': '" . $field_text . "', 'msgResults': '" . $msg_results . "', 'msgCategories': '" . $msg_categories . "', 'msgNoResults': '" . $msg_no_results . "', 'msgMoreResults': '" . $msg_more_results . "' });";

switch ($style) {
	case 'blank':
		require(JModuleHelper::getLayoutPath('mod_yoo_search', 'blank'));
		break;
	default:
		require(JModuleHelper::getLayoutPath('mod_yoo_search', 'default'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet($module_base . 'mod_yoo_search.css.php');
$document->addScript($module_base . 'mod_yoo_search.js');
echo "<script type=\"text/javascript\">\n// <!--\nwindow.addEvent('domready', function(){ $javascript });\n// -->\n</script>\n";