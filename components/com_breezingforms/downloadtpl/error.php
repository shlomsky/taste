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
<?php echo BFText::_('An error occured, see the message below. If you think this is a mistake then contact the site administrator and provide him with your PayPal transaction id and the message below, please. Thank you!'); ?>
<br/>
<br/>
<?php echo BFText::_('Your transaction id:')  ?> <?php echo $tx_token; ?>
<br/>
<br/>
<?php echo BFText::_('Error:')  ?> <?php echo htmlentities($msg); ?>