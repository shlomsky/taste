<?php
/**
* @package   Warp Theme Framework
* @file      default_results.php
* @version   5.5.14
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<div class="items">

	<?php foreach( $this->results as $result ) : ?>
	<div class="item">
		
		<?php if ( $result->href ) : ?>
		<h1 class="title"><a href="<?php echo JRoute::_($result->href); ?>" <?php if ($result->browsernav == 1 ) echo 'target="_blank"'; ?>><?php  echo $this->escape($result->title); ?></a></h1>
		<?php endif; ?>
		
		<?php if ($result->section || $this->params->get( 'show_date' )) : ?>
		<p class="meta">
			<?php echo JText::_('Created on').' '.$result->created.'. '; ?>
			<?php echo JText::_('Posted in').' '.$this->escape($result->section); ?>
		</p>
		<?php endif; ?>
		
		<div class="content"><?php echo $result->text; ?></div>

	</div>
	<?php endforeach; ?>

</div>

<?php echo $this->pagination->getPagesLinks( ); ?>