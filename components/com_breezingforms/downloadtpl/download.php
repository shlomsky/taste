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
<?php echo BFText::_('Thanks for buying! Please download your file from the link below.'); ?>
<br/>
<br/>
<?php echo BFText::_('Your transaction id:')  ?> <?php echo $tx_token; ?>
<br/>
<?php echo BFText::_('Payment method: PayPal')  ?>
<br/>
<br/>
<a href="<?php echo JURI::root() ?>index.php?raw=true&option=com_breezingforms&amp;paypalDownload=true&amp;tx=<?php echo $tx_token ?>&amp;form=<?php echo $form_id ?>&amp;record_id=<?php echo $record_id ?>"><?php echo BFText::_('Download'); ?> (<?php echo BFText::_('Allowed tries:'); ?> <?php echo $tries ?>)</a>