<?php
/**
* @package   Warp Theme Framework
* @file      _item.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<?php if ($params->get('item_title')) : ?>
<h3>
	<?php if ($params->get('link_titles') && $item->linkOn != '') : ?>
		<a href="<?php echo $item->linkOn;?>"><?php echo $item->title;?></a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
</h3>
<?php endif; ?>

<?php if (!$params->get('intro_only')) echo $item->afterDisplayTitle; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php echo $item->text; ?>

<?php if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) : ?>
  <a class="readmore" href="<?php echo $item->linkOn; ?>"><?php echo $item->linkText ?></a>
<?php endif; ?>
