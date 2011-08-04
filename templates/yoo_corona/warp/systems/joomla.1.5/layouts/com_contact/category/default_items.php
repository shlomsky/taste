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

<script language="javascript" type="text/javascript">
	function tableOrdering( order, dir, task ) {
		var form = document.adminForm;
	
		form.filter_order.value 	= order;
		form.filter_order_Dir.value	= dir;
		document.adminForm.submit( task );
	}
</script>
		
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">

	<?php if ($this->params->get('show_limit')) : ?>
	<div class="filter">
		<?php echo JText::_('Display Num'); ?>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
	<?php endif; ?>
	
	<table class="zebra" border="0" cellspacing="0" cellpadding="0" >
	
		<?php if ($this->params->get('show_headings')) : ?>
		<thead>
			<tr>
				<th width="5%" align="right"><?php echo JText::_('Num'); ?></th>
				
				<th align="left"><?php echo JHTML::_('grid.sort',  'Name', 'cd.name', $this->lists['order_Dir'], $this->lists['order']); ?></th>
				
				<?php if ( $this->params->get('show_position')) : ?>
				<th align="left"><?php echo JHTML::_('grid.sort',  'Position', 'cd.con_position', $this->lists['order_Dir'], $this->lists['order']); ?></th>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_email')) : ?>
				<th width="20%" align="left"><?php echo JText::_('Email'); ?></th>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_telephone')) : ?>
				<th width="15%" align="left"><?php echo JText::_('Phone'); ?></th>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_mobile')) : ?>
				<th width="15%" align="left"><?php echo JText::_('Mobile'); ?></th>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_fax')) : ?>
				<th width="15%" align="left"><?php echo JText::_('Fax'); ?></th>
				<?php endif; ?>
				
			</tr>
		</thead>
		<?php endif; ?>
		
		<tbody>
		
			<?php foreach($this->items as $item) : ?>
			<tr class="<?php if ($item->odd) { echo 'even'; } else { echo 'odd'; } ?>">
			
				<td align="right" width="5"><?php echo $item->count +1; ?></td>
				
				<td><a href="<?php echo $item->link; ?>"><?php echo $item->name; ?></a></td>
				
				<?php if ( $this->params->get('show_position')) : ?>
				<td><?php echo $item->con_position; ?></td>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_email')) : ?>
				<td width="20%"><?php echo $item->email_to; ?></td>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_telephone')) : ?>
				<td width="15%"><?php echo $item->telephone; ?></td>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_mobile')) : ?>
				<td width="15%"><?php echo $item->mobile; ?></td>
				<?php endif; ?>
				
				<?php if ( $this->params->get('show_fax')) : ?>
				<td width="15%"><?php echo $item->fax; ?></td>
				<?php endif; ?>
				
			</tr>
			<?php endforeach; ?>
			
		</tbody>
		
	</table>
	
	<?php echo $this->pagination->getPagesLinks(); ?>

	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="catid" value="<?php echo $this->category->id;?>" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
	<input type="hidden" name="viewcache" value="0" />
</form>