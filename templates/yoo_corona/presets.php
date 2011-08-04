<?php
/**
* @package   yoo_corona Template
* @file      presets.php
* @version   5.5.0 March 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
 * Presets
 */

$default_preset = array();

$warp->config->addPreset('preset01', 'Blog', array_merge($default_preset,array(
	'style' => 'default',
	'background' => 'default',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset02', 'Adventure', array_merge($default_preset,array(
	'style' => 'orange',
	'background' => 'desert',
	'font' => 'lucida',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset03', 'Golf', array_merge($default_preset,array(
	'style' => 'orange',
	'background' => 'grass',
	'font' => 'trebuchet',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset04', 'Sports', array_merge($default_preset,array(
	'style' => 'green',
	'background' => 'stadium',
	'font' => 'lucida',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset05', 'News', array_merge($default_preset,array(
	'style' => 'red',
	'background' => 'worldmapblue',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset06', 'Business', array_merge($default_preset,array(
	'style' => 'turquoise',
	'background' => 'worldmapwhite',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset07', 'Residential', array_merge($default_preset,array(
	'style' => 'green',
	'background' => 'street',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset08', 'Magazine', array_merge($default_preset,array(
	'style' => 'pink',
	'background' => 'fabricdark',
	'font' => 'trebuchet',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset09', 'Gaming', array_merge($default_preset,array(
	'style' => 'blue',
	'background' => 'squares',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->addPreset('preset10', 'Music', array_merge($default_preset,array(
	'style' => 'pink',
	'background' => 'concert',
	'font' => 'default',
	'load_webfonts' => true
)));

$warp->config->applyPreset();