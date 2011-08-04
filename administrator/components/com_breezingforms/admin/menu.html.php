<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class HTML_facileFormsMenu
{
	function create($option, $pkg, $lists)
	{
		global $ff_mossite;
?>
		<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
		<table cellpadding="4" cellspacing="1" border="0" class="adminform" style="width:300px;">
			<tr><th colspan="4" class="title">BreezingForms - <?php echo BFText::_('MENUS_ADD'); ?></th></tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PARENT'); ?>:</td>
				<td nowrap><?php echo $lists['parents']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" valign="top">
					<select name="formid" size="20" class="inputbox">
						<option value="0" selected="selected"><?php echo BFText::_('MENUS_NOFORM'); ?></option>
<?php
						if (count($lists['forms'])) foreach ($lists['forms'] as $form)
							echo '<option value="'.$form->id.'">'.htmlspecialchars($form->title, ENT_QUOTES).' ('.$form->name.')</option>';
?>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap colspan="2" style="text-align:right">
					<a class="toolbar" href="javascript:submitbutton('newedit');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('next','','images/next_f2.png',1);">
						<img src="images/next.png"  alt="" name="next" border="0" align="middle" />&nbsp;<?php echo BFText::_('TOOLBAR_CONTINUE'); ?>
					</a>&nbsp;&nbsp;
					<a class="toolbar" href="javascript:submitbutton('cancel');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','images/cancel_f2.png',1);">
						<img src="images/cancel.png"  alt="" name="cancel" border="0" align="middle" />&nbsp;<?php echo BFText::_('TOOLBAR_CANCEL'); ?>
					</a>
				</td>
				<td></td>
			</tr>
		</table>
		<input type="hidden" name="pkg" value="<?php echo $pkg; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="managemenus" />
		</form>
<?php
	} // create

	function edit( $option, $pkg, &$row, &$lists )
	{
		global $ff_mossite, $ff_config;
		$action = $row->id ? BFText::_('MENUS_EDIT') : BFText::_('MENUS_ADD');
		if (!$row->id) $row->package = $pkg;
?>
		<script type="text/javascript">
		<!--
		function checkNumber(value, msg1, msg2)
		{
			var nonDigits = /\D/;
			var error = '';
			if (value == '')
				error += msg1;
			else
			if (nonDigits.test(value))
				error += msg2;
			return error;
		} // checkNumber

		function submitbutton(pressbutton)
		{
			
			var form = document.adminForm;
			var error = '';
			if (pressbutton != 'cancel') {
				if (form.title.value == '')
					error += "<?php echo BFText::_('MENUS_TITLEEMPTY'); ?>\n";
				if (form.name.value != '') {
					var invalidChars = /\W/;
					if (invalidChars.test(form.name.value))
						error += "<?php echo BFText::_('MENUS_NAMEIDENT'); ?>\n";
				} // if
				error += checkNumber(
					form.page.value,
					"<?php echo BFText::_('MENUS_PAGEEMPTY'); ?>\n",
					"<?php echo BFText::_('MENUS_PAGENUMBER'); ?>\n"
				);
			} // if
			if (error != '')
				alert(error);
			else
				submitform( pressbutton );
		} // submitbutton

		//-->
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script type="text/javascript" src="<?php echo $ff_mossite; ?>/includes/js/overlib_mini.js"></script>
		<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
		<table cellpadding="4" cellspacing="1" border="0" class="adminform" style="width:680px;">
			<tr><th colspan="4" class="title">BreezingForms - <?php echo $action; ?></th></tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PARENT'); ?>:</td>
				<td nowrap><?php echo $lists['parents']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_TITLE'); ?>:</td>
				<td nowrap>
					<input type="text" size="50" maxlength="50" name="title" value="<?php echo $row->title; ?>" class="inputbox"/>
<?php
					echo mosToolTip(BFText::_('MENUS_TIPTITLE'));
?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PACKAGE'); ?>:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" id="package" name="package" value="<?php echo $row->package; ?>" class="inputbox"/>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_IMAGE'); ?>:</td>
				<td nowrap>
<?php
					$cnt = count($lists['imgs']);
					$x = 0;
					for ($k = 0; $k < $cnt; $k++) {
						$img = $lists['imgs'][$k];
						$opt = '';
						if ($row->img==$img) $opt = ' checked="checked"';
						if ($x == 8) { echo '<br/>'; $x = 0; }
						if ($x > 0) echo '&nbsp;&nbsp;&nbsp;&nbsp;';
						echo
							'<input type="radio" id="img'.$k.'" name="img" value="'.$img.'"'.$opt.'/>'.
							'&nbsp;<label for="img'.$k.'">'.
							'<img src="'.$ff_mossite.'/includes/'.$img.'" alt="" border="0"/>'.
							'</label>';
						$x++;
					} // for
					$opt = '';
					if ($row->img=='') $opt = ' checked="checked"';
					if ($x == 8) { echo '<br/>'; $x = 0; }
					if ($x > 0) echo '&nbsp;&nbsp;&nbsp;&nbsp;';
					echo
						'<input type="radio" id="img'.$cnt.'" name="img" value=""'.$opt.'/>'.
						'&nbsp;<label for="img'.$cnt.'">'.
						BFText::_('MENUS_NONE').
						'</label>';
?>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_ORDERING'); ?>:</td>
				<td nowrap><?php echo $lists['ordering']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PUBLISHED'); ?>:</td>
				<td nowrap><?php echo mosHTML::yesnoRadioList("published", "", $row->published); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_NAME'); ?>:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" name="name" value="<?php echo $row->name; ?>" class="inputbox"/>
<?php
					echo mosToolTip(BFText::_('MENUS_TIPNAME'));
?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PAGE'); ?>:</td>
				<td nowrap>
					<input type="text" size="11" maxlength="11" name="page" value="<?php echo $row->page; ?>" class="inputbox"/>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_FRAME'); ?>:</td>
				<td nowrap><?php echo mosHTML::yesnoRadioList("frame", "", $row->frame); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_BORDER'); ?>:</td>
				<td nowrap><?php echo mosHTML::yesnoRadioList("border", "", $row->border); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('MENUS_PARAMS'); ?>:</td>
				<td nowrap>
					<input type="text" size="80" maxlength="255" name="params" value="<?php echo $row->params; ?>" class="inputbox"/>
<?php
					echo mosToolTip(BFText::_('MENUS_TIPPARAMS'));
?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" nowrap style="text-align:right">
					<a class="toolbar" href="javascript:submitbutton('save');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('save','','images/save_f2.png',1);">
						<img src="images/save.png" alt="" name="save" border="0" align="middle" />&nbsp;<?php echo BFText::_('TOOLBAR_SAVE'); ?>
					</a>&nbsp;&nbsp;
					<a class="toolbar" href="javascript:submitbutton('cancel');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','images/cancel_f2.png',1);">
						<img src="images/cancel.png" alt="" name="cancel" border="0" align="middle" />&nbsp;<?php echo BFText::_('TOOLBAR_CANCEL'); ?>
					</a>
				</td>
				<td></td>
			</tr>
		</table>
		<input type="hidden" name="pkg" value="<?php echo $pkg; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="managemenus" />
		</form>
<?php
	} // edit

	function listitems( $option, &$rows, &$pkglist )
	{
		global $ff_config, $ff_mossite, $ff_version;
?>
		<script type="text/javascript">
			<!--
			function submitbutton(pressbutton)
			{
				var form = document.adminForm;
				switch (pressbutton) {
					case 'copy':
					case 'publish':
					case 'unpublish':
					case 'remove':
						if (form.boxchecked.value==0) {
							alert("<?php echo BFText::_('MENUS_SELMENUSFIRST'); ?>");
							return;
						} // if
						break;
					default:
						break;
				} // switch
				if (pressbutton == 'remove')
					if (!confirm("<?php echo BFText::_('MENUS_ASKDEL'); ?>")) return;
				if (pressbutton == '' && form.pkgsel.value == '')
					form.pkg.value = '- blank -';
				else
					form.pkg.value = form.pkgsel.value;
				submitform(pressbutton);
			} // submitbutton

			function listItemTask( id, task )
			{
				var f = document.adminForm;
				cb = eval( 'f.' + id );
				if (cb) {
					for (i = 0; true; i++) {
						cbx = eval('f.cb'+i);
						if (!cbx) break;
						cbx.checked = false;
					} // for
					cb.checked = true;
					f.boxchecked.value = 1;
					submitbutton(task);
				}
				return false;
			} // listItemTask
			//-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table cellpadding="4" cellspacing="1" border="0">
			<tr>
				<td width="50%" nowrap>
					<table class="adminheading">
						<tr><th nowrap class="edit">BreezingForms <?php echo $ff_version; ?><br/><span class="componentheading"><?php echo BFText::_('MENUS_MANAGEMENUS'); ?></span></th></tr>
					</table>
				</td>
				<td nowrap>
					<?php echo BFText::_('MENUS_PACKAGE'); ?>:
					<select id="pkgsel" name="pkgsel" class="inputbox" size="1" onchange="submitbutton('');">
<?php
					if (count($pkglist)) foreach ($pkglist as $pkg) {
						$selected = '';
						if ($pkg[0]) $selected = ' selected';
						echo '<option value="'.$pkg[1].'"'.$selected.'>'.$pkg[1].'&nbsp;</option>';
					} // foreach
?>
					</select>
				</td>
				<td align="right" width="50%" nowrap>
<?php
		JToolBarHelper::custom('new',       'new.png',          'new_f2.png',       BFText::_('TOOLBAR_NEW'),       false);
		JToolBarHelper::custom('copy',      'copy.png',         'copy_f2.png',      BFText::_('TOOLBAR_COPY'),      false);
		JToolBarHelper::custom('publish',   'publish.png',      'publish_f2.png',   BFText::_('TOOLBAR_PUBLISH'),   false);
		JToolBarHelper::custom('unpublish', 'unpublish.png',    'unpublish_f2.png', BFText::_('TOOLBAR_UNPUBLISH'), false);
		JToolBarHelper::custom('remove',    'delete.png',       'delete_f2.png',    BFText::_('TOOLBAR_DELETE'),    false);
?>
				</td>
			</tr>
		</table>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th nowrap align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
				<th nowrap align="left"><?php echo BFText::_('MENUS_MENUITEM'); ?></th>
				<th nowrap align="center"><?php echo BFText::_('MENUS_IMAGE'); ?></th>
				<th nowrap align="center"><?php echo BFText::_('MENUS_PUBLISHED'); ?></th>
				<th nowrap align="center" colspan="2"><?php echo BFText::_('FORMS_REORDER'); ?></th>
				<th nowrap align="left"><?php echo BFText::_('MENUS_NAME'); ?></th>
				<th nowrap align="left"><?php echo BFText::_('MENUS_FRAME'); ?></th>
				<th nowrap align="left"><?php echo BFText::_('MENUS_BORDER'); ?></th>
				<th align="left" width="100%"><?php echo BFText::_('MENUS_PARAMS'); ?></th>
			</tr>
<?php
			$k = 0;
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
				$img = '&nbsp;';
				if ($row->img != '') $img = '<img src="'.$ff_mossite.'/includes/'.$row->img.'" alt="" border="0"/>';
				$frame = '&nbsp;';
				if ($row->frame) $frame = '<img src="images/tick.png" alt="+" border="0"/>';
				$border = '&nbsp;';
				if ($row->border) $border = '<img src="images/tick.png" alt="+" border="0"/>';
?>
				<tr class="row<?php echo $k; ?>">
					<td nowrap valign="top" align="center"><input type="checkbox" id="cb<?php echo $i; ?>" name="ids[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
					<td nowrap valign="top" align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','edit')"><?php echo $row->title; ?></a></td>
					<td nowrap valign="top" align="center"><?php echo $img; ?></td>
					<td nowrap valign="top" align="center"><?php
					if ($row->published == "1") {
						?><a href="#" onClick="return listItemTask('cb<?php echo $i; ?>','unpublish')"><img src="images/publish_g.png" alt="+" border="0" /></a><?php
					} else {
						?><a href="#" onClick="return listItemTask('cb<?php echo $i; ?>','publish')"><img src="images/publish_x.png" alt="-" border="0" /></a><?php
					} // if
					?></td>
					<td nowrap valign="top" align="right"><?php
						if ($i > 0) {
							?><a href="#" onClick="return listItemTask('cb<?php echo $i; ?>','orderup')"><img src="images/uparrow.png" alt="^" border="0" /></a><?php
						} // if
					?></td>
					<td nowrap valign="top" align="left"><?php
						if ($i < count($rows)-1) {
							?><a href="#" onClick="return listItemTask('cb<?php echo $i; ?>','orderdown')"><img src="images/downarrow.png" alt="v" border="0" /></a><?php
						} // if
					?></td>
					<td nowrap valign="top" align="left"><?php echo $row->name; ?></td>
					<td nowrap valign="top" align="center"><?php echo $frame; ?></td>
					<td nowrap valign="top" align="center"><?php echo $border; ?></td>
					<td valign="top" align="left"><?php echo htmlspecialchars($row->params, ENT_QUOTES); ?></td>
				</tr>
<?php
				$k = 1 - $k;
			} // for
?>
		</table>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="act" value="managemenus" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="form" value="" />
		<input type="hidden" name="page" value="" />
		<input type="hidden" name="pkg" value="" />
		</form>
<?php
	} // listitems

} // class HTML_facileFormsMenu

?>