<?php
/**
* @package   yoo_corona Template
* @file      module.php
* @version   5.5.0 March 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// init vars
$id        = $module->id;
$position  = $module->position;
$title     = $module->title;
$showtitle = $module->showtitle;
$content   = $module->content;

// init params
$first = $params['first'] ? 'first' : null;
$last  = $params['last'] ? 'last' : null;
foreach (array('suffix', 'style', 'badge', 'color', 'icon', 'yootools', 'header', 'dropdownwidth') as $var) {
	$$var = isset($params[$var]) ? $params[$var] : null;
}

// create title
$pos = mb_strpos($title, ' ');
if ($pos !== false) {
	$title = '<span class="color">'.mb_substr($title, 0, $pos).'</span>'.mb_substr($title, $pos);
}

// create subtitle
$pos = mb_strpos($title, '||');
if ($pos !== false) {
	$title = '<span class="title">'.mb_substr($title, 0, $pos).'</span><span class="subtitle">'.mb_substr($title, $pos + 2).'</span>';
}

// legacy compatibility
if ($suffix == 'blank' || $suffix == '-blank') $style = 'blank';
if ($suffix == 'menu' || $suffix == '_menu') $style = 'menu';

// set default module types
if ($style == '') {
	if ($module->position == 'headerbar') $style = 'blank';
	if ($module->position == 'topblock') $style = 'box';
	if ($module->position == 'top') $style = 'box';
	if ($module->position == 'left') $style = 'line';
	if ($module->position == 'right') $style = 'line';
	if ($module->position == 'maintop') $style = 'line';
	if ($module->position == 'contenttop') $style = 'line';
	if ($module->position == 'contentleft') $style = 'line';
	if ($module->position == 'contentright') $style = 'line';
	if ($module->position == 'contentbottom') $style = 'line';
	if ($module->position == 'mainbottom') $style = 'line';
	if ($module->position == 'bottom') $style = 'line';
	if ($module->position == 'bottomblock') $style = 'line';
}

// to test a module set the style, color, badge and icon here
//$style = '';
//$color = '';
//$badge = '';
//$icon = '';
//$header = '';

// force module style
if (in_array($module->position,array('absolute' ,'breadcrumbs','logo','banner','search','footer','debug'))) $style = 'raw';
if ($module->position == 'toolbarleft' || $module->position == 'toolbarright')  $style = 'blank';
if ($module->position == 'bottom' || $module->position == 'bottomblock')  $style = 'line';
if ($module->position == 'menu') {
	$style = ($style == 'menu') ? 'raw' : 'dropdown';
}

// set badge if exists
if ($badge) {
	$badge = '<div class="badge badge-'.$badge.'"></div>';
}

// set icon if exists
if ($icon) {
	$title = '<span class="icon icon-'.$icon.'"></span>'.$title.'';
}

// set yootools color if exists
if ($yootools == 'black') {
	$yootools = 'yootools-black';
}

// set dropdownwidth if exists
if ($dropdownwidth) {
	$dropdownwidth = 'style="width: '.$dropdownwidth.'px;"';
}

// set module template using the style
switch ($style) {

	case 'box':
		$template  = '0-2-0';
		$style     = 'mod-'.$style;
		$color     = ($color) ? $style.'-'.$color : '';
		break;
		
	case 'line':
		$template  = '0-1-0';
		$style     = 'mod-'.$style;
		$color     .= ($header) ? ' mod-line-header-'.$header : '';
		break;

	case 'menu':
		$template  = '0-1-0';
		$style     = 'mod-line mod-menu mod-menu-line';
		break;
		
	case 'polaroid':
		$template  = '0-3-3_polaroid';
		$style     = 'mod-'.$style;
		$badge	  .= '<div class="badge-tape"></div>';
		break;
		
	case 'postit':
		$template  = '0-2-3';
		$style     = 'mod-'.$style;
		break;
		
	case 'dropdown':
		$template  = 'dropdown';
		$style     = 'mod-'.$style;
		break;

	case 'blank':
		$template  = 'default';
		$style     = 'mod-'.$style;
		break;

	case 'raw':
		$template  = 'raw';
		break;

	default:
		$template  = 'default';
		$style     = $suffix;
}

// render menu template
if ($params['menu']) {
	$content = $this->warp->menu->process($module,array('pre','default',$params['menu'],'post'));
}

// render module template
echo $this->render("modules/{$template}", compact('style', 'color', 'yootools', 'first', 'last', 'badge', 'showtitle', 'title', 'content', 'dropdownwidth'));