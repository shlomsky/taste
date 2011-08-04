<?php
/*
 * ARI Sexy Lightbox Lite Joomla! 1.5 plugin
 *
 * @package		ARI Sexy Lightbox Lite 
 * @version		1.0.0
 * @author		ARI Soft
 * @copyright	Copyright (c) 2009 www.ari-soft.com. All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
 * 
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.filter.filterinput');

require_once dirname(__FILE__) . DS . 'arisexylightboxlite' . DS . 'kernel' . DS . 'class.AriKernel.php';

AriKernel::import('Web.JSON.JSONHelper');

class plgContentArisexylightboxlite extends JPlugin
{
	/*
	 * Constructor
	 */
	function plgContentArisexylightboxlite(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	function onPrepareContent(&$article, &$params, $limitstart)
	{
		static $loaded;
		
		if ($loaded)
			return ;
		
		global $mainframe;

		$plgParams = $this->params;
		$rel = $plgParams->get('opt_find', 'sexylightbox');
		$loadAssets = $plgParams->get('loadAssets', 'auto');
		if ($loadAssets == 'auto' && !preg_match('/<[^>]*rel=("|\')?' . $rel . '(\[|"|\'| |\/)/i', $article->text))
			return ;

		$document =& JFactory::getDocument();
		$baseUri = JURI::root(true) . '/plugins/content/arisexylightboxlite/js/';
		$loadJQuery = !!$plgParams->get('includeJQuery', false);
		if ($loadJQuery)
		{
			$document->addScript($baseUri . 'jquery.min.js');

			$noConflict = !!$plgParams->get('noConflict', true);
			if ($noConflict)
				$document->addScript($baseUri . 'jquery.noconflict.js');				
		}

		$document->addScript($baseUri . 'jquery.easing.js');
		$document->addScript($baseUri . 'jquery.sexylightbox.min.js');
		
		$document->addStyleSheet($baseUri . 'sexylightbox.css');

		$jsOptions = $this->getOptions();
		$document->addScriptDeclaration(
			sprintf('jQuery(document).ready(function(){ SexyLightbox.initialize(%s); });',
				$jsOptions ? AriJSONHelper::encode($jsOptions) : ''));
				
		$loaded = true;
	}

	function getOptions()
	{
		$defOptions = array(
			'find' => 'sexylightbox',
			'zIndex' => 32000,
			'color' => 'black',
			'emergefrom' => 'top',
			'showDuration' => 200,
			'closeDuration' => 400,
			'moveDuration' => 1000,
			'moveEffect' => 'easeInOutBack',
			'resizeDuration' => 1000,
			'resizeEffect' => 'easeInOutBack',
			'shake' => array(
				'distance' => 10,
                'duration' => 100,
                'loops' => 2,
                'transition' => 'easeInOutBack'
			)
		);
		$options = $this->getParamOptions($defOptions);
		
		$options['dir'] = JURI::root(true) . '/plugins/content/arisexylightboxlite/js/sexyimages';

		return $options;
	}
	
	function getParamOptions($defOptions, $prefix = 'opt_')
	{
		$plgParams = $this->params;
		$options = array();
		foreach ($defOptions as $key => $value)
		{
			if (is_array($value))
			{
				$subOptions = $this->getParamOptions($value, $prefix . $key . '_');
				if (count($subOptions) > 0)
					$options[$key] = $subOptions;
			}
			else
			{
				$paramValue = $plgParams->get($prefix . $key, $value);
				if ($paramValue !== $value)
				{
					$paramValue = JFilterInput::clean($paramValue, gettype($value));
					if ($paramValue !== $value)
						$options[$key] = $paramValue;
				}
			}
		}
		
		return $options;
	}
}
?>