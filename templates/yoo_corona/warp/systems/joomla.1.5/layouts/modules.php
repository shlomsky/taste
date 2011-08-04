<?php
/**
* @package   Warp Theme Framework
* @file      modules.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// load modules
$modules = $this->warp->modules->load($position);
$count   = count($modules);

foreach($modules as $index => $module){

	// set module params
	$params           = array();
	$params['count']  = $count;
	$params['order']  = $index + 1;
	$params['first']  = $params['order'] == 1;
	$params['last']   = $params['order'] == $count;
	$params['suffix'] = $module->parameter->get('moduleclass_sfx', '');
	$params['menu']   = false;

	if ($module->module == 'mod_mainmenu') {

		$params['menu'] = 'default';

		if (isset($menu)) {
			$params['menu'] = $menu;
		} elseif (mb_strpos($module->parameter->get('class_sfx', ''), 'dropdown') !== false) {
			$params['menu'] = 'dropdown';
		} elseif (mb_strpos($module->parameter->get('class_sfx', ''), 'accordion') !== false) {
			$params['menu'] = 'accordion';
		}
	}

	// get class suffix params
	$parts = preg_split('/[\s]+/', $params['suffix']);

	foreach ($parts as $part) {
		if (strpos($part, '-') !== false) {
			list($name, $value) = explode('-', $part, 2);
			$params[$name] = $value;
		}
	}

	// render module
	$output = $this->render('module', compact('module', 'params'));

	// wrap module
	if (isset($wrapper) && $wrapper) {
		$layout = isset($layout) ? $layout : 'default';
		$output = $this->render('wrapper', compact('output', 'wrapper', 'layout', 'params'));
	}

	echo $output;
}