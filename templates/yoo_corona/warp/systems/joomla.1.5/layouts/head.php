<?php
/**
* @package   Warp Theme Framework
* @file      head.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// load mootools
JHTML::_('behavior.mootools');

// get html head data
$head = $this->warp->system->document->getHeadData();

// jQuery loaded by FLEXIcontent ?
if (isset($head['scripts']['administrator/components/com_flexicontent/assets/js/jquery-1.4.min.js'])) {
	$this->warp->system->application->set('jquery', true);
}

// load jQuery first, if not loaded before
if (!$this->warp->system->application->get('jquery')) {
	$this->warp->system->application->set('jquery', true);
	$head['scripts'] = array_merge(array($this->warp->path->url('lib:jquery/jquery.js') => 'text/javascript'), $head['scripts']);
	$this->warp->system->document->setHeadData($head);
}

$style_urls  = array_keys($this->warp->stylesheets->get());
$script_urls = array_keys($this->warp->javascripts->get());

// get compressed styles and scripts
if ($compression = $this->warp->config->get('compression')) {
	$options = array();
	
	if ($compression >= 2) {
		$options['gzip'] = true;
	}

	if ($compression == 3) {
		$options['data_uri'] = true;
	}

	if ($urls = $this->warp->cache->processStylesheets($style_urls, $options)) {
		$style_urls = $urls;
	}

	if ($urls = $this->warp->cache->processJavascripts($script_urls, $options)) {
		$script_urls = $urls;
	}

	$head = $this->warp->system->document->getHeadData();

	if (count($head['styleSheets'])) {
		foreach ($head['styleSheets'] as $style => $meta) {
			if (preg_match('/\.css$/i', $style) && ($url = $this->warp->cache->processStylesheets(array($style), array_merge($options, array('data_uri' => false))))) {
				$style = array_shift($url);
			}

			$styles[$style] = $meta;
		}
		$head['styleSheets'] = $styles;
	}

	if (count($head['scripts'])) {
		foreach ($head['scripts'] as $script => $meta) {
			if (preg_match('/\.js$/i', $script) && ($url = $this->warp->cache->processJavascripts(array($script), $options))) {
				$script = array_shift($url);
			}

			$scripts[$script] = $meta;
		}
		$head['scripts'] = $scripts;
	}

	$this->warp->system->document->setHeadData($head);
}

// add styles
foreach ($style_urls as $style) {
	$this->warp->system->document->addStyleSheet($style);
}

// add scripts
foreach ($script_urls as $script) {
	$this->warp->system->document->addScript($script);
}

// add style declarations
foreach ($this->warp->stylesheets->getDeclarations() as $type => $style) {
	$this->warp->system->document->addStyleDeclaration($style, $type);
}

// add script declarations
foreach ($this->warp->javascripts->getDeclarations() as $type => $script) {
	$this->warp->system->document->addScriptDeclaration($script, $type);
} 

?>
<jdoc:include type="head" />
<?php $this->output('head'); ?>