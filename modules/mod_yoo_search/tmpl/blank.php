<?php
/**
* @package   YOOsearch Module
* @file      blank.php
* @version   1.5.6 April 2009
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="blank">
	<div id="<?php echo $search_id; ?>" class="yoo-search">
	
		<form action="index.php" method="post">
			<div class="searchbox">
				<button class="search-magnifier" type="submit" value="Search"></button>
				<input class="searchfield" type="text" onfocus="if(this.value=='<?php echo $field_text; ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo $field_text; ?>';" value="<?php echo $field_text; ?>" size="20" alt="<?php echo $field_text; ?>" maxlength="20" name="searchword" />
				<button class="search-close" type="reset" value="Reset"></button>
			</div>	
			<input type="hidden" name="task"   value="search" />
			<input type="hidden" name="option" value="com_search" />
		</form>		

		<div class="resultbox" style="<?php echo $css_box_width; ?>"></div>

	</div>
</div>