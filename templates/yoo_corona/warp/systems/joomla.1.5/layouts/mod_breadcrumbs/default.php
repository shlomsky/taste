<?php
/**
* @package   Warp Theme Framework
* @file      default.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="breadcrumbs"><?php

	if (!$params->get('showLast', 1)) array_pop($list);

	$count = count($list);

	for ($i = 0; $i < $count; $i ++) {
	
		// clean subtitle from breadcrumb
		if ($pos = strpos($list[$i]->name, '||')) {
			$name = trim(substr($list[$i]->name, 0, $pos));
		} else {
			$name = $list[$i]->name;
		}
		
		// mark-up last item as strong
		if ($i < $count-1) {
			if(!empty($list[$i]->link)) {
				echo '<a href="'.$list[$i]->link.'">'.$name.'</a>';
			} else {
				echo '<span>'.$name.'</span>';
			}
		} else {
			echo '<strong>'.$name.'</strong>';
		}
		
	}

?></div>