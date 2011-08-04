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

<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>

<div id="system" class="<?php echo $this->params->get('pageclass_sfx')?>">
	
	<?php if ($this->params->get('show_page_title')) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>

	<?php if (isset($this->message)) : ?>
		<h2><?php echo $this->message->title ; ?></h2>
		<p><?php echo  $this->message->text ; ?></p>
	<?php endif; ?>

	<form class="submission form-validate" action="<?php echo JRoute::_('index.php?option=com_user'); ?>" method="post" id="josForm" name="josForm">
		<fieldset>
			<legend><?php echo JText::_('Register'); ?></legend>
			
			<div>
				<label id="namemsg" for="name"><?php echo JText::_('Name'); ?>*</label>
				<input type="text" name="name" id="name" value="<?php echo $this->user->get('name');?>" maxlength="50" />
			</div>
			
			<div>
				<label id="usernamemsg" for="username"><?php echo JText::_('User name'); ?>*</label>
				<input type="text" id="username" name="username" value="<?php echo $this->user->get('username');?>" maxlength="25" />
			</div>
			
			<div>
				<label id="emailmsg" for="email"><?php echo JText::_('Email'); ?>*</label>
				<input type="text" id="email" name="email" value="<?php echo $this->user->get('email');?>" maxlength="100" />
			</div>
			
			<div>
				<label id="pwmsg" for="password"><?php echo JText::_('Password'); ?>*</label>
				<input class="inputbox required validate-password" type="password" id="password" name="password" value="" />
			</div>
			
			<div>
				<label id="pw2msg" for="password2"><?php echo JText::_('Verify Password'); ?>*</label>
				<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" value="" />
			</div>

		</fieldset>
	
		<small><?php echo JText::_('REGISTER_REQUIRED'); ?></small>
		
		<div class="submit">
			<button class="button validate" type="submit"><?php echo JText::_('Register'); ?></button>
		</div>
	
		<input type="hidden" name="task" value="register_save" />
		<input type="hidden" name="id" value="0" />
		<input type="hidden" name="gid" value="0" />
		<?php echo JHTML::_('form.token'); ?>
	</form>

</div>