<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

require_once($ff_admpath.'/admin/script.html.php');

class facileFormsScript
{
	function edit($option, $pkg, $ids)
	{
		$database = JFactory::getDBO();
		$typelist = array();
		$typelist[] = array('Untyped',BFText::_('SCRIPTS_UNTYPED'));
		$typelist[] = array('Element Init',BFText::_('SCRIPTS_ELEMENTINIT'));
		$typelist[] = array('Element Action',BFText::_('SCRIPTS_ELEMENTACTION'));
		$typelist[] = array('Element Validation',BFText::_('SCRIPTS_ELEMENTVALID'));
		$typelist[] = array('Form Init',BFText::_('SCRIPTS_FORMINIT'));
		$typelist[] = array('Form Submitted',BFText::_('SCRIPTS_FORMSUBMIT'));
		$row = new facileFormsScripts($database);
		if (count($ids)){
			$row->load($ids[0]);
		} else {
			$row->type = $typelist[0];
			$row->package = $pkg;
			$row->published = 1;
		} // if
		HTML_facileFormsScript::edit($option, $pkg, $row, $typelist);
	} // edit

	function save($option, $pkg)
	{
		$database = JFactory::getDBO();
		$row = new facileFormsScripts($database);
		// bind it to the table
		if (!$row->bind($_POST)) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		} // if
		// store it in the db
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		} // if
		mosRedirect(
			"index2.php?option=$option&act=managescripts&pkg=$pkg",
			BFText::_('SCRIPTS_SAVED'));
	} // save

	function cancel($option, $pkg)
	{
		mosRedirect("index2.php?option=$option&act=managescripts&pkg=$pkg");
	} // cancel

	function copy($option, $pkg, $ids)
	{
		$database = JFactory::getDBO();
		$total = count($ids);
		$row = new facileFormsScripts($database);
		if (count($ids)) foreach ($ids as $id) {
			$row->load(intval($id));
			$row->id       = NULL;
			$row->store();
		} // foreach
		$msg = $total.' '.BFText::_('SCRIPTS_SUCCOPIED');
		mosRedirect("index2.php?option=$option&act=managescripts&pkg=$pkg&mosmsg=$msg");
	} // copy

	function del($option, $pkg, $ids)
	{
		$database = JFactory::getDBO();
		if (count($ids)) {
			$ids = implode(',', $ids);
			$database->setQuery("delete from #__facileforms_scripts where id in ($ids)");
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			} // if
		} // if
		mosRedirect("index2.php?option=$option&act=managescripts&pkg=$pkg");
	} // del

	function publish($option, $pkg, $ids, $publish)
	{
		global $database, $my;
		$database = JFactory::getDBO();
		$ids = implode( ',', $ids );
		$database->setQuery(
			"update #__facileforms_scripts set published='$publish' where id in ($ids)"
		);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		} // if
		mosRedirect( "index2.php?option=$option&act=managescripts&pkg=$pkg" );
	} // publish

	function listitems($option, $pkg)
	{
		$database = JFactory::getDBO();

		$database->setQuery(
			"select distinct  package as name ".
			"from #__facileforms_scripts ".
			"where package is not null and package!='' ".
			"order by name"
		);
		$pkgs = $database->loadObjectList();
		if ($database->getErrorNum()) { echo $database->stderr(); return false; }
		$pkgok = $pkg=='';
		if (!$pkgok && count($pkgs)) foreach ($pkgs as $p) if ($p->name==$pkg) { $pkgok = true; break; }
		if (!$pkgok) $pkg = '';
		$pkglist = array();
		$pkglist[] = array($pkg=='', '');
		if (count($pkgs)) foreach ($pkgs as $p) $pkglist[] = array($p->name==$pkg, $p->name);

		$database->setQuery(
			"select * from #__facileforms_scripts ".
			"where package =  '".mysql_escape_string($pkg)."' ".
			"order by type, name, id desc"
		);
		$rows = $database->loadObjectList();
		if ($database->getErrorNum()) { echo $database->stderr(); return false; }
		HTML_facileFormsScript::listitems($option, $rows, $pkglist);
	} // listitems

} // class facileFormsScript
?>