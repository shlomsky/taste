<?php
/**
* @package   Warp Theme Framework
* @file      form.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (document.getElementById('jformtitle').value == ""){
		alert( "<?php echo JText::_( 'Weblink item must have a title', true ); ?>" );
	} else if (document.getElementById('jformcatid').value < 1) {
		alert( "<?php echo JText::_( 'You must select a category.', true ); ?>" );
	} else if (document.getElementById('jformurl').value == ""){
		alert( "<?php echo JText::_( 'You must have a url.', true ); ?>" );
	} else {
		submitform( pressbutton );
	}
}
</script>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">
	
	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>

	<form class="submission" action="<?php echo $this->action ?>" method="post" name="adminForm" id="adminForm">
		<fieldset>
			<legend><?php echo JText::_( 'Submit A Web Link' );?></legend>
			
			<div>
				<label for="jformtitle"><?php echo JText::_( 'Name' ); ?></label>
				<input class="inputbox" type="text" id="jformtitle" name="jform[title]" maxlength="250" value="<?php echo $this->escape($this->weblink->title);?>" />
			</div>
			
			<div>
				<label for="jformcatid"><?php echo JText::_( 'Category' ); ?></label>
				<?php echo $this->lists['catid']; ?>
			</div>
			
			<div>
				<label for="jformurl"><?php echo JText::_( 'URL' ); ?></label>
				<input class="inputbox" type="text" id="jformurl" name="jform[url]" value="<?php echo $this->weblink->url; ?>" maxlength="250" />
			</div>
			
			<div>
				<label for="jformdescription"><?php echo JText::_( 'Description' ); ?></label>
				<textarea class="inputbox" cols="30" rows="6" id="jformdescription" name="jform[description]"><?php echo $this->escape( $this->weblink->description);?></textarea>
			</div>
			
			<div>
				<label for="jformpublished"><?php echo JText::_( 'Published' ); ?></label>
					<?php echo $this->lists['published']; ?>
			</div>

			<div>
				<label for="jformordering"><?php echo JText::_( 'Ordering' ); ?></label>
				<?php echo $this->lists['ordering']; ?>
			</div>

		</fieldset>

		<div class="submit">
			<button type="button" onclick="submitbutton('save')"><?php echo JText::_('Save') ?></button>
			<button type="button" onclick="submitbutton('cancel')"><?php echo JText::_('Cancel') ?></button>
		</div>

		<input type="hidden" name="jform[id]" value="<?php echo $this->weblink->id; ?>" />
		<input type="hidden" name="jform[ordering]" value="<?php echo $this->weblink->ordering; ?>" />
		<input type="hidden" name="jform[approved]" value="<?php echo $this->weblink->approved; ?>" />
		<input type="hidden" name="option" value="com_weblinks" />
		<input type="hidden" name="controller" value="weblink" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>

</div>