<?php
/**
* @package   Warp Theme Framework
* @file      confirm.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">
	
	<h1 class="title"><?php echo JText::_('Confirm your Account'); ?></h1>

	<p><?php echo JText::_('RESET_PASSWORD_CONFIRM_DESCRIPTION'); ?></p>

	<form class="submission josForm form-validate" action="<?php echo JRoute::_( 'index.php?option=com_user&task=confirmreset' ); ?>" method="post">
		<fieldset>
			<legend><?php echo JText::_('Confirm your Account'); ?></legend>
			
			<div>
				<label for="username" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_USERNAME_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_USERNAME_TIP_TEXT'); ?>"><?php echo JText::_('User Name'); ?>:</label>
				<input id="username" name="username" type="text" class="required" size="36" />
			</div>
			
			<div>
				<label for="token" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TEXT'); ?>"><?php echo JText::_('Token'); ?>:</label>
				<input id="token" name="token" type="text" class="required" size="36" />
			</div>

		</fieldset>
		
		<div class="submit">
			<button type="submit"><?php echo JText::_('Submit'); ?></button>
		</div>
		
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>

</div>