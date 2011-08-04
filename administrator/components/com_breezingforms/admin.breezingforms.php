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

require_once(JPATH_SITE . '/administrator/components/com_breezingforms/libraries/crosstec/classes/BFText.php');
require_once(JPATH_SITE . '/administrator/components/com_breezingforms/libraries/crosstec/classes/BFTableElements.php');
require_once(JPATH_SITE . '/administrator/components/com_breezingforms/libraries/crosstec/functions/helpers.php');
require_once(JPATH_SITE . '/administrator/components/com_breezingforms/libraries/crosstec/constants.php');

/**
 * Crosstec: Temporary section to make things work, should be placed somewhere else... 
 */

// Original FacileForms didn't care about that, but now we do
$_POST    = bf_stripslashes_deep($_POST);
$_GET     = bf_stripslashes_deep($_GET);
$_REQUEST = bf_stripslashes_deep($_REQUEST);

// check if legacy is enabled or not...
$db = JFactory::getDBO();
$db->setQuery("Select id From #__plugins Where element = 'legacy' And published = 0");
$legacyResult = $db->loadObjectList();

// ...if its NOT enabled, load the self-containing legacy classes
if(count($legacyResult) == 1){
	
	// this include MUST stay inside the legacy check
	require_once( JPATH_SITE . '/administrator/components/com_breezingforms/classloader.php' );
	
	function include_all_once ($pattern) {
	    foreach (glob($pattern) as $file) {
	    	
	    	if(!preg_match("/mysqli\.php$/",$file) && !preg_match("/mysql\.php$/",$file))
	        	require_once $file;
	    }
	}
	
	include_all_once( JPATH_SITE . '/administrator/components/com_breezingforms/legacyclasses/*.php' );
}

/*
 * Temporary section end
 */

global $errors, $errmode;
global $ff_mospath, $ff_admpath, $ff_compath, $ff_request;
global $ff_mossite, $ff_admsite, $ff_admicon, $ff_comsite;
global $ff_config, $ff_compatible, $ff_install;

$my = JFactory::getUser();

if (!isset($ff_compath)) { // joomla!
	
	// TODO: add recommended way to set permissions
	if ($my->usertype != 'Super Administrator' && $my->usertype != 'Administrator') {
		mosRedirect( 'index2.php', _NOT_AUTH );
	} // if

	// get paths
	$comppath = '/components/com_breezingforms';
	$ff_admpath = dirname(__FILE__);
	$ff_mospath = str_replace('\\','/',dirname(dirname(dirname($ff_admpath))));
	$ff_admpath = str_replace('\\','/',$ff_admpath);
	$ff_compath = $ff_mospath.$comppath;

	if(count($legacyResult) == 0){
		require_once($ff_admpath.'/legacyclasses/menubar.php');
	}
	require_once($ff_admpath.'/toolbar.facileforms.php');
} // if

$errors = array();
$errmode = 'die';   // die or log

// compatibility check
if (!$ff_compatible) {
	echo '<h1>'.BFText::_('INCOMPATIBLE').'</h1>';
	exit;
} // if

// load ff parameters
$ff_request = array();
reset($_REQUEST);
while (list($prop, $val) = each($_REQUEST))
	if (is_scalar($val) && substr($prop,0,9)=='ff_param_')
		$ff_request[$prop] = $val;

if ($ff_install) {
	$act = 'installation';
	$task = 'step2';
} // if

$ids = JRequest::getVar( 'ids', array());

switch($act) {
	case 'installation':
		require_once($ff_admpath.'/admin/install.php');
		break;
	case 'configuration':
		require_once($ff_admpath.'/admin/config.php');
		break;
	case 'managemenus':
		require_once($ff_admpath.'/admin/menu.php');
		break;
	case 'manageforms':
		require_once($ff_admpath.'/admin/form.php');
		break;
	case 'editpage':
		require_once($ff_admpath.'/admin/element.php');
		break;
	case 'managescripts':
		require_once($ff_admpath.'/admin/script.php');
		break;
	case 'managepieces':
		require_once($ff_admpath.'/admin/piece.php');
		break;
	case 'run':
		require_once($ff_admpath.'/admin/run.php');
		break;
	case 'easymode':
		require_once($ff_admpath.'/admin/easymode.php');
		break;
	case 'quickmode':
		require_once($ff_admpath.'/admin/quickmode.php');
		break;
	case 'quickmode_editor':
		require_once($ff_admpath.'/admin/quickmode-editor.php');
		break;
	case 'integrate':
		require_once($ff_admpath.'/admin/integrator.php');
		break;
	case 'recordmanagement':
		require_once($ff_admpath.'/admin/recordmanagement.php');
		break;
	default:
		require_once($ff_admpath.'/admin/recordmanagement.php');
		break;
} // switch

// some general purpose functions for admin

function isInputElement($type)
{
	switch ($type) {
		case 'Static Text/HTML':
		case 'Rectangle':
		case 'Image':
		case 'Tooltip':
		case 'Query List':
		case 'Regular Button':
		case 'Graphic Button':
		case 'Icon':
			return false;
		default:
			break;
	} // switch
	return true;
} // isInputElement

function isVisibleElement($type)
{
	switch ($type) {
		case 'Hidden Input':
			return false;
		default:
			break;
	} // switch
	return true;
} // isVisibleElement

function _ff_query($sql, $insert = 0)
{
	global $database, $errors;
	$database = JFactory::getDBO();
	$id = null;
	$database->setQuery($sql);
	$database->query();
	if ($database->getErrorNum()) {
		if ($errmode=='log')
			$errors[] = $database->getErrorMsg();
		else
			die($database->stderr());
	} // if
	if ($insert) $id = $database->insertid();
	return $id;
} // _ff_query

function _ff_select($sql)
{
	global $database, $errors;
	$database = JFactory::getDBO();
	$database->setQuery($sql);
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		if ($errmode=='log')
			$errors[] = $database->getErrorMsg();
		else
			die($database->stderr());
	} // if
	
	return $rows;
} // _ff_select

function _ff_selectValue($sql)
{
	global $database, $errors;
	$database = JFactory::getDBO();
	$database->setQuery($sql);
	$value = $database->loadResult();
	if ($database->getErrorNum()) {
		if ($errmode=='log')
			$errors[] = $database->getErrorMsg();
		else
			die($database->stderr());
	} // if
	return $value;
} // _ff_selectValue

function protectedComponentIds()
{
	$rows = _ff_select(
		"select id, parent from #__components ".
		"where `option`='com_breezingforms' ".
		"and admin_menu_link in (".
			"'option=com_breezingforms&act=managerecs',".
			"'option=com_breezingforms&act=managemenus',".
			"'option=com_breezingforms&act=manageforms',".
			"'option=com_breezingforms&act=managescripts',".
			"'option=com_breezingforms&act=managepieces',".
			"'option=com_breezingforms&act=share',".
			"'option=com_breezingforms&act=integrate',".
			"'option=com_breezingforms&act=configuration'".
		") ".
		"order by id"
	);
	$parent = 0;
	$ids = array();
	if (count($rows)) foreach ($rows as $row) {
		if ($parent==0) {
			$parent = 1;
			$ids[] = $row->parent;
		} // if
		$ids[] = $row->id;
	} // foreach
	return implode($ids,',');
} // protectedComponentIds

function addComponentMenu($row, $parent)
{
	$db = JFactory::getDBO();
	$admin_menu_link = '';
	if ($row->name!='') {
		$admin_menu_link =
			'option=com_breezingforms'.
			'&act=run'.
			'&ff_name='.$row->name;
		if ($row->page!=1) $admin_menu_link .= '&ff_page='.$row->page;
		if ($row->frame==1) $admin_menu_link .= '&ff_frame=1';
		if ($row->border==1) $admin_menu_link .= '&ff_border=1';
		if ($row->params!='') $admin_menu_link .= $row->params;
	} // if
	if ($parent==0) $ordering = 0; else $ordering = $row->ordering;
	return _ff_query(
		"insert into #__components (".
			"id, name, link, menuid, parent, ".
			"admin_menu_link, admin_menu_alt, `option`, ".
			"ordering, admin_menu_img, iscore, params".
		") ".
		"values (".
			"'', ".$db->Quote($row->title).", '', 0, $parent, ".
			"'$admin_menu_link', ".$db->Quote($row->title).", 'com_breezingforms', ".
			"'$ordering', '$row->img', 1, ''".
		")",
		true
	);
} // addComponentMenu

function updateComponentMenus()
{
	// remove unprotected menu items
	$protids = protectedComponentIds();
	if(trim($protids)!=''){
		_ff_query(
			"delete from #__components ".
			"where `option`='com_breezingforms' ".
			"and id not in ($protids)"
		);
	} 
	
	// add published menu items
	$rows = _ff_select(
		"select ".
			"m.id as id, ".
			"m.parent as parent, ".
			"m.ordering as ordering, ".
			"m.title as title, ".
			"m.img as img, ".
			"m.name as name, ".
			"m.page as page, ".
			"m.frame as frame, ".
			"m.border as border, ".
			"m.params as params, ".
			"m.published as published ".
		"from #__facileforms_compmenus as m ".
			"left join #__facileforms_compmenus as p on m.parent=p.id ".
		"where m.published=1 ".
			"and (m.parent=0 or p.published=1) ".
		"order by ".
			"if(m.parent,p.ordering,m.ordering), ".
			"if(m.parent,m.ordering,-1)"
	);
	$parent = 0;
	if (count($rows)) foreach ($rows as $row) {
		if ($row->parent==0)
			$parent = addComponentMenu($row, 0);
		else
			addComponentMenu($row, $parent);
	} // foreach
} // updateComponentMenus

function dropPackage($id)
{
	// drop package settings
	_ff_query("delete from #__facileforms_packages where id = '$id'");

	// drop backend menus
	$rows = _ff_select("select id from #__facileforms_compmenus where package = '$id'");
	if (count($rows)) foreach ($rows as $row)
		_ff_query("delete from #__facileforms_compmenus where id=$row->id or parent=$row->id");
	updateComponentMenus();

	// drop forms
	$rows = _ff_select("select id from #__facileforms_forms where package = '$id'");
	if (count($rows)) foreach ($rows as $row) {
		_ff_query("delete from #__facileforms_elements where form = $row->id");
		_ff_query("delete from #__facileforms_forms where id = $row->id");
	} // if

	// drop scripts
	_ff_query("delete from #__facileforms_scripts where package =  '$id'");

	// drop pieces
	_ff_query("delete from #__facileforms_pieces where package =  '$id'");
} // dropPackage

function savePackage($id, $name, $title, $version, $created, $author, $email, $url, $description, $copyright)
{
	$db = JFactory::getDBO();
	$cnt = _ff_selectValue("select count(*) from #__facileforms_packages where id='$id'");
	if (!$cnt) {
		
		_ff_query(
			"insert into #__facileforms_packages ".
					"(id, name, title, version, created, author, ".
					 "email, url, description, copyright) ".
			"values (".$db->Quote($id).", ".$db->Quote($name).", ".$db->Quote($title).", ".$db->Quote($version).", ".$db->Quote($created).", ".$db->Quote($author).",
					".$db->Quote($email).", ".$db->Quote($url).", ".$db->Quote($description).", ".$db->Quote($copyright).")"
		);
	} else {
		_ff_query(
			"update #__facileforms_packages ".
				"set name=".$db->Quote($name).", title=".$db->Quote($title).", version=".$db->Quote($version).", created=".$db->Quote($created).", author=".$db->Quote($author).", ".
				"email=".$db->Quote($email).", url=".$db->Quote($url).", description=".$db->Quote($description).", copyright=".$db->Quote($copyright). " 
			where id =  ".$db->Quote($id)
		);
	} // if
} // savePackage

function relinkScripts(&$oldscripts)
{
	if (count($oldscripts))
		foreach ($oldscripts as $row) {
			$newid = _ff_selectValue("select max(id) from #__facileforms_scripts where name = '".$row->name."'");
			if ($newid) {
				_ff_query("update #__facileforms_forms set script1id=$newid where script1id=$row->id");
				_ff_query("update #__facileforms_forms set script2id=$newid where script2id=$row->id");
				_ff_query("update #__facileforms_elements set script1id=$newid where script1id=$row->id");
				_ff_query("update #__facileforms_elements set script2id=$newid where script2id=$row->id");
				_ff_query("update #__facileforms_elements set script3id=$newid where script3id=$row->id");
			} // if
		} // foreach
} // relinkScripts

function relinkPieces(&$oldpieces)
{
	if (count($oldpieces))
		foreach ($oldpieces as $row) {
			$newid = _ff_selectValue("select max(id) from #__facileforms_pieces where name = '".$row->name."'");
			if ($newid) {
				_ff_query("update #__facileforms_forms set piece1id=$newid where piece1id=$row->id");
				_ff_query("update #__facileforms_forms set piece2id=$newid where piece2id=$row->id");
				_ff_query("update #__facileforms_forms set piece3id=$newid where piece3id=$row->id");
				_ff_query("update #__facileforms_forms set piece4id=$newid where piece4id=$row->id");
			} // if
		} // foreach
} // relinkPieces
?>