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

$cparams =& JComponentHelper::getParams('com_media');

?>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">

	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>

	<?php if ($this->category->description || $this->category->image) :?>
	<div class="description">
		<?php if ($this->category->image) : ?>
			<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'. $this->category->image;?>" alt="<?php echo $this->category->image; ?>" class="align-<?php echo $this->category->image_position;?>" />
		<?php endif; ?>
		<?php if ($this->category->description) echo $this->category->description; ?>
	</div>
	<?php endif; ?>

	<?php
		$this->items =& $this->getItems();
		echo $this->loadTemplate('items');
	?>
	
	<?php if ($this->access->canEdit || $this->access->canEditOwn) : ?>	
	<p class="edit"><?php echo JHTML::_('icon.create', $this->category  , $this->params, $this->access); ?>	 <?php echo JText::_('Create new article.'); ?></p>
	<?php endif; ?>

</div>