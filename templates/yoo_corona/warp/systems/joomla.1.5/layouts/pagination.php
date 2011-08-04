<?php
/**
* @package   Warp Theme Framework
* @file      pagination.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

function pagination_list_render($list) {
	// Initialize variables
	$html = '<div class="pagination">';
	
	if ($list['start']['active']==1)   $html .= $list['start']['data'];
	if ($list['previous']['active']==1) $html .= $list['previous']['data'];

	foreach ($list['pages'] as $page) {
		$html .= $page['data'];
	}

	if ($list['next']['active']==1) $html .= $list['next']['data'];
	if ($list['end']['active']==1)  $html .= $list['end']['data'];

	$html .= "</div>";
	
	return $html;
}

function pagination_item_active(&$item) {
	
	$cls = '';
	
    if ($item->text == JText::_('Next')) { $item->text = '»'; $cls = "next";}
    if ($item->text == JText::_('Prev')) { $item->text = '«'; $cls = "previous";}
    
	if ($item->text == JText::_('Start')) { $cls = "first";}
    if ($item->text == JText::_('End'))   { $cls = "last";}
	
    return "<a class=\"".$cls."\" href=\"".$item->link."\" title=\"".$item->text."\">".$item->text."</a>";
}

function pagination_item_inactive(&$item) {
	return "<strong>".$item->text."</strong>";
}