<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class EasyModeHtml{
	
	public static function showApplication($formId = 0, $formName = '', $templateCode = '', $callbackParams = array(), $elementScripts = array(), $pages = 1, $page = 1){
		JHTML::_('behavior.keepalive');
?>

	<style type="text/css">
	<!--
	/* B-O-F: PARTIALLY GOES TO FRONT */
	
	li.ff_listItem {
		width: 100%;
		/*background-color:#3F0;*/
	}
	
	li.ff_listItem .ff_div {
		width: auto;
		background-color: #eaf3fa;
		/*border: solid 2px red;*/
		float: left;
	}
	
	/* E-O-F: PARTIALLY GOES TO FRONT */
	
	/* SYSTEM STYLES */
	.ui-resizable-handle, .ui-resizable, .ui-resizable-se, .ui-wrapper { /*border: 1px #000000 solid;*/ float: left; width: auto; }
	.bfOptionsTextInput { width: 100%; }
	#main-container-easymode { height: 100%; } 
	#menutab { float: left; width: 300px; height: 100%; }
	#form-area-easymode { padding-left: 310px; }
	#trashcan { list-style: none; }
	#trashcan-box { background: #fbfbfb url(<?php echo JURI::root() . 'administrator/components/com_breezingforms/libraries/jquery/themes/easymode/i/trash-here.png' ;?>) center no-repeat; margin-bottom: 10px; }
 	#trashcan-box ul#trashcan { width:100%; height:100px; overflow:auto; padding:0; margin:0; float:left; }
	.ff_dragBox { width: 10px; height: 10px; cursor: move; float: left; background-image: url("<?php echo JURI::root() . 'administrator/components/com_breezingforms/libraries/jquery/hand_icon.png' ?>"); }
	.draggableElement { padding: 2px; }
	-->
	</style>

	<!-- TEMPLATE STYLES -->
	<style>
	<!--
	.droppableArea { 
		list-style: none; 
		padding: 5px; 
		margin: 0;
		height: 600px;
		width: 100%;
		overflow: auto;
		background: #f6f6f6 url(<?php echo JURI::root() . 'administrator/components/com_breezingforms/libraries/jquery/themes/easymode/i/drag-here.png' ;?>) center no-repeat;
		border: 2px dashed #ccc;
		width: auto;
	}

	.droppableArea li { 
		margin: 0 0 0 0; 
		padding-bottom: 0px;
		width: 100%;
	}
	
 	.ff_label{  float: left; }
 	.ff_elem { float: right; border-width: 0px; border-color:  }
	-->
	</style>

	<link rel="stylesheet" href="<?php echo JURI::root() . 'administrator/components/com_breezingforms/libraries/jquery/themes/easymode/easymode.all.css' ;?>" type="text/css" media="screen" title="Flora (Default)">
	<?php require_once(JPATH_SITE . '/administrator/components/com_breezingforms/admin/easymode-js.php'); ?>

	<div>
		<?php echo JToolBarHelper::custom('save', 'save.png', 'save_f2.png', BFText::_('TOOLBAR_EASYMODE_SAVE'), false); ?>
		<?php
			if($formId != 0){ 
				echo JToolBarHelper::custom('editform', 'edit.png', 'save_f2.png', BFText::_('TOOLBAR_EASYMODE_FORM_EDIT'), false);
				echo JToolBarHelper::custom('preview', 'publish.png', 'save_f2.png', BFText::_('TOOLBAR_EASYMODE_PREVIEW'), false);
				echo JToolBarHelper::custom('preview_site', 'publish.png', 'save_f2.png', BFText::_('Site Preview'), false);
			} 
		?>
		<?php echo JToolBarHelper::title('<img src="'. JURI::root() . 'administrator/components/com_breezingforms/libraries/jquery/themes/easymode/i/logo-breezingforms.png'.'" />'); ?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="com_breezingforms" />
			<input type="hidden" name="act" value="easymode" />
			<input type="hidden" name="templateCode" value="" />
			<input type="hidden" name="areas" value="" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="form" value="<?php echo $formId;?>" />
			<input type="hidden" name="formName" value="<?php echo $formName;?>" />
			<input type="hidden" name="page" value="<?php echo $page ?>" />
			<input type="hidden" name="pages" value="<?php echo $pages ?>" />
		</form>
	</div>
	
	<div style="clear:both;"></div>
   
<form name="bfForm" onsubmit="return false;">
   
<div id="main-container-easymode">

	<div id="menutab" class="flora">
            <ul>
                <li><a href="#fragment-1" onclick="app.refreshTemplateBox();app.refreshBatchOptions();"><span><div class="tab-items"><?php echo BFText::_('Items') ?></div></span></a></li>
                <li><a href="#fragment-2" onclick="app.refreshTemplateBox();app.refreshBatchOptions();"><span><div class="tab-element"><?php echo BFText::_('Element') ?></div></span></a></li>
                <li><a href="#fragment-3" onclick="app.refreshTemplateBox();app.refreshBatchOptions();"><span><div class="tab-form"><?php echo BFText::_('Form') ?></div></span></a></li>
            </ul>
            <div class="t">

				<div class="t">
					<div class="t"></div>
		 		</div>
	 		</div>
	 		
	 		<div class="m">
	 		
            <div id="fragment-1">
            	<div>
	                <ul id="nestedaccordion" class="ui-accordion-container" style="width: 275px;">
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Basic') ?><div class="ui-accordion-right"></div></a>
							<div>
							
								
									<div class="draggableElement" id="bfStaticText" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-statictext"><?php echo BFText::_('Static Text') ?></span>
									</div>
								
									<div class="draggableElement" id="bfTextfield" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-textfield"><?php echo BFText::_('Textfield') ?></span>
									</div>
									
									<div class="draggableElement" id="bfTextarea" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-textarea"><?php echo BFText::_('Textarea') ?></span>
									</div>
									
									<div class="draggableElement" id="bfCheckbox" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-checkbox"><?php echo BFText::_('Checkbox') ?></span>
									</div>
									
									<div class="draggableElement" id="bfRadio" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-radio"><?php echo BFText::_('Radio') ?></span>
									</div>
									
									<div class="draggableElement" id="bfSelect" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-select"><?php echo BFText::_('Select') ?></span>
									</div>
									
									<div class="draggableElement" id="bfFile" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-file"><?php echo BFText::_('File') ?></span>
									</div>
									
									<div class="draggableElement" id="bfTooltip" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-tooltip"><?php echo BFText::_('Tooltip') ?></span>
									</div>
									
									<div class="draggableElement" id="bfIcon" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-icon"><?php echo BFText::_('Icon') ?></span>
									</div>
									
									<div class="draggableElement" id="bfSubmitButton" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-submitbutton"><?php echo BFText::_('Submitbutton') ?></span>
									</div>
									
									<div class="draggableElement" id="bfImageButton" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-imagebutton"><?php echo BFText::_('Image Button') ?></span>
									</div>
									
									<div class="draggableElement" id="bfHidden" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
										<span class="icon-hiddeninput"><?php echo BFText::_('Hidden Input') ?></span>
									</div>
									
							
							</div>
						</li>
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Special') ?><div class="ui-accordion-right"></div></a>
							<div>
							
								<div class="draggableElement" id="bfCaptcha" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
									<span class="icon-captcha"><?php echo BFText::_('Captcha') ?></span>
								</div>
							
								<div class="draggableElement" id="bfCalendar" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
									<span class="icon-calendar"><?php echo BFText::_('Calendar') ?></span>
								</div>
							
								<div class="draggableElement" id="bfPayPal" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
									<span class="icon-paypal"><?php echo BFText::_('PayPal') ?></span>
								</div>
							
								<div class="draggableElement" id="bfSofortueberweisung" style="z-index:1000;" onMouseover="this.style.backgroundColor='#eaf3fa';" onMouseout="this.style.backgroundColor='white';">
									<span class="icon-sofort"><?php echo BFText::_('Sofortüberweisung') ?></span>
								</div>
							
							</div>
						</li>
					</ul>
				</div>
            </div>
            <div id="fragment-2">
                <div>
	                <ul id="nestedaccordion2" class="ui-accordion-container" style="width: 275px;">
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Options') ?><div class="ui-accordion-right"></div></a>
							<div>
								<div id="bfOptionsWrapper" style="display:none;">
								<br/>
								<span id="bfOptionsSaveMessage" style="visibility:hidden;display:none"></span>
								<!-- Calendar -->
								<div id="bfCalendarOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Link-Text (May contain HTML)') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfCalendarText"></textarea>
									<br/>
									<?php echo BFText::_('Format') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCalendarFormat" value=""/>
									<br/>
									<?php echo BFText::_('Connect With Field (name)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCalendarConnectWith" value=""/>
								</div>
								<!-- Captcha -->
								<div id="bfCaptchaOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCaptchaWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCaptchaHeight" value=""/>
								</div>
								<!-- Label -->
								<div id="bfLabelOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Content (may contain HTML)') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfLabelContent" rows="10"></textarea>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfLabelWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfLabelHeight" value=""/>
									<br/>
									<?php echo BFText::_('On top?') ?>
									<br/>
									<input type="checkbox" id="bfLabelOnTop" value=""/>
								</div>
								<!-- Static Text -->
								<div id="bfStaticTextOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfStaticTextTitle" value=""/>
									<br/>
									<?php echo BFText::_('Content (may contain HTML)') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfStaticTextContent" rows="10"></textarea>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfStaticTextWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfStaticTextHeight" value=""/>
								</div>
								<!-- Text -->
								<div id="bfTextfieldOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldName" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldValue" value=""/>
									<br/>
									<?php echo BFText::_('Password?') ?>
									<br/>
									<input type="checkbox" id="bfTextfieldPassword" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Mailback?') ?>
									<br/>
									<input type="checkbox" id="bfTextfieldMailback" value=""/>
									<br/>
									<?php echo BFText::_('Mailback as sender?') ?>
									<br/>
									<input type="checkbox" id="bfTextfieldMailbackAsSender" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Mailbackfile (If is mailback, a file from this server path is sent to the mailback address)') ?>
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldMailbackfile" style="width:100%"/>
									<br/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldHeight" value=""/>
									<br/>
									<?php echo BFText::_('Maxlength') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextfieldMaxlength" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfTextfieldDisable" value="disable"/>
								</div>
								<!-- Textarea -->
								<div id="bfTextareaOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextareaTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextareaName" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfTextareaValue"></textarea>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextareaWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTextareaHeight" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfTextareaDisable" value="disable"/>
								</div>
								<!-- Checkbox -->
								<div id="bfCheckboxOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxName" value=""/>
									<br/>
									<?php echo BFText::_('Checked') ?>:
									<br/>
									<input type="checkbox" id="bfCheckboxChecked" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Mailback Accept') ?>:
									<br/>
									<input type="checkbox" id="bfCheckboxMailbackAccept" value=""/>
									<br/>
									<?php echo BFText::_('Mailback Accept - Connect With (name)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxMailbackAcceptConnectWith" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxValue" value=""/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfCheckboxHeight" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfCheckboxDisable" value="disable"/>
								</div>
								<!-- Radio -->
								<div id="bfRadioOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfRadioTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfRadioName" value=""/>
									<br/>
									<?php echo BFText::_('Checked') ?>:
									<br/>
									<input type="checkbox" id="bfRadioChecked" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfRadioValue" value=""/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfRadioWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfRadioHeight" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfRadioDisable" value="disable"/>
								</div>
								<!-- Select -->
								<div id="bfSelectOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSelectTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSelectName" value=""/>
									<br/>
									<?php echo BFText::_('Multiple') ?>:
									<br/>
									<?php echo BFText::_('Yes') ?> <input type="radio" name="bfSelectMultiple" id="bfSelectMultipleYes" value="1"/> <?php echo BFText::_('No') ?> <input type="radio" name="bfSelectMultiple" id="bfSelectMultipleNo" value="0"/>
									<br/>
									<br/>
									<?php echo BFText::_('Options') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfSelectOpts" rows="10"></textarea>
									<br/>
									<br/>
									<?php echo BFText::_('Mailback?') ?>
									<br/>
									<input type="checkbox" id="bfSelectMailback" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSelectWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSelectHeight" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfSelectDisable" value="disable"/>
								</div>
								<!-- File -->
								<div id="bfFileOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileName" value=""/>
									<br/>
									<?php echo BFText::_('Add timestamp to filename?') ?>
									<br/>
									<input type="checkbox" id="bfFileTimestamp" value="1"/>
									<br/>
									<br/>
									<?php echo BFText::_('Upload Directory') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileUploadDirectory" value=""/>
									<br/>
									<?php echo BFText::_('Allowed file extensions') ?>
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileAllowedFileExtensions" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Attach file to admin mail(s)') ?>
									<br/>
									<input type="checkbox" id="bfFileAttachToAdminMail" value="0"/>
									<br/>
									<br/>
									<?php echo BFText::_('Attach file to user mail(s)') ?>
									<br/>
									<input type="checkbox" id="bfFileAttachToUserMail" value="0"/>
									<br/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfFileHeight" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfFileDisable" value="disable"/>
								</div>
								<!-- Icon -->
								<div id="bfIconOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Caption (May contain HTML)') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfIconCaption"></textarea>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfIconWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfIconHeight" value=""/>
									<br/>
									<?php echo BFText::_('Icon Image') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfIconImage" value=""/>
									<br/>
									<?php echo BFText::_('Icon Image Over') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfIconImageOver" value=""/>
								</div>
								<!-- Image Button -->
								<div id="bfImageButtonOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonName" value=""/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonHeight" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonValue" value=""/>
									<br/>
									<?php echo BFText::_('Image') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfImageButtonImage" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfImageButtonDisable" value="disable"/>
								</div>
								<!-- Submit Button -->
								<div id="bfSubmitButtonOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSubmitButtonTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSubmitButtonName" value=""/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSubmitButtonWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSubmitButtonHeight" value=""/>
									<br/>
									<?php echo BFText::_('Value') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSubmitButtonValue" value=""/>
									<br/>
									<?php echo BFText::_('Disable?') ?>
									<br/>
									<input type="checkbox" id="bfSubmitButtonDisable" value="disable"/>
								</div>
								<!-- Tooltip -->
								<div id="bfTooltipOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTooltipTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTooltipName" value=""/>
									<br/>
									<?php echo BFText::_('Type') ?>:
									<br/>
									<input type="radio" name="bfTooltipType" id="bfTooltipTypeInfo" value="info"/> <img src="<?php echo JURI::root(); ?>includes/js/ThemeOffice/tooltip.png"/>
									<input type="radio" name="bfTooltipType" id="bfTooltipTypeWarning" value="warning"/> <img src="<?php echo JURI::root(); ?>includes/js/ThemeOffice/warning.png"/>
									<input type="radio" name="bfTooltipType" id="bfTooltipTypeCustom" value="warning"/> <?php echo BFText::_('Custom') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTooltipCustomImage" value=""/>
									<br/>
									<br/>
									<?php echo BFText::_('Text') ?>:
									<br/>
									<textarea class="bfOptionsTextInput" id="bfTooltipText"></textarea>
									<br/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTooltipWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfTooltipHeight" value=""/>
									<br/>
								</div>
								<!-- PayPal -->
								<div id="bfPayPalOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalName" value=""/>
									<br/>
									<?php echo BFText::_('Testaccount?') ?>:
									<br/>
									<?php echo BFText::_('Yes') ?><input type="radio" id="bfPayPalTestaccountYes" name="bfPayPalTestaccount" value="1"/>
									<?php echo BFText::_('No') ?><input type="radio" id="bfPayPalTestaccountNo" name="bfPayPalTestaccount" value="0" checked="checked"/>
									<br/>
									<br/>
									<?php echo BFText::_('Account') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalBusiness" value=""/>
									<br/>
									<?php echo BFText::_('Account-Token (get it from PayPal)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalToken" value=""/>
									<br/>
									<?php echo BFText::_('Test-Account') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalTestBusiness" value=""/>
									<br/>
									<?php echo BFText::_('Test-Account-Token (get it from PayPal Sandbox)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalTestToken" value=""/>
									<br/>
									<?php echo BFText::_('Downloadable-File?') ?>:
									<br/>
									<?php echo BFText::_('Yes') ?><input type="radio" id="bfPayPalDownloadableFileYes" name="bfPayPalDownloadableFile" value="1"/>
									<?php echo BFText::_('No') ?><input type="radio" id="bfPayPalDownloadableFileNo" name="bfPayPalDownloadableFile" value="0" checked="checked"/>
									<br/>
									<br/>
									<?php echo BFText::_('Filepath (Please chmod 700 the file using your FTP client or put it outside of your webfolder!)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalFilepath" value=""/>
									<br/>
									<?php echo BFText::_('File download tries') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalFileDownloadTries" value="1"/>
									<br/>
									<?php echo BFText::_('Itemname') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalItemname" value=""/>
									<br/>
									<?php echo BFText::_('Itemnumber') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalItemnumber" value=""/>
									<br/>
									<?php echo BFText::_('Amount') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalAmount" value=""/>
									<br/>
									<?php echo BFText::_('Tax') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalTax" value=""/>
									<br/>
									<?php echo BFText::_('ThankYou-Page (If not downloadable file)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalThankYouPage" value="<?php echo JURI::root() ?>"/>
									<br/>
									<?php echo BFText::_('Locale') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalLocale" value="us"/>
									<br/>
									<?php echo BFText::_('Currency-Code') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalCurrencyCode" value="USD"/>
									<br/>
									<?php echo BFText::_('PayPal-Image') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalImage" value="http://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif"/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfPayPalHeight" value=""/>
									<br/>
								</div>
								<br/>
								<!-- Sofortüberweisung -->
								<div id="bfSofortueberweisungOptions" class="bfOptions" style="visibility:hidden;display:none">
									<?php echo BFText::_('Title') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungTitle" value=""/>
									<br/>
									<?php echo BFText::_('Name') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungName" value=""/>
									<br/>
									<?php echo BFText::_('User-ID') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungUserId" value=""/>
									<br/>
									<?php echo BFText::_('Project-ID') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungProjectId" value=""/>
									<br/>
									<?php echo BFText::_('Project-Password') ?>:
									<br/>
									<input type="password" class="bfOptionsTextInput" id="bfSofortueberweisungProjectPassword" value=""/>
									<br/>
									<?php echo BFText::_('Send payment success message to mailback addresses?') ?>:
									<br/>
									<?php echo BFText::_('Yes') ?><input type="radio" id="bfSofortueberweisungMailbackYes" name="bfSofortueberweisungMailback" value="1"/>
									<?php echo BFText::_('No') ?><input type="radio" id="bfSofortueberweisungMailbackNo" name="bfSofortueberweisungMailback" value="0" checked="checked"/>
									<br/>
									<br/>
									<?php echo BFText::_('Downloadable-File?') ?>:
									<br/>
									<?php echo BFText::_('Yes') ?><input type="radio" id="bfSofortueberweisungDownloadableFileYes" name="bfSofortueberweisungDownloadableFile" value="1"/>
									<?php echo BFText::_('No') ?><input type="radio" id="bfSofortueberweisungDownloadableFileNo" name="bfSofortueberweisungDownloadableFile" value="0" checked="checked"/>
									<br/>
									<br/>
									<?php echo BFText::_('Filepath (Please chmod 700 the file using your FTP client or put it outside of your webfolder!)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungFilepath" value=""/>
									<br/>
									<?php echo BFText::_('File download tries') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungFileDownloadTries" value="1"/>
									<br/>
									<?php echo BFText::_('Reason 1') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungReason1" value=""/>
									<br/>
									<?php echo BFText::_('Reason 2') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungReason2" value=""/>
									<br/>
									<?php echo BFText::_('Amount') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungAmount" value=""/>
									<br/>
									<?php echo BFText::_('ThankYou-Page (If not downloadable file)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungThankYouPage" value="<?php echo JURI::root() ?>"/>
									<br/>
									<?php echo BFText::_('Language-ID (possible values: DE, EN, NL, FR)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungLanguageId" value="DE"/>
									<br/>
									<?php echo BFText::_('Currency-ID (possible values: EUR, CHF)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungCurrencyId" value="EUR"/>
									<br/>
									<?php echo BFText::_('Sofortueberweisung-Image') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungImage" value="<?php echo JURI::root()?>components/com_breezingforms/images/200x65px.png"/>
									<br/>
									<?php echo BFText::_('Width') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungWidth" value=""/>
									<br/>
									<?php echo BFText::_('Height') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfSofortueberweisungHeight" value=""/>
									<br/>
								</div>
								<br/>
								<div id="bfGlobalOptions" style="display:none">
									<?php echo BFText::_('Padding') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfOptionsPadding" value=""/>
									<br/>
									<?php echo BFText::_('Margin') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfOptionsMargin" value=""/>
									<br/>
									<?php echo BFText::_('Order (Number)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfOptionsOrder" value=""/>
									<br/>
									<?php echo BFText::_('Tab-Index (Number)') ?>:
									<br/>
									<input type="text" class="bfOptionsTextInput" id="bfOptionsTabIndex" value=""/>
									<br/>
								</div>
								<input type="submit" value="<?php echo BFText::_('update') ?>" id="bfSaveOptionsButton" style="visibility:hidden;display:none;width:100%;"/>
								<br/>
								<br/>
								<input type="submit" value="<?php echo BFText::_('remove') ?>" id="bfRemoveLabelButton" style="visibility:hidden;display:none;width:100%;"/>
								<br/>
								<br/>
							</div>
							</div>
						</li>
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Actions') ?><div class="ui-accordion-right"></div></a>
							<div id="bfActions" style="display:none">
								<br/>
								<select id="bfBesideCreationButton" style="width:100%" onchange="app.createElementBesideByType(app.optionElement, this)">
									<option value=""><?php echo BFText::_('Create element beside...') ?></option>
									<option value="bfStaticText"><?php echo BFText::_('Static Text') ?></option>
									<option value="bfTextfield"><?php echo BFText::_('Textfield') ?></option>
									<option value="bfTextarea"><?php echo BFText::_('Textarea') ?></option>
									<option value="bfCheckbox"><?php echo BFText::_('Checkbox') ?></option>
									<option value="bfRadio"><?php echo BFText::_('Radio') ?></option>
									<option value="bfSelect"><?php echo BFText::_('Select') ?></option>
									<option value="bfFile"><?php echo BFText::_('File') ?></option>
									<option value="bfTooltip"><?php echo BFText::_('Tooltip') ?></option>
									<option value="bfIcon"><?php echo BFText::_('Icon') ?></option>
									<option value="bfSubmitButton"><?php echo BFText::_('Submit Button') ?></option>
									<option value="bfImageButton"><?php echo BFText::_('Image Button') ?></option>
									<option value="bfCaptcha"><?php echo BFText::_('Captcha') ?></option>
									<option value="bfCalendar"><?php echo BFText::_('Calendar') ?></option>
									<option value="bfPayPal"><?php echo BFText::_('PayPal') ?></option>
									<option value="bfSofortueberweisung"><?php echo BFText::_('SofortÃ¼berweisung') ?></option>
								</select>
								<br/>
								<br/>
								<input type="submit" id="bfElementRemoveButton" onclick="app.removeElement(app.optionElement)" value="<?php echo BFText::_('Remove element') ?>" style="visibility:hidden;display:none;width:100%;">
								<br/>
								<br/>
								<input type="submit" id="bfElementMoveLeft" onclick="app.moveElement(app.optionElement, 'prev')" value="<?php echo BFText::_('move left') ?>" style="width:49%;visibility:hidden;display:none">
								<input type="submit" id="bfElementMoveRight" onclick="app.moveElement(app.optionElement, 'next')" value="<?php echo BFText::_('move right') ?>" style="width:49%;visibility:hidden;display:none">
								<br/>
								<br/>
							</div>
						</li>
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Init Script') ?><div class="ui-accordion-right"></div></a>
							<div>
								<div id="bfInitScript" style="display:none">
									<br/>
									<span class="bfScriptsSaveMessage" style="display:none"></span>
									<?php echo BFText::_('Type') ?>:
									<?php echo BFText::_('None') ?> <input onclick="JQuery('#bfInitScriptFlags').css('display','none');JQuery('#bfInitScriptLibrary').css('display','none');JQuery('#bfInitScriptCustom').css('display','none');" type="radio" name="initType" id="bfInitTypeNone" class="bfInitType" value="0"/>
									<?php echo BFText::_('Library') ?> <input onclick="JQuery('#bfInitScriptFlags').css('display','');JQuery('#bfInitScriptLibrary').css('display','');JQuery('#bfInitScriptCustom').css('display','none');" type="radio" name="initType" id="bfInitTypeLibrary" class="bfInitType" value="1"/>
									<?php echo BFText::_('Custom') ?> <input onclick="JQuery('#bfInitScriptFlags').css('display','');JQuery('#bfInitScriptLibrary').css('display','none');JQuery('#bfInitScriptCustom').css('display','');" type="radio" name="initType" id="bfInitTypeCustom" class="bfInitType" value="2"/>
									
									<div id="bfInitScriptFlags" style="display:none">
										<hr/>
										
										<input type="checkbox" id="script1flag1" class="script1flag" name="script1flag1" value="1"/><label for="script1flag1"> <?php echo BFText::_('ELEMENTS_FORMENTRY'); ?></label>
										<input type="checkbox" id="script1flag2" class="script1flag" name="script1flag2" value="1"/><label for="script1flag2"> <?php echo BFText::_('ELEMENTS_PAGEENTRY'); ?></label>
									</div>
									
									<div id="bfInitScriptLibrary" style="display:none">
										<hr/>
										<?php echo BFText::_('Script') ?>: <select id="bfInitScriptSelection"></select>
									</div>
									
									<div id="bfInitScriptCustom" style="display:none">
										<hr/>
										<div style="cursor: pointer;" onclick="createInitCode(app.optionElement)"><?php echo BFText::_('Create code framework') ?></div>
										<textarea name="script1code" id="script1code" rows="10" style="width:100%" wrap="off"></textarea>
									</div>
									
									<hr/>
									
									<input id="bfInitButton" type="submit" value="update" style="width:100%"/>
									
									<br/>
									<br/>
								</div>
							</div>
						</li>
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Action Script') ?><div class="ui-accordion-right"></div></a>
							<div>
								<span class="bfScriptsSaveMessage" style="display:none"></span>
								<div id="bfActionScript" style="display:none">
									<?php echo BFText::_('Type') ?>:
									<?php echo BFText::_('None') ?> <input onclick="JQuery('#bfActionScriptFlags').css('display','none');JQuery('#bfActionScriptLibrary').css('display','none');JQuery('#bfActionScriptCustom').css('display','none');" type="radio" name="actionType" name="actionType" id="bfActionTypeNone" class="bfActionType" value="0"/>
									<?php echo BFText::_('Library') ?> <input onclick="JQuery('#bfActionScriptFlags').css('display','');JQuery('#bfActionScriptLibrary').css('display','');JQuery('#bfActionScriptCustom').css('display','none');" type="radio" name="actionType" id="bfActionTypeLibrary" class="bfActionType" value="1"/>
									<?php echo BFText::_('Custom') ?> <input onclick="JQuery('#bfActionScriptFlags').css('display','');JQuery('#bfActionScriptLibrary').css('display','none');JQuery('#bfActionScriptCustom').css('display','');" type="radio" name="actionType" id="bfActionTypeCustom" class="bfActionType" value="2"/>
									
									<div id="bfActionScriptFlags" style="display:none">
										<hr/>
										
										<?php echo BFText::_('Actions') ?>:
										<input style="display:none" type="checkbox" class="script2flag" id="script2flag1" name="script2flag1" value="1"/><label style="display:none" class="script2flagLabel" id="script2flag1Label" for="script2flag1"> <?php echo BFText::_('ELEMENTS_CLICK'); ?></label>
										<input style="display:none" type="checkbox" class="script2flag" id="script2flag2" name="script2flag2" value="1"/><label style="display:none" class="script2flagLabel" id="script2flag2Label"> <?php echo BFText::_('ELEMENTS_BLUR'); ?></label>
										<input style="display:none" type="checkbox" class="script2flag" id="script2flag3" name="script2flag3" value="1"/><label style="display:none" class="script2flagLabel" id="script2flag3Label"> <?php echo BFText::_('ELEMENTS_CHANGE'); ?></label>
										<input style="display:none" type="checkbox" class="script2flag" id="script2flag4" name="script2flag4" value="1"/><label style="display:none" class="script2flagLabel" id="script2flag4Label"> <?php echo BFText::_('ELEMENTS_FOCUS'); ?></label>
										<input style="display:none" type="checkbox" class="script2flag" id="script2flag5" name="script2flag5" value="1"/><label style="display:none" class="script2flagLabel" id="script2flag5Label"> <?php echo BFText::_('ELEMENTS_SELECTION'); ?></label>
									</div>
									
									<div id="bfActionScriptLibrary" style="display:none">
										<hr/>
										<?php echo BFText::_('Script') ?>: <select id="bfActionsScriptSelection"></select>
									</div>
									
									<div id="bfActionScriptCustom" style="display:none">
										<hr/>
										<div style="cursor: pointer;" onclick="createActionCode(app.optionElement)"><?php echo BFText::_('Create code framework') ?></div>
										<textarea name="script2code" id="script2code" rows="10" style="width:100%" wrap="off"></textarea>
									</div>
									
									<hr/>
									
									<input id="bfActionButton" type="submit" value="<?php echo BFText::_('update') ?>" style="width:100%"/>
									
									<br/>
									<br/>
								</div>
							</div>
						</li>
						<li>
							<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Validation Script') ?><div class="ui-accordion-right"></div></a>
							<div>
								<span class="bfScriptsSaveMessage" style="display:none"></span>
								<div id="bfValidationScript" style="display:none">
								
									<?php echo BFText::_('Type') ?>:
									<?php echo BFText::_('None') ?> <input onclick="JQuery('#bfValidationScriptFlags').css('display','none');JQuery('#bfValidationScriptLibrary').css('display','none');JQuery('#bfValidationScriptCustom').css('display','none');" type="radio" name="validationType" id="bfValidationTypeNone" class="bfValidationType" value="0"/>
									<?php echo BFText::_('Library') ?> <input onclick="JQuery('#bfValidationScriptFlags').css('display','');JQuery('#bfValidationScriptLibrary').css('display','');JQuery('#bfValidationScriptCustom').css('display','none');" type="radio" name="validationType" id="bfValidationTypeLibrary" class="bfValidationType" value="1"/>
									<?php echo BFText::_('Custom') ?> <input onclick="JQuery('#bfValidationScriptFlags').css('display','');JQuery('#bfValidationScriptLibrary').css('display','none');JQuery('#bfValidationScriptCustom').css('display','');" type="radio" name="validationType" id="bfValidationTypeCustom" class="bfValidationType" value="2"/>
									
									<div id="bfValidationScriptFlags" style="display:none">
										<hr/>
										<?php echo BFText::_('Error Message') ?>: <input type="text" style="width:100%" maxlength="255" class="script3msg" id="script3msg" name="script3msg" value="" class="inputbox"/>
									</div>
									
									<div id="bfValidationScriptLibrary" style="display:none">
										<hr/>
										<?php echo BFText::_('Script') ?>: <select id="bfValidationScriptSelection"></select>
									</div>
									
									<div id="bfValidationScriptCustom" style="display:none">
										<hr/>
										<div style="cursor: pointer;" onclick="createValidationCode(app.optionElement)"><?php echo BFText::_('Create code framework') ?></div>
										<textarea name="script3code" id="script3code" rows="10" style="width:100%" wrap="off"></textarea>
									</div>
									
									<hr/>
									
									<input id="bfValidationButton" type="submit" value="<?php echo BFText::_('update') ?>" style="width:100%"/>
									
									<br/>
									<br/>
								
								</div>
							</div>
						</li>
					</ul>
				</div>
            </div>
            <div id="fragment-3">
               <div>
               	
               	<ul id="nestedaccordion3" class="ui-accordion-container" style="width: 275px;">
               	
               		<li>
						<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Pages') ?><div class="ui-accordion-right"></div></a>
						<div>
							<br/>
							<?php echo BFText::_('Current Page') ?>: <span id="bfCurrentPage"></span>
							<br/>
							<br/>
							<input type="submit" value="<?php echo BFText::_('create new page') ?>" id="bfCreatePage" style="width:100%"/>
							<br/>
							<br/>
							<select id="bfGoToPage" style="width:100%">
							<option value="-1"><?php echo BFText::_('Go to page...') ?></option>
							</select>
							<br/>
							<br/>
							<select id="bfMoveThisPageTo" style="width:100%">
							<option value="-1"><?php echo BFText::_('Move this page to...') ?></option>
							</select>
							<br/>
							<br/>
							<input type="submit" value="<?php echo BFText::_('delete this page') ?>" id="bfDeleteThisPage" style="width:100%"/>
							<br/>
							<br/>
						</div>
					</li>
               		
               		<li>
						<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Hidden Fields') ?><div class="ui-accordion-right"></div></a>
						<div>
							<div id="bfHiddenFieldsOptions">
							
							</div>
						</div>
					</li>
               		
               		<li>
						<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Code') ?><div class="ui-accordion-right"></div></a>
						<div>
							<?php echo BFText::_('Attention: Change the generated template code on your own risk! Best is to keep the ul-tags and their contents as is and change only the layout around if necessary. And never update when you have unsaved elements in the editor!') ?>
							<br/>
							<br/>
							<textarea rows="10" style="width:100%;" id="bfTemplateBox" wrap="off"></textarea>
							<br/>
							<input type="submit" id="bfUpdateTemplateButton" value="<?php echo BFText::_('update') ?>" style="width:100%"/>
							<br/>
							<br/>
						</div>
					</li>
					
					<li>
						<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Batch Options') ?><div class="ui-accordion-right"></div></a>
						<div>
							<br/>
							<?php echo BFText::_('Labels') ?>
							<br/>
							<select id="bfBatchLabels" multiple="multiple" style="width:100%;height:100px;"></select>
							<br/>
							<?php echo BFText::_('Elements') ?>
							<br/>
							<select id="bfBatchElements" multiple="multiple" style="width:100%;height:100px;"></select>
							<br/>
							<?php echo BFText::_('Width') ?>
							<br/>
							<input type="text" id="bfBatchWidth" value="" style="width:100%"/>
							<br/>
							<?php echo BFText::_('Height') ?>
							<br/>
							<input type="text" id="bfBatchHeight" value="" style="width:100%"/>
							<br/>
							<?php echo BFText::_('Padding') ?>
							<br/>
							<input type="text" id="bfBatchPadding" value="" style="width:100%"/>
							<br/>
							<?php echo BFText::_('Margin') ?>
							<br/>
							<input type="text" id="bfBatchMargin" value="" style="width:100%"/>
							<br/>
							<input type="submit" id="bfBatchButton" value="<?php echo BFText::_('update') ?>" style="width:100%"/>
							<br/>
							<br/>
						</div>
					</li>
					
					<li>
						<a href='#'><div class="ui-accordion-left"></div><?php echo BFText::_('Misc') ?><div class="ui-accordion-right"></div></a>
						<div>
							<br/>
							<?php echo BFText::_('Pixel Raster') ?>
							<br/>
							<input type="text" id="bfPixelRaster" value="1" style="width:100%"/>
							<br/>
							<input type="submit" value="update" id="bfUpdatePixelRaster" style="width:100%"/>
							<br/>
							<br/>
							<br/>
						</div>
					</li>
					 
               	</ul>
               
               </div>
            </div>
            <div class="clear"></div>
            </div>
            <div class="b">
				<div class="b">
		 			<div class="b"></div>
				</div>
			</div>
			
			<br />
			        <div id="easymode-trashcan">
					
            <span class="icon-trashcan"><?php echo BFText::_('Trash can') ?></span>

			        <div id="trashcan-box">
        <div class="t">

				<div class="t">
					<div class="t"></div>
		 		</div>
	 		</div>
	 		<div class="m">
        	<ul id="trashcan">
	</ul>
	<div class="clr"></div>
			</div>
	
	<div class="b">
				<div class="b">
		 			<div class="b"></div>
				</div>
			</div>
			
			</div>
			</div><!-- easymode-trashcan end -->
    </div>

	<div id="form-area-easymode">
		
		<div id="bfTemplate"><?php if ($templateCode == ''): ?><ul class="droppableArea" id="drop1"></ul>
<?php endif;?><?php if ($templateCode != ''): ?>
<?php echo $templateCode; ?>
<?php endif;?></div> 
	</div> <!-- form-area-easymode -->
    <div class="clear"></div>
	</div>
	
	</form>
	
	

	
<?php
	}
}

?>
