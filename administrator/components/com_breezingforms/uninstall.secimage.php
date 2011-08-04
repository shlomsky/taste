<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

jimport('joomla.filesystem.file');

@JFile::delete( JPATH_SITE . '/ff_secimage.php');
@JFile::delete( JPATH_SITE . '/templates/system/ff_secimage.php');
@JFile::delete( JPATH_SITE . "/administrator/components/com_joomfish/contentelements/facileforms_elements.xml");
@JFile::delete( JPATH_SITE . "/administrator/components/com_joomfish/contentelements/translationFformFilter.php");
@JFile::delete( JPATH_SITE . "/administrator/components/com_joomfish/contentelements/translationFformoptions_emptyFilter.php");
?>