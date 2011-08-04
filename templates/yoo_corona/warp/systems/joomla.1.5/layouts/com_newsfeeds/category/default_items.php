<?php
/**
* @package   Warp Theme Framework
* @file      default_items.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<form action="<?php echo JRoute::_('index.php?view=category&id='.$this->category->slug); ?>" method="post" name="adminForm">

	<?php if ($this->params->get('show_limit')) : ?>
	<div class="filter">
		<?php
			echo JText::_('Display Num') .'&nbsp;';
			echo $this->pagination->getLimitBox();
		?>
	</div>
	<?php endif; ?>
	
	<table class="zebra" border="0" cellspacing="0" cellpadding="0">
		<?php if ( $this->params->get( 'show_headings' ) ) : ?>
		<thead>
			<tr>
				<th align="right" width="5%"><?php echo JText::_('Num'); ?></th>
				
				<?php if ( $this->params->get( 'show_name' ) ) : ?>
				<th align="left"><?php echo JText::_( 'Feed Name' ); ?></th>
				<?php endif; ?>
				
				<?php if ( $this->params->get( 'show_articles' ) ) : ?>
				<th align="center" width="15%"><?php echo JText::_( 'Articles' ); ?></th>
				<?php endif; ?>
				
			</tr>
		</thead>
		<?php endif; ?>
		
		<tbody>
		
			<?php foreach ($this->items as $item) : ?>
			<tr class="<?php if ($item->odd) { echo 'even'; } else { echo 'odd'; } ?>">
			
				<td align="right"><?php echo $item->count + 1; ?></td>
				
				<td><a href="<?php echo $item->link; ?>" class="category<?php echo $this->params->get( 'pageclass_sfx' ); ?>"><?php echo $item->name; ?></a></td>
				
				<?php if ( $this->params->get( 'show_articles' ) ) : ?>
				<td align="center"><?php echo $item->numarticles; ?></td>
				<?php endif; ?>
				
			</tr>
			<?php endforeach; ?>
		
		</tbody>
	
	</table>
	
	<?php echo $this->pagination->getPagesLinks(); ?>

</form>