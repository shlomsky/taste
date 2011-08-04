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
<?php echo BFText::_('Thanks for buying! You will soon receive an email with further informationon on your order!'); ?>
<br/>
<br/>
<?php echo BFText::_('Your transaction id:')  ?> <?php echo $tx_token; ?>