<?php
/**
* @package   Warp Theme Framework
* @file      preset.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

class JElementPreset extends JElement {

	var	$_name = 'Preset';

	function fetchElement($name, $value, &$node, $control_name) {
		
		// load config
		require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
		
		// get warp
		$warp =& Warp::getInstance();

		// get presets
		$presets = $warp->config->get('_presets', array());
		
		ob_start();		
		?>
		
			<select id="selectPreset" style="width:200px;">
				<option value="-1">Please choose a preset...</option>
				<?php foreach($presets as $key => $preset): ?>
					<option value="<?php echo $key;?>"><?php echo $preset['name'];?></option>
				<?php endforeach; ?>
			</select>
			
			<script type="text/javascript">
			
				window.addEvent('domready', function(){
				   document.getElement("#selectPreset").addEvent("change", function(){
						
						var warp_presets = <?php echo json_encode($presets);?>;
						var select 		 = this;
						
						if (select.value == -1) return;

						var preset = warp_presets[select.value];
						var elements = document.getElement("form[name=adminForm]").getElements('[name^=params]');
						
						for(var i=0;i<elements.length;i++){
							var node = elements[i];
							var $name = node.name.replace("params[",'').replace("]",'');

							if(preset.options[$name] || preset.options[$name]===0){
								if(node.type=='radio') {
									if(node.value==preset.options[$name]) node.setProperty('checked',true);
								} else {
									node.value = preset.options[$name];
								}
							}

						}

						//select.selectedIndex = 0;
					});
				});
       
			</script>
		
		<?php
		return ob_get_clean();
	}

}