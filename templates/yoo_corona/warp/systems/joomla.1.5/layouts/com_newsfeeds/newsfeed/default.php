<?php
/**
* @package   Warp Theme Framework
* @file      default.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct acces
defined('_JEXEC') or die('Restricted access');

?>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">

	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>

	<h1 class="title">
		<a href="<?php echo $this->newsfeed->channel['link']; ?>" target="_blank"><?php echo str_replace('&apos;', "'", $this->newsfeed->channel['title']); ?></a>
	</h1>

	<?php if ($this->params->get('show_feed_description') || (isset($this->newsfeed->image['url']) && isset($this->newsfeed->image['title']) && $this->params->get('show_feed_image'))) :?>
	<div class="description">
		<?php if (isset($this->newsfeed->image['url']) && isset($this->newsfeed->image['title']) && $this->params->get('show_feed_image')) : ?>
			<img src="<?php echo $this->newsfeed->image['url']; ?>" alt="<?php echo $this->newsfeed->image['title']; ?>" class="align-right" />
		<?php endif; ?>
		<?php if ($this->params->get('show_feed_description')) echo str_replace('&apos;', "'", $this->newsfeed->channel['description']); ?>
	</div>
	<?php endif; ?>

	<ul class="space">
		<?php foreach ($this->newsfeed->items as $item ) :  ?>
		<li>
		<?php if ( !is_null($item->get_link()) ) : ?>
			<a href="<?php echo $item->get_link(); ?>" target="_blank"><?php echo $item->get_title(); ?></a>
		<?php endif; ?>
		<?php if ($this->params->get('show_item_description') && $item->get_description()) : ?>
			<?php $text = $this->limitText($item->get_description(), $this->params->get('feed_word_count')); ?>
			<br /><?php echo str_replace('&apos;', "'", $text); ?>
		<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>

</div>
