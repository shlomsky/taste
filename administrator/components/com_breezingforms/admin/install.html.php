<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.4.4
* @package BreezingForms
* @copyright (C) 2004 by Peter Koch
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class HTML_facileFormsInstaller
{
	function step2($option, $release)
	{
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton)
		{
			var form = document.adminForm;
			var error = '';
			var checked = false;
			for (var i = 0; true; i++) {
				opt = eval('form.opt'+i);
				if (!opt) break;
				if (opt.checked) {
					checked = true;
					break;
				} // if
			} // for
			if (!checked)
				alert("<?php echo BFText::_('INSTALL_SELECTMODE'); ?>");
			else{
				submitform(pressbutton);
			}
		} // submitbutton

		</script>
		<table cellpadding="4" cellspacing="1" border="0" class="adminform" style="width:450px;">
		<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
			<tr><th colspan="3" class="title"><?php echo BFText::_('INSTALL_STEP2'); ?></th></tr>
			<tr>
				<td></td>
				<td><?php echo BFText::_('INSTALL_STEP2MSG'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap>
					<fieldset><legend><?php echo BFText::_('INSTALL_SELECTDBMODE'); ?></legend>
					<table cellpadding="4" cellspacing="1" border="0">
						<tr>
							<td nowrap>
								<input type="radio" id="opt0" name="ff_installmode" value="0"<?php if ($release=='') echo ' checked="checked"'; ?>/>
								<label for="opt0"> <?php echo BFText::_('INSTALL_NEWINSTALL'); ?></label>
							</td>
						</tr>
						<tr>
							<td nowrap>
								<input type="radio" id="opt1" name="ff_installmode" value="1"<?php if ($release=='1.4') echo ' checked="checked"'; ?>/>
								<label for="opt1"> <?php echo BFText::_('INSTALL_REINSTALL').' 1.4.* ('.BFText::_('INSTALL_UPTODATE').')'; ?></label>
							</td>
						</tr>
					</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap>
					<fieldset><legend><?php echo BFText::_('INSTALL_SELECTOPTIONS'); ?></legend>
					<table cellpadding="4" cellspacing="1" border="0">
						<tr>
							<td nowrap>
								<input id="smp2" type="checkbox" name="ff_instsamples" value="1" />
								<label for="smp2"> <?php echo BFText::_('INSTALL_INSTSAMPLES'); ?></label>
							</td>
						</tr>
					</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap style="text-align:right">
					<a class="toolbar" href="javascript:submitbutton('step3');">
						<img src="images/next.png"  alt="" name="next" border="0" align="middle" value="next" />&nbsp;<?php echo BFText::_('TOOLBAR_CONTINUE'); ?>
					</a>
				</td>
				<td></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="act" value="installation" />
		<input type="hidden" name="task" value="" />
		</form>
<?php
	} // step2


	function step3($option, &$errors)
	{
?>
		<table cellpadding="4" cellspacing="1" border="0" class="adminform" style="width:450px;">
		<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
			<tr><th colspan="3" class="title"><?php echo BFText::_('INSTALL_COMPLETE'); ?></th></tr>
			<tr>
				<td></td>
				<td><?php echo BFText::_('INSTALL_COMPLETEMSG'); ?>
					<hr/><br/>
<?php
					if (count($errors)==0)
						echo BFText::_('INSTALL_NOMESSAGES');
					else
						for ($i = 0; $i < count($errors); $i++) echo $errors[$i]."<br/>";
?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap style="text-align:right">
					<a class="toolbar" href="javascript:submitbutton('step4');">
						<img src="images/next.png"  alt="" name="next" border="0" align="middle" value="next" />&nbsp;<?php echo BFText::_('TOOLBAR_CONTINUE'); ?>
					</a>
				</td>
				<td></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="act" value="installation" />
		<input type="hidden" name="task" value="" />
		</form>
<?php
	} // step3

} // class HTML_facileFormsInstaller
?>