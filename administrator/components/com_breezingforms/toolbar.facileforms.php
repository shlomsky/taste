<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

global $ff_mospath, $ff_admpath, $ff_compath;
global $ff_mossite, $ff_admsite, $ff_admicon, $ff_comsite;
global $ff_config, $ff_compatible, $ff_install, $mainframe;

$locale = $mainframe->getCfg( 'language' );
$lang = JLanguage::getInstance( $locale );
$mosConfig_lang = $lang->getBackwardLang();

if (!isset($ff_compath)) { // mambo
	// ensure user has access to this function
	if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_breezingforms' ))) {
		mosRedirect( 'index2.php', _NOT_AUTH );
	} // if

	// get paths
	$comppath = '/components/com_breezingforms';
	$ff_admpath = dirname(__FILE__);
	$ff_mospath = str_replace('\\','/',dirname(dirname(dirname($ff_admpath))));
	$ff_admpath = str_replace('\\','/',$ff_admpath);
	$ff_compath = $ff_mospath.$comppath;
} // if

// load ff stuff and get config
require_once($ff_compath.'/facileforms.class.php');
require_once($ff_admpath.'/admin/config.class.php');
$ff_config = new facileFormsConfig();
initFacileForms();
$ff_admsite = $ff_mossite.'/administrator'.$comppath;
$ff_admicon = $ff_admsite.'/images/icons';

// load html file
require_once($ff_admpath.'/toolbar.facileforms.html.php');

// load admin language file
//if (file_exists($ff_admpath.'/languages/admin.'.$mosConfig_lang.'.php'))
//  require_once($ff_admpath.'/languages/admin.'.$mosConfig_lang.'.php');
//else
//  require_once($ff_admpath.'/languages/admin.english.php');

// TODO: Crosstec > J1.5 Compat Check
$ff_compatible = true;
//$ff_compatible = file_exists($ff_mospath.'/includes/version.php');
if ($ff_compatible) {
	// check for post installation tasks
	if ($act != 'installation')
		$ff_install = !file_exists($ff_compath.'/facileforms.config.php');

	if (!$ff_install)
		switch ($act) {
			case 'managerecs':
			case 'mngrecs':
				//if ($task == '' || $task == 'expxml')
				//	menuFacileForms::MANAGERECS_MENU();
				break;

			case 'managemenus':
				//if ($task == '')
				//	menuFacileForms::MANAGEMENU_MENU();
				break;

			case 'manageforms':
				if ($task == '')
					;//menuFacileForms::MANAGEFORM_MENU();
				else
					//if (substr($task,0,8)=="editpage")
					;//	menuFacileForms::EDITPAGE_MENU();
				break;

			case 'editpage':
				//if ($task == '')
				//	menuFacileForms::EDITPAGE_MENU();
				break;

			case 'managescripts':
				//if ($task == '')
				//	menuFacileForms::MANAGESCRIPTS_MENU();
				break;

			case 'managepieces':
				//if ($task == '')
				//	menuFacileForms::MANAGEPIECES_MENU();
				break;

			case 'configuration':
				if ($task == 'instpackage')
					menuFacileForms::INSTPACKAGE_MENU();
				break;

			case 'installation':
			case 'run':
				break;

			default:
				//menuFacileForms::MANAGERECS_MENU();
				break;
		} // switch
} // if
?>