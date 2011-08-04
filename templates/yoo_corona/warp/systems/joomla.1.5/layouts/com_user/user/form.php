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

	<form class="submission form-validate" action="<?php echo JRoute::_( 'index.php' ); ?>" method="post" name="userform" autocomplete="off" >
		<fieldset>
			<legend><?php echo JText::_('EDIT YOUR DETAILS'); ?></legend>

			<?php if ($this->user->get('username')) :?>
			<div>
				<label for="username"><?php echo JText::_( 'User Name' ); ?></label>
				<input type="text" id="username" name="username" value="<?php echo $this->user->get('username'); ?>" disabled="disabled" />
			</div>
			<?php endif; ?>
			
			<div>
				<label for="name"><?php echo JText::_( 'Your Name' ); ?></label>
				<input class="required" type="text" id="name" name="name" value="<?php echo $this->user->get('name'); ?>" />
			</div>
			
			<div>
				<label for="email"><?php echo JText::_( 'email' ); ?></label>
				<input class="required validate-email" type="text" id="email" name="email" value="<?php echo $this->user->get('email'); ?>" />
			</div>
			
			<?php if ($this->user->get('password')) : ?>
			<div>
				<label for="password"><?php echo JText::_( 'Password' ); ?></label>
				<input class="validate-password" type="password" id="password" name="password" value="" />
			</div>
			
			<div>
				<label for="password2"><?php echo JText::_( 'Verify Password' ); ?></label>
				<input class="validate-passverify" type="password" id="password2" name="password2" />
			</div>
			<?php endif; ?>

			<?php if (isset($this->params)) :  echo $this->params->render( 'params' ); endif; ?>

		</fieldset>
		
		<div class="submit">
			<button type="submit" onclick="submitbutton( this.form );return false;"><?php echo JText::_('Save'); ?></button>
		</div>
		
		<input type="hidden" name="username" value="<?php echo $this->user->get('username'); ?>" />
		<input type="hidden" name="id" value="<?php echo $this->user->get('id'); ?>" />
		<input type="hidden" name="gid" value="<?php echo $this->user->get('gid'); ?>" />
		<input type="hidden" name="option" value="com_user" />
		<input type="hidden" name="task" value="save" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>

</div>