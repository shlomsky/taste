<?php
/**
* @package   Warp Theme Framework
* @file      verify.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

class JElementVerify extends JElement {

	var	$_name = 'Verify';

	function fetchElement($name, $value, &$node, $control_name) {
		
		// load config
		require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
		
		// get warp and helpers
		$warp  =& Warp::getInstance();
		$path  =& $warp->getHelper('path');
        $check =& $warp->getHelper('checksum');

		// verify theme files
		$content = array();

		if (($checksums = $path->path('template:checksums')) && filesize($checksums)) {
			$check->verify($path->path('template:'), $log);

			if (count($log)) {
			
				$content[] = 'Some template files have been modified. <a href="#" class="verify-link">Click to show files.</a>';
				$content[] = '<ul class="verify">';
				foreach (array('modified', 'missing') as $type) {
					if (isset($log[$type])) {
						foreach ($log[$type] as $file) {
							$content[] = '<li class="'.$type.'">'.$file.($type == 'missing' ? ' (missing)' : null).'</li>';
						}
					}
				}
				$content[] = '</ul>';

			} else {
				$content[] = 'Verification successful, no file modifications detected.';
			}
		} else {
			$content[] = 'Checksum file is missing! Your template is maybe compromised.';
		}

		ob_start();		
		?>
			
		<script type="text/javascript">
		
			window.addEvent('domready', function(){
				var ul = document.getElement("ul.verify");

				if (ul) {
					ul.setStyle('display', 'none');
				   	document.getElement("a.verify-link").addEvent("click", function(event){
						var event = new Event(event).stop();
						ul.setStyle('display', ul.getStyle('display') == 'none' ? 'block' : 'none');
					});
				}
			});
      
		</script>
		
		<?php
		return implode("\n", $content).ob_get_clean();
	}

}