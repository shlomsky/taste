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

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">

	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>

	<?php if (@$this->category->image || @$this->category->description) : ?>
	<div class="description">
		<?php if (isset($this->category->image)) echo $this->category->image; ?>
		<?php echo $this->category->description; ?>
	</div>
	<?php endif; ?>

	<?php echo $this->loadTemplate('items'); ?>

	<?php if ($this->params->get('show_other_cats', 1)): ?>
	<ul>
		<?php foreach ($this->categories as $category) : ?>
		<li>
			<a href="<?php echo $category->link; ?>"><?php echo $this->escape($category->title);?></a>
			<small>(<?php echo $category->numlinks;?>)</small>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

</div>