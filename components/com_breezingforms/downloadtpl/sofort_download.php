<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>
<?php echo BFText::_('Thanks for buying! Please download your file from the link below once your payment is confirmed.'); ?>
<br/>
<br/>
<?php echo BFText::_('Your transaction id:')  ?> <?php echo $tx_token; ?>
<br/>
<?php echo BFText::_('Payment method: Sofortüberweisung')  ?>
<br/>
<br/>
<?php
if($confirmed){
?>
<a href="<?php echo JURI::root() ?>index.php?raw=true&option=com_breezingforms&amp;sofortueberweisungDownload=true&amp;tx=<?php echo $tx_token ?>&amp;form=<?php echo $formId ?>&amp;record_id=<?php echo $recordId ?>"><?php echo BFText::_('Download'); ?> (<?php echo BFText::_('Allowed tries:'); ?> <?php echo $tries ?>)</a>
<?php
} else {
?>
<?php echo BFText::_('Your payment needs confirmation, please wait until the download link appears...')  ?>
<script>
setTimeout("location.reload()",3000);
</script>
<?php
}
?>