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
	
	<?php if (($this->params->get('show_description') && $this->section->description) || ($this->params->get('show_description_image') && $this->section->image)) :?>
	<div class="description">
		<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
			<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'. $this->section->image;?>" alt="<?php echo $this->section->image; ?>" class="align-<?php echo $this->section->image_position;?>"/>
		<?php endif; ?>
		<?php if ($this->params->get('show_description') && $this->section->description) echo $this->section->description; ?>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_categories', 1)) : ?>
	<ul>
		<?php foreach ($this->categories as $category) : ?>
		<?php if (!$this->params->get('show_empty_categories') && !$category->numitems) continue; ?>
		<li>
			<a href="<?php echo $category->link; ?>" title="<?php echo $category->title;?>"><?php echo $category->title;?></a>
			
			<?php if ($this->params->get('show_cat_num_articles')) : ?>
			<small>
				<?php
					$item_count = $category->numitems ." ";
					$item_count .= ($category->numitems == 1) ? JText::_('item') : JText::_('items');
					echo '('.$item_count.')';
				?>
			</small>
			<?php endif; ?>

			<?php if ($this->params->def('show_category_description', 1) && $category->description) : ?>
				<br /><?php echo $category->description; ?>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

</div>