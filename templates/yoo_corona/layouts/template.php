<?php
/**
* @package   yoo_corona Template
* @file      template.php
* @version   5.5.0 March 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// get template configuration
include(dirname(__FILE__).'/template.config.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->warp->config->get('language'); ?>" lang="<?php echo $this->warp->config->get('language'); ?>" dir="<?php echo $this->warp->config->get('direction'); ?>" >
<head>
<?php echo $this->warp->template->render('head'); ?>
<link rel="apple-touch-icon" href="<?php echo $this->warp->path->url('template:apple_touch_icon.png'); ?>" />
</head>

<body id="page" class="yoopage <?php echo $this->warp->config->get('columns'); ?> <?php echo $this->warp->config->get('itemcolor'); ?> <?php echo $this->warp->config->get('toolscolor'); ?> <?php echo 'style-'.$this->warp->config->get('style'); ?> <?php echo 'background-'.$this->warp->config->get('background'); ?> <?php echo 'font-'.$this->warp->config->get('font'); ?> <?php echo $this->warp->config->get('webfonts-class'); ?>">

	<?php if ($this->warp->modules->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this->warp->modules->render('absolute'); ?>
	</div>
	<?php endif; ?>
	
	<div id="page-body">

		<div class="wrapper">
			
			<div class="wrapper-1">
				<div class="wrapper-2">
					<div class="wrapper-3">
			
						<div id="header">

							<div id="toolbar">
								
								<?php if($this->warp->config->get('date')) : ?>
								<div id="date">
									<?php echo $this->warp->config->get('actual_date'); ?>
								</div>
								<?php endif; ?>
							
								<?php if ($this->warp->modules->count('toolbarleft')) : ?>
								<div class="left">
									<?php echo $this->warp->modules->render('toolbarleft'); ?>
								</div>
								<?php endif; ?>
								
								<?php if ($this->warp->modules->count('toolbarright')) : ?>
								<div class="right">
									<?php echo $this->warp->modules->render('toolbarright'); ?>
								</div>
								<?php endif; ?>
								
							</div>
							
							<?php if ($this->warp->modules->count('headerbar')) : ?>
							<div id="headerbar">
								<?php echo $this->warp->modules->render('headerbar'); ?>
							</div>
							<?php endif; ?>
								
							<?php  if ($this->warp->modules->count('menu')) : ?>
							<div class="menubar">
								<div id="menu">
									<?php echo $this->warp->modules->render('menu'); ?>
								</div>
							</div>
							<?php endif; ?>
							
							<div class="menushadow"></div>
								
							<?php if ($this->warp->modules->count('logo')) : ?>		
							<div id="logo">
								<?php echo $this->warp->modules->render('logo'); ?>
							</div>
							<?php endif; ?>
							
							<?php if ($this->warp->modules->count('search')) : ?>
							<div id="search">
								<?php echo $this->warp->modules->render('search'); ?>
							</div>
							<?php endif; ?>
							
							<?php if ($this->warp->modules->count('banner')) : ?>
							<div id="banner">
								<?php echo $this->warp->modules->render('banner'); ?>
							</div>
							<?php endif;  ?>
							
							<?php if ($this->warp->modules->count('socialbookmarks')) : ?>
							<div id="socialbookmarks">
								<?php echo $this->warp->modules->render('socialbookmarks'); ?>
							</div>
							<?php endif;  ?>
							
						</div>
						<!-- header end -->

						<?php if ($this->warp->modules->count('top + topblock')) : ?>
						<div id="top">
			
							<?php if($this->warp->modules->count('topblock')) : ?>
							<div class="vertical width100">
								<?php echo $this->warp->modules->render('topblock'); ?>
							</div>
							<?php endif; ?>
			
							<?php if ($this->warp->modules->count('top')) : ?>
								<?php echo $this->warp->modules->render('top', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('top'))); ?>
							<?php endif; ?>
			
						</div>
						<!-- top end -->
						<?php endif; ?>
			
						<div id="middle">
							<div id="middle-expand">

								<div id="main">
									<div id="main-shift">

										<?php if ($this->warp->modules->count('maintop')) : ?>
										<div id="maintop">
											<?php echo $this->warp->modules->render('maintop', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('maintop'))); ?>
										</div>
										<!-- maintop end -->
										<?php endif; ?>
			
										<div id="mainmiddle">
											<div id="mainmiddle-expand">
											
												<div id="content">
													<div id="content-shift">
			
														<?php if ($this->warp->modules->count('contenttop')) : ?>
														<div id="contenttop">
															<?php echo $this->warp->modules->render('contenttop', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('contenttop'))); ?>
														</div>
														<!-- contenttop end -->
														<?php endif; ?>
														
														<?php if ($this->warp->modules->count('breadcrumbs')) : ?>
															<?php echo $this->warp->modules->render('breadcrumbs'); ?>
														<?php endif; ?>
			
														<div id="component" class="floatbox">
															<?php echo $this->warp->template->render('content'); ?>
														</div>
							
														<?php if ($this->warp->modules->count('contentbottom')) : ?>
														<div id="contentbottom">
															<?php echo $this->warp->modules->render('contentbottom', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('contentbottom'))); ?>
														</div>
														<!-- mainbottom end -->
														<?php endif; ?>
													
													</div>
												</div>
												<!-- content end -->
												
												<?php if($this->warp->modules->count('contentleft')) : ?>
												<div id="contentleft" class="vertical">
													<div class="contentleft-1"></div>
													<?php echo $this->warp->modules->render('contentleft'); ?>
												</div>
												<?php endif; ?>
												
												<?php if($this->warp->modules->count('contentright')) : ?>
												<div id="contentright" class="vertical">
													<div class="contentright-1"></div>
													<?php echo $this->warp->modules->render('contentright'); ?>
												</div>
												<?php endif; ?>
												
											</div>
										</div>
										<!-- mainmiddle end -->
			
										<?php if ($this->warp->modules->count('mainbottom')) : ?>
										<div id="mainbottom">
											<?php echo $this->warp->modules->render('mainbottom', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('mainbottom'))); ?>
										</div>
										<!-- mainbottom end -->
										<?php endif; ?>
									
									</div>
								</div>
			
								<?php if($this->warp->modules->count('left')) : ?>
								<div id="left" class="vertical">
									<div class="left-1"></div>
									<?php echo $this->warp->modules->render('left'); ?>
								</div>
								<?php endif; ?>
								
								<?php if($this->warp->modules->count('right')) : ?>
								<div id="right" class="vertical">
									<div class="right-1"></div>
									<?php echo $this->warp->modules->render('right'); ?>
								</div>
								<?php endif; ?>

							</div>
						</div>
			
						<?php if ($this->warp->modules->count('bottom + bottomblock')) : ?>
						<div id="bottom">
			
							<?php if ($this->warp->modules->count('bottom')) : ?>
							<div class="bottom-1">
								<?php echo $this->warp->modules->render('bottom', array('wrapper'=>"horizontal float-left", 'layout'=>$this->warp->config->get('bottom'))); ?>
							</div>
							<?php endif; ?>
			
							<?php if($this->warp->modules->count('bottomblock')) : ?>
							<div class="vertical width100">
								<?php echo $this->warp->modules->render('bottomblock'); ?>
							</div>
							<?php endif; ?>

						</div>
						<!-- bottom end -->
						<?php endif; ?>
						
						<div id="footer">
						
							<?php if ($this->warp->modules->count('footer + debug')) : ?>
							<a class="anchor" href="#page"></a>
							<?php echo $this->warp->modules->render('footer'); ?>
							<?php echo $this->warp->modules->render('debug'); ?>
							<?php endif; ?>
							
						</div>
						<!-- footer end -->
				
					</div>
				</div>
			</div>

		</div>

	</div>
	
	<?php echo $this->render('footer'); ?>
	
</body>
</html>