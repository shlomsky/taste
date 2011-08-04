<?php
/**
* @package   Warp Theme Framework
* @file      complete.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">
	
	<h1 class="title"><?php echo JText::_('Reset your Password'); ?></h1>
		
	<p><?php echo JText::_('RESET_PASSWORD_COMPLETE_DESCRIPTION'); ?></p>

	<form class="submisstion josForm form-validate" action="<?php echo JRoute::_( 'index.php?option=com_user&task=completereset' ); ?>" method="post">
		<fieldset>
			<legend><?php echo JText::_('Reset your Password'); ?></legend>
			
			<div>
				<label for="password1" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_PASSWORD1_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_PASSWORD1_TIP_TEXT'); ?>"><?php echo JText::_('Password'); ?>:</label>
				<input id="password1" name="password1" type="password" class="required validate-password" />
			</div>
			
			<div>
				<label for="password2" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_PASSWORD2_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_PASSWORD2_TIP_TEXT'); ?>"><?php echo JText::_('Verify Password'); ?>:</label>
				<input id="password2" name="password2" type="password" class="required validate-password" />
			</div>
			
			
		</fieldset>
		
		<div class="submit">
			<button type="submit"><?php echo JText::_('Submit'); ?></button>
		</div>
			
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>

</div>