<?php
/**
* @package   Warp Theme Framework
* @file      pre.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

jimport('joomla.filesystem.file');

/*
	Class: WarpMenuPre
		Menu base class
*/
class WarpMenuPre extends WarpMenu {
	
	/*
		Function: process

		Returns:
			Xml Object
	*/	
	function process(&$module, &$xmlobj) {
		
		$ul = $xmlobj->document->getElement("ul");
		
		if ($ul) {
			$this->_process($module, $ul);
			return $ul;
		} else {
			return false;
		}
	}
	
	function _process(&$module, &$xmlobj, $level=0) {
		
        $lis    = $xmlobj->children("li");
        $menu   = &JSite::getMenu();
		$images = strpos($module->parameter->get('class_sfx'), "images-off") === false;        
        $parent = null;
        
        for($i=0,$imax=count($lis);$i<$imax;$i++){
            
            foreach( explode(' ', $lis[$i]->_attributes['class']) as $cls){
                if(strpos($cls,"item") !== false) $id = str_replace("item", "", $cls);
            }
            
			$isActive = 0;
			
            if ($lis[$i]->hasClass('active')) {
				$isActive = ((isset($lis[$i]->_attributes['id']) && $lis[$i]->_attributes['id']==='current')) ? 2 : 1;
			}
			
            $lis[$i]->_attributes = array();
            
            $item        = $menu->getItem($id);
            $item_params = new JParameter($item->params);
            
            // get class suffix params
            
            $page_params = array();
            $parts       = preg_split('/[\s]+/', $item_params->get('pageclass_sfx'));
            
            foreach ($parts as $part) {
                if (strpos($part, '-') !== false) {
                  list($name, $value) = explode('-', $part, 2);
                  $page_params[$name] = $value;
                }
            }
                            
            $columns     = isset($page_params['columns']) ? (int) $page_params['columns'] : 1;
            $columnwidth = isset($page_params['columnwidth']) ? (int) $page_params['columnwidth'] : -1;
              
            $lis[$i]->addAttribute('data-menu-active', (int) $isActive);
            $lis[$i]->addAttribute('data-menu-columns', $columns);
            $lis[$i]->addAttribute('data-menu-columnwidth', $columnwidth);
            
            // add item background image            
            if ($item_params->get('menu_image') && $item_params->get('menu_image') != -1) {
              if (isset($lis[$i]->_children[0])) {
                
                if ($lis[$i]->_children[0]->_children[0]->name()=='img') {
					$lis[$i]->_children[0]->_children[0]->dispose();
				}  
                
                if ($images && $lis[$i]->_children[0]->_children[0]->name()=='span') {
					$img = 'images/stories/'.$item_params->get('menu_image');
				  
					if (mb_strpos($module->parameter->get('class_sfx', ''), 'dropdown') === false) {
						
						$alt = dirname($img).'/'.JFile::stripExt(basename($img)).'_alt.'.JFile::getExt($img);

						// check for alternate image
						if (JFile::exists(JPATH_ROOT.DS.$alt)) {
							$img = $alt;
						}
					}

					$lis[$i]->_children[0]->_children[0]->addAttribute('data-menu-image', JURI::base().$img);
                }
              }
            }
		    
            $childList =& $lis[$i]->child("ul");
            
            if($childList){
              $this->_process($module, $childList,($level+1));                   
            }       
        }
	}

}