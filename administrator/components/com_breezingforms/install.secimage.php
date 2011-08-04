<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

if(!version_compare(PHP_VERSION, '5.1.2', '>=')){
 
	echo '<b style="color:red">WARNING: YOU ARE RUNNING PHP VERSION "'.PHP_VERSION.'". BREEZINGFORMS WON\'T WORK WITH THIS VERSION. PLEASE UPGRADE TO AT LEAST PHP 5.1.2, SORRY BUT YOU BETTER UNINSTALL THIS COMPONENT NOW!</b>';
}

if (file_exists(JPATH_SITE . "/administrator/components/com_joomfish/contentelements"))
{
	@JFile::copy( JPATH_SITE . "/administrator/components/com_breezingforms/joomfish/facileforms_elements.xml",JPATH_SITE . "/administrator/components/com_joomfish/contentelements/facileforms_elements.xml");
	@JFile::copy( JPATH_SITE . "/administrator/components/com_breezingforms/joomfish/translationFformFilter.php", JPATH_SITE . "/administrator/components/com_joomfish/contentelements/translationFformFilter.php");
	@JFile::copy( JPATH_SITE . "/administrator/components/com_breezingforms/joomfish/translationFformoptions_emptyFilter.php", JPATH_SITE . "/administrator/components/com_joomfish/contentelements/translationFformoptions_emptyFilter.php");
}
?>