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

<ul class="line">
<?php foreach ($list as $item) : ?>
	<li><a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a></li>
<?php endforeach; ?>
</ul>