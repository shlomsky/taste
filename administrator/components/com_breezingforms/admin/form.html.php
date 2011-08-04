<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');


class HTML_facileFormsForm
{
	function edit($option, $tabpane, $pkg, &$row, &$lists, $caller)
	{
		global $ff_mossite, $ff_admsite, $ff_config;
		$action = $row->id ? BFText::_('FORMS_EDIT') : BFText::_('FORMS_ADD');
?>
		<script type="text/javascript" src="<?php echo $ff_admsite; ?>/admin/areautils.js"></script>
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

		function checkIdentifier(value, msg1, msg2)
		{
			var invalidChars = /\W/;
			var error = '';
			if (value == '')
				error += msg1;
			else
				if (invalidChars.test(value))
					error += msg2;
			return error;
		} // checkIdentifier

		function submitbutton(pressbutton)
		{
			var form = document.adminForm;
			var error = '';
			if (pressbutton != 'cancel') {
				if (form.title.value == '')
					error += "<?php echo BFText::_('FORMS_TITLEEMPTY'); ?>\n";
				error += checkIdentifier(
					form.name.value,
					"<?php echo BFText::_('FORMS_NAMEEMPTY'); ?>\n",
					"<?php echo BFText::_('FORMS_NAMEIDENT'); ?>\n"
				);
				error += checkNumber(
					form.width.value,
					"<?php echo BFText::_('FORMS_WIDTHEMPTY'); ?>\n",
					"<?php echo BFText::_('FORMS_WIDTHNUMBER'); ?>\n"
				);
				error += checkNumber(
					form.height.value,
					"<?php echo BFText::_('FORMS_HEIGHTEMPTY'); ?>\n",
					"<?php echo BFText::_('FORMS_HEIGHTNUMBER'); ?>\n"
				);
			} // if
			if (error != '')
				alert(error);
			else{
				if( ( "<?php echo $pkg ?>" == "EasyModeForms" || "<?php echo $pkg ?>" == "QuickModeForms") && pressbutton == 'cancel'){
					if(parent.SqueezeBox){
						parent.SqueezeBox.close();
					} else {
						submitform( pressbutton );
					}
				} else {
					submitform( pressbutton );
				}	
			}
		} // submitbutton

		function createInitCode()
		{
			form = document.adminForm;
			name = form.name.value;
			if (name=='') {
				alert("<?php echo BFText::_('FORMS_ENTNAMEFIRST'); ?>");
				return;
			} // if
			if (!confirm("<?php echo BFText::_('FORMS_CREATEINITNOW'); ?>\n<?php echo BFText::_('FORMS_EXISTINGAPPENDED'); ?>")) return;
			code =
				"function ff_"+name+"_init()\n"+
				"{\n"+
				"} // ff_"+name+"_init\n";
			oldcode = form.script1code.value;
			if (oldcode != '')
				form.script1code.value =
					code+
					"\n// -------------- <?php echo BFText::_('FORMS_OLDCODEBELOW'); ?> --------------\n\n"+
					oldcode;
			else
				form.script1code.value = code;
			codeAreaChange(form.script1code);
		} // createInitCode

		function createSubmittedCode()
		{
			form = document.adminForm;
			name = form.name.value;
			if (name=='') {
				alert("<?php echo BFText::_('FORMS_ENTNAMEFIRST'); ?>");
				return;
			} // if
			if (!confirm("<?php echo BFText::_('FORMS_CREATESUBMITTEDNOW'); ?>\n<?php echo BFText::_('FORMS_EXISTINGAPPENDED'); ?>")) return;
			code =
				"function ff_"+name+"_submitted(status, message)\n"+
				"{\n"+
				"    switch (status) {\n"+
				"        case FF_STATUS_OK:\n"+
				"           // do whatever desired on success\n"+
				"           break;\n"+
				"        case FF_STATUS_UNPUBLISHED:\n"+
				"        case FF_STATUS_SAVERECORD_FAILED:\n"+
				"        case FF_STATUS_SAVESUBRECORD_FAILED:\n"+
				"        case FF_STATUS_UPLOAD_FAILED:\n"+
				"        case FF_STATUS_ATTACHMENT_FAILED:\n"+
				"        case FF_STATUS_SENDMAIL_FAILED:\n"+
				"        default:\n"+
				"           alert(message);\n"+
				"    } // switch\n"+
				"} // ff_"+name+"_submitted\n";
			oldcode = form.script2code.value;
			if (oldcode != '')
				form.script2code.value =
					code+
					"\n// -------------- <?php echo BFText::_('FORMS_OLDCODEBELOW'); ?> --------------\n\n"+
					oldcode;
			else
				form.script2code.value = code;
			codeAreaChange(form.script2code);
		} // createSubmittedCode

		function dispheight(value)
		{
			switch (value) {
				case '0':
					document.getElementById('heightmargin').style.display = 'none';
					break;
				default:
					document.getElementById('heightmargin').style.display = '';
			} // switch
		} // dispheight

		function dispprevwidth()
		{
			var form = document.adminForm;
			if (form.widthmode.value=='0' || form.prevmode.value=='0')
				document.getElementById('prevwidthvalue').style.display = 'none';
			else
				document.getElementById('prevwidthvalue').style.display = '';
		} // dispprevwidth

		function dispinit(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('initlib').style.display = '';
						document.getElementById('initcode').style.display = 'none';
						break;
					case '2':
						document.getElementById('initlib').style.display = 'none';
						document.getElementById('initcode').style.display = '';
						break;
					default:
						document.getElementById('initlib').style.display = 'none';
						document.getElementById('initcode').style.display = 'none';
				} // switch
			} // if
		} // dispinit

		function dispsubmitted(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('submittedlib').style.display = '';
						document.getElementById('submittedcode').style.display = 'none';
						break;
					case '2':
						document.getElementById('submittedlib').style.display = 'none';
						document.getElementById('submittedcode').style.display = '';
						break;
					default:
						document.getElementById('submittedlib').style.display = 'none';
						document.getElementById('submittedcode').style.display = 'none';
				} // switch
			} // if
		} // dispsubmitted

		function dispemail(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '0':
						document.getElementById('emaillogging').style.display = 'none';
						document.getElementById('emailattachment').style.display = 'none';
						document.getElementById('emailaddress').style.display = 'none';
						break;
					case '1':
						document.getElementById('emaillogging').style.display = '';
						document.getElementById('emailattachment').style.display = '';
						document.getElementById('emailaddress').style.display = 'none';
						break;
					default:
						document.getElementById('emaillogging').style.display = '';
						document.getElementById('emailattachment').style.display = '';
						document.getElementById('emailaddress').style.display = '';
				} // switch
			} // if
		} // dispemail

		function dispp1(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('p1lib').style.display = '';
						document.getElementById('p1code').style.display = 'none';
						break;
					case '2':
						document.getElementById('p1lib').style.display = 'none';
						document.getElementById('p1code').style.display = '';
						break;
					default:
						document.getElementById('p1lib').style.display = 'none';
						document.getElementById('p1code').style.display = 'none';
				} // switch
			} // if
		} // dispp1

		function dispp2(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('p2lib').style.display = '';
						document.getElementById('p2code').style.display = 'none';
						break;
					case '2':
						document.getElementById('p2lib').style.display = 'none';
						document.getElementById('p2code').style.display = '';
						break;
					default:
						document.getElementById('p2lib').style.display = 'none';
						document.getElementById('p2code').style.display = 'none';
				} // switch
			} // if
		} // dispp2

		function dispp3(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('p3lib').style.display = '';
						document.getElementById('p3code').style.display = 'none';
						break;
					case '2':
						document.getElementById('p3lib').style.display = 'none';
						document.getElementById('p3code').style.display = '';
						break;
					default:
						document.getElementById('p3lib').style.display = 'none';
						document.getElementById('p3code').style.display = 'none';
				} // switch
			} // if
		} // dispp3

		function dispp4(value)
		{
			if(document.getElementById) {
				switch (value) {
					case '1':
						document.getElementById('p4lib').style.display = '';
						document.getElementById('p4code').style.display = 'none';
						break;
					case '2':
						document.getElementById('p4lib').style.display = 'none';
						document.getElementById('p4code').style.display = '';
						break;
					default:
						document.getElementById('p4lib').style.display = 'none';
						document.getElementById('p4code').style.display = 'none';
				} // switch
			} // if
		} // dispp4

		onload = function()
		{
<?php
			if ($row->script1cond!=0) echo "\t\t\tdispinit('".$row->script1cond."');\n";
			if ($row->script2cond!=0) echo "\t\t\tdispsubmitted('".$row->script2cond."');\n";
			if ($row->piece1cond !=0) echo "\t\t\tdispp1('".$row->piece1cond."');\n";
			if ($row->piece2cond !=0) echo "\t\t\tdispp2('".$row->piece2cond."');\n";
			if ($row->piece3cond !=0) echo "\t\t\tdispp3('".$row->piece3cond."');\n";
			if ($row->piece4cond !=0) echo "\t\t\tdispp4('".$row->piece4cond."');\n";
			switch ($tabpane) {
				case 1:
				case 2:
				case 3:
					echo "\t\t\ttabPane1.setSelectedIndex($tabpane);\n";
					break;
				default:
					echo "\t\t\tdocument.adminForm.title.focus();\n";
			} // switch
?>
			codeAreaAdd('script1code', 'script1lines');
			codeAreaAdd('script2code', 'script2lines');
			codeAreaAdd('piece1code',  'piece1lines');
			codeAreaAdd('piece2code',  'piece2lines');
			codeAreaAdd('piece3code',  'piece3lines');
			codeAreaAdd('piece4code',  'piece4lines');
		} // onload
		//-->
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script type="text/javascript" src="<?php echo $ff_mossite; ?>/includes/js/overlib_mini.js"></script>
		<form action="index2.php?format=html" method="post" name="adminForm" id="adminForm" class="adminForm">
		<table cellpadding="4" cellspacing="1" border="0" class="adminform" style="width:780px;">
			<tr><th colspan="3" class="title">BreezingForms - <?php echo $action; ?></th></tr>
			<tr>
				<td></td>
				<td width="100%">
<?php
		$tabs = new mosTabs(0);
		$tabs->startPane('editPane');
		$tabs->startTab(BFText::_('FORMS_SETTINGS'),'tab_settings');
?>
			<table class="adminform">
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_TITLE'); ?>:</td>
				<td nowrap>
					<input type="text" size="50" maxlength="50" name="title" value="<?php echo $row->title; ?>" class="inputbox"/>
<?php
					echo mosToolTip(BFText::_('FORMS_TIPTITLE'));
?>
				</td>
				<td></td>
			</tr>
<?php
if($pkg != 'EasyModeForms' && $pkg != 'QuickModeForms'){
?>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_PACKAGE'); ?>:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" id="package" name="package" value="<?php echo $row->package; ?>" class="inputbox"/>
				</td>
				<td></td>
			</tr>
<?php
}
?>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_NAME'); ?>:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" name="name" value="<?php echo $row->name; ?>" class="inputbox"/>
<?php
					echo mosToolTip(BFText::_('FORMS_TIPNAME'));
?>
				</td>
				<td></td>
			</tr>
			
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_CLASSFOR'); ?> &lt;div&gt;:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" name="class1" value="<?php echo $row->class1; ?>" class="inputbox"/>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_CLASSFOR'); ?> &lt;form&gt;:</td>
				<td nowrap>
					<input type="text" size="30" maxlength="30" name="class2" value="<?php echo $row->class2; ?>" class="inputbox"/>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_ORDERING'); ?>:</td>
				<td nowrap><?php echo $lists['ordering']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_PUBLISHED'); ?>:</td>
				<td nowrap><?php echo mosHTML::yesnoRadioList("published", "", $row->published); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_RUNMODE'); ?>:</td>
				<td nowrap>
					<select name="runmode" size="1" class="inputbox">
						<option value="0"<?php if ($row->runmode==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_ANY'); ?></option>
						<option value="1"<?php if ($row->runmode==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_FRONTEND'); ?></option>
						<option value="2"<?php if ($row->runmode==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_BACKEND'); ?></option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_WIDTH'); ?>:</td>
				<td nowrap>
					<input size="6" maxlength="6" name="width" value="<?php echo $row->width; ?>" class="inputbox" /><select name="widthmode" size="1" onchange="dispprevwidth();" class="inputbox">
						<option value="0"<?php if ($row->widthmode==0) echo ' selected="selected"'; ?>>px</option>
						<option value="1"<?php if ($row->widthmode==1) echo ' selected="selected"'; ?>>%</option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_HEIGHT'); ?>:</td>
				<td nowrap>
					<select name="heightmode" size="1" onchange="dispheight(this.value);" class="inputbox">
						<option value="0"<?php if ($row->heightmode==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_FIXED'); ?></option>
						<option value="1"<?php if ($row->heightmode==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_AUTO'); ?></option>
						<option value="2"<?php if ($row->heightmode==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_AUTOMAX'); ?></option>
					</select><span id="heightmargin"<?php if ($row->heightmode==0) echo ' style="display:none;"'; ?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo BFText::_('FORMS_BOTTOMMARGIN'); ?>:
					</span><input size="6" maxlength="6" name="height" value="<?php echo $row->height; ?>" class="inputbox"/> px
				</td>
				<td></td>
			</tr>
<?php
if($pkg != 'EasyModeForms' && $pkg != 'QuickModeForms'){
?>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_PREVMODE'); ?>:</td>
				<td nowrap>
					<select name="prevmode" size="1" onchange="dispprevwidth();" class="inputbox">
						<option value="0"<?php if ($row->prevmode==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NONE'); ?></option>
						<option value="1"<?php if ($row->prevmode==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_BELOW'); ?></option>
						<option value="2"<?php if ($row->prevmode==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_OVERLAYED'); ?></option>
					</select>
					<span id="prevwidthvalue"<?php if ($row->widthmode==0 || $row->prevmode==0) echo ' style="display:none;"'; ?>>
						&nbsp;&nbsp;&nbsp;&nbsp;<?php echo BFText::_('FORMS_WIDTH'); ?>: <input size="6" maxlength="6" name="prevwidth" value="<?php echo $row->prevwidth; ?>" class="inputbox" /> px
					</span>
				</td>
				<td></td>
			</tr>
<?php
}
?>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_LOGTODB'); ?>:</td>
				<td nowrap>
					<select name="dblog" size="1" class="inputbox">
						<option value="0"<?php if ($row->dblog==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NO'); ?></option>
						<option value="1"<?php if ($row->dblog==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NONEMPTY'); ?></option>
						<option value="2"<?php if ($row->dblog==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_ALLVALS'); ?></option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('FORMS_EMAILNOTIFY'); ?>:</td>
				<td>
					<select name="emailntf" size="1" onchange="dispemail(this.value);" class="inputbox">
						<option value="0"<?php if ($row->emailntf==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NO'); ?></option>
						<option value="1"<?php if ($row->emailntf==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_DEFADDR'); ?></option>
						<option value="2"<?php if ($row->emailntf==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_CUSTADDR'); ?></option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<table cellpadding="0" cellspacing="0" border="0">
						<tr id="emailaddress"<?php if ($row->emailntf!=2) echo ' style="display:none;"'; ?>>
							<td><?php echo BFText::_('FORMS_EMAIL'); ?>:</td>
							<td><input size="50" name="emailadr" value="<?php echo $row->emailadr; ?>" class="inputbox"/></td>
						</tr>
						<tr id="emaillogging"<?php if ($row->emailntf==0) echo ' style="display:none;"'; ?>>
							<td><?php echo BFText::_('FORMS_REPORT'); ?>:</td>
							<td>
								<select name="emaillog" size="1" class="inputbox">
									<option value="0"<?php if ($row->emaillog==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_HDRONLY'); ?></option>
									<option value="1"<?php if ($row->emaillog==1) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NONEMPTY'); ?></option>
									<option value="2"<?php if ($row->emaillog==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_ALLVALS'); ?></option>
								</select>
							</td>
						</tr>
						<tr id="emailattachment"<?php if ($row->emailntf==0) echo ' style="display:none;"'; ?>>
							<td><?php echo BFText::_('FORMS_ATTACHMENT'); ?>: </td>
							<td>
								<select name="emailxml" size="1" class="inputbox">
									<option value="0"<?php if ($row->emailxml==0) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_NO'); ?></option>
									<option value="1"<?php if ($row->emailxml==1) echo ' selected="selected"'; ?>><?php echo BFText::_('XML'); ?></option>
									<!--<option value="2"<?php if ($row->emailxml==2) echo ' selected="selected"'; ?>><?php echo BFText::_('FORMS_XML_ALLVALS'); ?></option>-->
									<option value="3"<?php if ($row->emailxml==3) echo ' selected="selected"'; ?>><?php echo BFText::_('CSV'); ?></option>
									<option value="4"<?php if ($row->emailxml==4) echo ' selected="selected"'; ?>><?php echo BFText::_('PDF'); ?></option>
								</select>
							</td>
						</tr>
					</table>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap><?php echo BFText::_('Custom mail subject'); ?>:</td>
				<td>
					<input name="custom_mail_subject"  value="<?php echo $row->custom_mail_subject; ?>" size="50"  class="inputbox"/>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<?php echo BFText::_('FORMS_DESCRIPTION'); ?>:
					<a href="#" onClick="textAreaResize('description',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
					<a href="#" onClick="textAreaResize('description',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
					<a href="#" onClick="textAreaResize('description',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
					<br/>
					<textarea wrap="off" name="description" style="width:700px;" rows="<?php echo $ff_config->areasmall; ?>" class="inputbox"><?php echo htmlspecialchars($row->description, ENT_QUOTES); ?></textarea>
				</td>
				<td></td>
			</tr>
			</table>
<?php
		if($pkg == 'EasyModeForms' || $pkg == 'QuickModeForms' ){
?>
<input type="hidden" name="package" value="<?php echo $row->package; ?>"/>
<input type="hidden" name="prevmode" value="2"/>
<?php			
		}

		$tabs->endTab();
		$tabs->startTab(BFText::_('FORMS_SCRIPTS'),'tab_scripts');
		$subsize = $initsize = $ff_config->areasmall;
		if ($row->script1cond==2)
			$initsize = $ff_config->areamedium;
		else
			if ($row->script2cond==2)
				$subsize = $ff_config->areamedium;
?>
			<table class="adminform">
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_INITSCRIPT'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="script1cond1" name="script1cond" value="0" onclick="dispinit(this.value)"<?php if ($row->script1cond==0) echo ' checked="checked"'; ?> /><label for="script1cond1"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="script1cond2" name="script1cond" value="1" onclick="dispinit(this.value)"<?php if ($row->script1cond==1) echo ' checked="checked"'; ?> /><label for="script1cond2"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="script1cond3" name="script1cond" value="2" onclick="dispinit(this.value)"<?php if ($row->script1cond==2) echo ' checked="checked"'; ?> /><label for="script1cond3"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="initlib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_SCRIPT'); ?>:</td>
								<td nowrap>
									<select name="script1id" class="inputbox" size="1">
<?php
										$scripts = $lists['init'];
										for ($i = 0; $i < count($scripts); $i++) {
											$script = $scripts[$i];
											$selected = '';
											if ($script->id == $row->script1id) $selected = ' selected';
											echo '<option value="'.$script->id.'"'.$selected.'>'.$script->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="initcode" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('script1code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('script1code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('script1code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<a href="#" onClick="createInitCode();"><?php echo BFText::_('FORMS_CREATEFRAME'); ?></a>
<?php
									echo mosToolTip(BFText::_('FORMS_TIPINITCODE'));
?>
									<br />
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="script1lines" style="width:60px;" rows="<?php echo $initsize; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="script1code" style="width:610px;" rows="<?php echo $initsize; ?>" class="inputbox"><?php echo htmlspecialchars($row->script1code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_SUBMITTEDSCRIPT'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="script2cond1" name="script2cond" value="0" onclick="dispsubmitted(this.value)"<?php if ($row->script2cond==0) echo ' checked="checked"'; ?> /><label for="script2cond1"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="script2cond2" name="script2cond" value="1" onclick="dispsubmitted(this.value)"<?php if ($row->script2cond==1) echo ' checked="checked"'; ?> /><label for="script2cond2"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="script2cond3" name="script2cond" value="2" onclick="dispsubmitted(this.value)"<?php if ($row->script2cond==2) echo ' checked="checked"'; ?> /><label for="script2cond3"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="submittedlib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_SCRIPT'); ?>:</td>
								<td nowrap>
									<select name="script2id" class="inputbox" size="1">
<?php
										$scripts = $lists['submitted'];
										for ($i = 0; $i < count($scripts); $i++) {
											$script = $scripts[$i];
											$selected = '';
											if ($script->id == $row->script2id) $selected = ' selected';
											echo '<option value="'.$script->id.'"'.$selected.'>'.$script->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="submittedcode" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('script2code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('script2code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('script2code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<a href="#" onClick="createSubmittedCode();"><?php echo BFText::_('FORMS_CREATEFRAME'); ?></a>
<?php
									echo mosToolTip(BFText::_('FORMS_TIPSUBMITTEDCODE'));
?>
									<br />
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="script2lines" style="width:60px;" rows="<?php echo $subsize; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="script2code" style="width:610px;" rows="<?php echo $subsize; ?>" class="inputbox"><?php echo htmlspecialchars($row->script2code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->startTab(BFText::_('FORMS_FORMPIECES'),'tab_formpieces');
		$p1size = $p2size = $ff_config->areasmall;
		if ($row->piece1cond==2)
			$p1size = $ff_config->areamedium;
		else
			if ($row->piece2cond==2)
				$p2size = $ff_config->areamedium;
?>
			<table class="adminform">
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_BEFOREFORM'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="piece1cond0" name="piece1cond" value="0" onclick="dispp1(this.value)"<?php if ($row->piece1cond==0) echo ' checked="checked"'; ?> /><label for="piece1cond0"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="piece1cond1" name="piece1cond" value="1" onclick="dispp1(this.value)"<?php if ($row->piece1cond==1) echo ' checked="checked"'; ?> /><label for="piece1cond1"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="piece1cond2" name="piece1cond" value="2" onclick="dispp1(this.value)"<?php if ($row->piece1cond==2) echo ' checked="checked"'; ?> /><label for="piece1cond2"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="p1lib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_PIECE'); ?>:</td>
								<td nowrap>
									<select name="piece1id" class="inputbox" size="1">
<?php
										$pieces = $lists['piece1'];
										for ($i = 0; $i < count($pieces); $i++) {
											$piece = $pieces[$i];
											$selected = '';
											if ($piece->id == $row->piece1id) $selected = ' selected';
											echo '<option value="'.$piece->id.'"'.$selected.'>'.$piece->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="p1code" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('piece1code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece1code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece1code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<br/>
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="piece1lines" style="width:60px;" rows="<?php echo $p1size; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="piece1code" style="width:610px;" rows="<?php echo $p1size; ?>" class="inputbox"><?php echo htmlspecialchars($row->piece1code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_AFTERFORM'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="piece2cond0" name="piece2cond" value="0" onclick="dispp2(this.value)"<?php if ($row->piece2cond==0) echo ' checked="checked"'; ?> /><label for="piece2cond0"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="piece2cond1" name="piece2cond" value="1" onclick="dispp2(this.value)"<?php if ($row->piece2cond==1) echo ' checked="checked"'; ?> /><label for="piece2cond1"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="piece2cond2" name="piece2cond" value="2" onclick="dispp2(this.value)"<?php if ($row->piece2cond==2) echo ' checked="checked"'; ?> /><label for="piece2cond2"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="p2lib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_PIECE'); ?>:</td>
								<td nowrap>
									<select name="piece2id" class="inputbox" size="1">
<?php
										$pieces = $lists['piece2'];
										for ($i = 0; $i < count($pieces); $i++) {
											$piece = $pieces[$i];
											$selected = '';
											if ($piece->id == $row->piece2id) $selected = ' selected';
											echo '<option value="'.$piece->id.'"'.$selected.'>'.$piece->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="p2code" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('piece2code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece2code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece2code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<br/>
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="piece2lines" style="width:60px;" rows="<?php echo $p2size; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="piece2code" style="width:610px;" rows="<?php echo $p2size; ?>" class="inputbox"><?php echo htmlspecialchars($row->piece2code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->startTab(BFText::_('FORMS_SUBMPIECES'),'tab_submpieces');
		$p3size = $p4size = $ff_config->areasmall;
		if ($row->piece3cond==2)
			$p3size = $ff_config->areamedium;
		else
			if ($row->piece4cond==2)
				$p4size = $ff_config->areamedium;
?>
			<table class="adminform">
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_BEGINSUBMIT'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="piece3cond0" name="piece3cond" value="0" onclick="dispp3(this.value)"<?php if ($row->piece3cond==0) echo ' checked="checked"'; ?> /><label for="piece3cond0"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="piece3cond1" name="piece3cond" value="1" onclick="dispp3(this.value)"<?php if ($row->piece3cond==1) echo ' checked="checked"'; ?> /><label for="piece3cond1"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="piece3cond2" name="piece3cond" value="2" onclick="dispp3(this.value)"<?php if ($row->piece3cond==2) echo ' checked="checked"'; ?> /><label for="piece3cond2"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="p3lib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_PIECE'); ?>:</td>
								<td nowrap>
									<select name="piece3id" class="inputbox" size="1">
<?php
										$pieces = $lists['piece3'];
										for ($i = 0; $i < count($pieces); $i++) {
											$piece = $pieces[$i];
											$selected = '';
											if ($piece->id == $row->piece3id) $selected = ' selected';
											echo '<option value="'.$piece->id.'"'.$selected.'>'.$piece->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="p3code" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('piece3code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece3code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece3code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<br/>
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="piece3lines" style="width:60px;" rows="<?php echo $p3size; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="piece3code" style="width:610px;" rows="<?php echo $p3size; ?>" class="inputbox"><?php echo htmlspecialchars($row->piece3code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<fieldset><legend><?php echo BFText::_('FORMS_ENDSUBMIT'); ?></legend>
						<table cellpadding="4" cellspacing="1" border="0">
							<tr>
								<td nowrap><?php echo BFText::_('FORMS_TYPE'); ?>:</td>
								<td nowrap>
									<input type="radio" id="piece4cond0" name="piece4cond" value="0" onclick="dispp4(this.value)"<?php if ($row->piece4cond==0) echo ' checked="checked"'; ?> /><label for="piece4cond0"> <?php echo BFText::_('FORMS_NONE'); ?></label>
									<input type="radio" id="piece4cond1" name="piece4cond" value="1" onclick="dispp4(this.value)"<?php if ($row->piece4cond==1) echo ' checked="checked"'; ?> /><label for="piece4cond1"> <?php echo BFText::_('FORMS_LIBRARY'); ?></label>
									<input type="radio" id="piece4cond2" name="piece4cond" value="2" onclick="dispp4(this.value)"<?php if ($row->piece4cond==2) echo ' checked="checked"'; ?> /><label for="piece4cond2"> <?php echo BFText::_('FORMS_CUSTOM'); ?></label>
								</td>
								<td></td>
							</tr>
							<tr id="p4lib" style="display:none;">
								<td nowrap><?php echo BFText::_('FORMS_PIECE'); ?>:</td>
								<td nowrap>
									<select name="piece4id" class="inputbox" size="1">
<?php
										$pieces = $lists['piece4'];
										for ($i = 0; $i < count($pieces); $i++) {
											$piece = $pieces[$i];
											$selected = '';
											if ($piece->id == $row->piece4id) $selected = ' selected';
											echo '<option value="'.$piece->id.'"'.$selected.'>'.$piece->text.'</option>';
										} // for
?>
									</select>
								</td>
								<td></td>
							</tr>
							<tr id="p4code" style="display:none;">
								<td nowrap valign="top" colspan="2">
									<a href="#" onClick="codeAreaResize('piece4code',<?php echo $ff_config->areasmall; ?>);">[<?php echo $ff_config->areasmall; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece4code',<?php echo $ff_config->areamedium; ?>);">[<?php echo $ff_config->areamedium; ?>]</a>
									<a href="#" onClick="codeAreaResize('piece4code',<?php echo $ff_config->arealarge; ?>);">[<?php echo $ff_config->arealarge; ?>]</a>
									<br/>
									<textarea onFocus="codeAreaFocus(this);" readonly="readonly" wrap="off" name="piece4lines" style="width:60px;" rows="<?php echo $p4size; ?>" class="inputbox"></textarea>
									<textarea onFocus="codeAreaFocus(this);" onKeyUp="codeAreaChange(this,event);" wrap="off" name="piece4code" style="width:610px;" rows="<?php echo $p4size; ?>" class="inputbox"><?php echo htmlspecialchars($row->piece4code, ENT_QUOTES); ?></textarea>
								</td>
								<td></td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td></td>
			</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->endPane();
?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap style="text-align:right">
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
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="pkg" value="<?php echo $pkg; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="manageforms" />
		<input type="hidden" name="pages" value="<?php echo $row->pages; ?>" />
		<input type="hidden" name="caller_url" value="<?php echo htmlspecialchars($caller, ENT_QUOTES); ?>" />
		</form>
<?php
	} // edit

	function listitems( $option, &$rows, &$pkglist )
	{
		global $ff_config, $ff_version;
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
							alert("<?php echo BFText::_('FORMS_SELFORMSFIRST'); ?>");
							return;
						} // if
						break;
					default:
						break;
				} // switch
				if (pressbutton == 'remove')
					if (!confirm("<?php echo BFText::_('FORMS_ASKDEL'); ?>")) return;
				if (pressbutton == '' && form.pkgsel.value == '')
					form.pkg.value = '- blank -';
				if (pressbutton == 'easymode')
					form.act.value = 'easymode'
				if (pressbutton == 'quickmode')
					form.act.value = 'quickmode'
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
		<form action="index2.php?format=html" method="post" name="adminForm">
		<table cellpadding="4" cellspacing="1" border="0">
			<tr>
				<td width="50%" nowrap>
					<table class="adminheading">
						<tr><th nowrap class="edit">BreezingForms <?php echo $ff_version; ?><br/><span class="componentheading"><?php echo BFText::_('FORMS_MANAGEFORMS'); ?></span></th></tr>
					</table>
				</td>
				<td nowrap>
					<?php echo BFText::_('FORMS_PACKAGE'); ?>:
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
		JToolBarHelper::custom('quickmode',  'new.png',       'new_f2.png',       BFText::_('TOOLBAR_QUICKMODE'),  false);
		JToolBarHelper::custom('easymode',  'new.png',       'new_f2.png',       BFText::_('TOOLBAR_EASYMODE'),  false);
		JToolBarHelper::custom('new',       'new.png',       'new_f2.png',       BFText::_('TOOLBAR_CLASSICMODE'),       false);
		JToolBarHelper::custom('copy',      'copy.png',      'copy_f2.png',      BFText::_('TOOLBAR_COPY'),      false);
		JToolBarHelper::custom('publish',   'publish.png',   'publish_f2.png',   BFText::_('TOOLBAR_PUBLISH'),   false);
		JToolBarHelper::custom('unpublish', 'unpublish.png', 'unpublish_f2.png', BFText::_('TOOLBAR_UNPUBLISH'), false);
		JToolBarHelper::custom('remove',    'delete.png',    'delete_f2.png',    BFText::_('TOOLBAR_DELETE'),    false);
?>
				</td>
			</tr>
		</table>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th nowrap align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
				<th nowrap align="left"><?php echo BFText::_('FORMS_TITLE'); ?></th>
				<th nowrap align="left"><?php echo BFText::_('FORMS_NAME'); ?></th>
				<th nowrap align="left"><?php echo BFText::_('FORMS_PAGES'); ?></th>
				<th nowrap align="right"><?php echo BFText::_('FORMS_WIDTH'); ?></th>
				<th nowrap align="right"><?php echo BFText::_('FORMS_HEIGHT'); ?></th>
				<th nowrap align="right"><?php echo BFText::_('FORMS_SCRIPTID'); ?></th>
				<th nowrap align="center"><?php echo BFText::_('FORMS_PUBLISHED'); ?></th>
				<th nowrap align="center" colspan="2"><?php echo BFText::_('FORMS_REORDER'); ?></th>
				<th align="left"><?php echo BFText::_('FORMS_DESCRIPTION'); ?></th>
			</tr>
<?php
			$k = 0;
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
				$desc = $row->description;
				if (strlen($desc) > $ff_config->limitdesc) $desc = substr($desc,0,$ff_config->limitdesc).'...';
?>
				<tr class="row<?php echo $k; ?>">
					<td nowrap valign="top" align="center"><input type="checkbox" id="cb<?php echo $i; ?>" name="ids[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
					
					<?php 
					if($row->template_code_processed != '' && $row->template_code_processed != 'QuickMode'){
					?>
					<td valign="top" align="left"><a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=easymode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>"><?php echo $row->title; ?></a></td>
					<td valign="top" align="left"><a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=easymode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>"><?php echo $row->name; ?></a></td>
					<?php } else if($row->template_code_processed == 'QuickMode') { ?>
					<td valign="top" align="left"><a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=quickmode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>"><?php echo $row->title; ?></a></td>
					<td valign="top" align="left"><a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=quickmode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>"><?php echo $row->name; ?></a></td>
					<?php } else { ?>
					<td valign="top" align="left"><a href="#editpage1" onclick="return listItemTask('cb<?php echo $i; ?>','editpage1')"><?php echo $row->title; ?></a></td>
					<td valign="top" align="left"><a href="#editform" onclick="return listItemTask('cb<?php echo $i; ?>','edit')"><?php echo $row->name; ?></a></td>
					<?php } ?>
					
					<td nowrap valign="top" align="left"><?php
					for ($p = 1; $p <= $row->pages; $p++) {
						if ($p > 1) echo '&nbsp;';
						if($row->template_code_processed == '' && $row->template_code_processed != 'QuickMode'){
						?><a href="#editpage<?php echo $p; ?>" onclick="return listItemTask('cb<?php echo $i; ?>','editpage<?php echo $p; ?>')"><?php echo $p; ?></a><?php
						}else if($row->template_code_processed == 'QuickMode'){
						?><a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=quickmode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>&amp;page=<?php echo $p; ?>"><?php echo $p; ?></a><?php	
						} else {?>
						<a href="index2.php?option=com_breezingforms&amp;format=html&amp;act=easymode&amp;formName=<?php echo $row->name?>&amp;form=<?php echo $row->id; ?>&amp;page=<?php echo $p; ?>"><?php echo $p; ?></a>
						<?php
						}
					} // for
					?></td>
					<td nowrap valign="top" align="right"><?php echo $row->width; if ($row->widthmode) echo '%'; else echo 'px'; ?></td>
					<td nowrap valign="top" align="right"><?php
					$text = '';
					switch ($row->heightmode) {
						case 1:
							$text = BFText::_('FORMS_AUTO');
							if ($row->height > 0) $text .= '+'.$row->height.'px';
							break;
						case 2:
							$text = BFText::_('FORMS_AUTOMAX');
							if ($row->height > 0) $text .= '+'.$row->height.'px';
							break;
						default:
							$text = $row->height.'px';
					} // switch
					echo $text; ?></td>
					<td nowrap valign="top" align="right"><?php echo $row->id; ?></td>
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
					<td valign="top" align="left"><?php echo htmlspecialchars($desc, ENT_QUOTES); ?></td>
				</tr>
<?php
				$k = 1 - $k;
			} // for
?>
		</table>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="act" value="manageforms" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="form" value="" />
		<input type="hidden" name="page" value="" />
		<input type="hidden" name="pkg" value="" />
		</form>
<?php
	} // listitems

} // class HTML_facileFormsForm

?>