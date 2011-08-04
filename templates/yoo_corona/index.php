<?php
/**
* @package   yoo_corona Template
* @file      index.php
* @version   5.5.0 March 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// include config	
include_once(dirname(__FILE__).'/config.php');

// get warp
$warp =& Warp::getInstance();

// load main template file, located in /layouts/template.php
echo $warp->template->render('template');