<?php
/**
@version 1.0: mod_S5_imageslide
Author: Shape 5 - Professional Template Community
Available for download at www.shape5.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$LiveSite = JURI::root();

$pretext		= $params->get( 'pretext', '' );
$tween_time		= $params->get( 'tween_time', '' );
$s5_rotate		= $params->get( 's5_rotate', '' );
$s5_arrowshide	= $params->get( 's5_arrowshide', '' );
$s5_stopplayhide	= $params->get( 's5_stopplayhide', '' );
$s5_chooseimage	= $params->get( 's5_chooseimage', '' );
$s5_thumbnailhide	= $params->get( 's5_thumbnailhide', '' );
$height		        = $params->get( 'height', '' );
$width   		= $params->get( 'width', '' );
$picture1		= $params->get( 'picture1', '' );
$picture1link		= $params->get( 'picture1link', '' );
$picture1target		= $params->get( 'picture1target', '' );
$picture2		= $params->get( 'picture2', '' );
$picture2link		= $params->get( 'picture2link', '' );
$picture2target		= $params->get( 'picture2target', '' );
$picture3		= $params->get( 'picture3', '' );
$picture3link		= $params->get( 'picture3link', '' );
$picture3target		= $params->get( 'picture3target', '' );
$picture4		= $params->get( 'picture4', '' );
$picture4link		= $params->get( 'picture4link', '' );
$picture4target		= $params->get( 'picture4target', '' );
$picture5		= $params->get( 'picture5', '' );
$picture5link		= $params->get( 'picture5link', '' );
$picture5target		= $params->get( 'picture5target', '' );
$picture6		= $params->get( 'picture6', '' );
$picture6link		= $params->get( 'picture6link', '' );
$picture6target		= $params->get( 'picture6target', '' );
$picture7		= $params->get( 'picture7', '' );
$picture7link		= $params->get( 'picture7link', '' );
$picture7target		= $params->get( 'picture7target', '' );
$picture8		= $params->get( 'picture8', '' );
$picture8link		= $params->get( 'picture8link', '' );
$picture8target		= $params->get( 'picture8target', '' );
$picture9		= $params->get( 'picture9', '' );
$picture9link		= $params->get( 'picture9link', '' );
$picture9target		= $params->get( 'picture9target', '' );
$picture10		= $params->get( 'picture10', '' );
$picture10link		= $params->get( 'picture10link', '' );
$picture10target	= $params->get( 'picture10target', '' );
$display_time   	= $params->get( 'display_time', '' );
$s5_imageslidestyle = $params->get( 's5_imageslidestyle', '' );



$tween_time = $tween_time*1000;
$display_time = $display_time*1000;


if ($picture1target == "1") {
$picture1target = "_blank"; }
if ($picture1target == "0") {
$picture1target = "_top"; }
if ($picture2target == "1") {
$picture2target = "_blank"; }
if ($picture2target == "0") {
$picture2target = "_top"; }
if ($picture3target == "1") {
$picture3target = "_blank"; }
if ($picture3target == "0") {
$picture3target = "_top"; }
if ($picture4target == "1") {
$picture4target = "_blank"; }
if ($picture4target == "0") {
$picture4target = "_top"; }
if ($picture5target == "1") {
$picture5target = "_blank"; }
if ($picture5target == "0") {
$picture5target = "_top"; }
if ($picture6target == "1") {
$picture6target = "_blank"; }
if ($picture6target == "0") {
$picture6target = "_top"; }
if ($picture7target == "1") {
$picture7target = "_blank"; }
if ($picture7target == "0") {
$picture7target = "_top"; }
if ($picture8target == "1") {
$picture8target = "_blank"; }
if ($picture8target == "0") {
$picture8target = "_top"; }
if ($picture9target == "1") {
$picture9target = "_blank"; }
if ($picture9target == "0") {
$picture9target = "_top"; }
if ($picture10target == "1") {
$picture10target = "_blank"; }
if ($picture10target == "0") {
$picture10target = "_top"; }

$mainframe->addCustomHeadTag('<script language="javascript" type="text/javascript" src="modules/mod_s5_imageslide/s5_imageslide/mootools.js"></script>');
$mainframe->addCustomHeadTag('<script language="javascript" type="text/javascript" src="modules/mod_s5_imageslide/s5_imageslide/class.noobSlide.packed.js"></script>');

$totalwidth = 0;

if ($picture1 != "") { 
		$totalwidth = 1;}
if ($picture2 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture3 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture4 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture5 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture6 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture7 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture8 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture9 != "") { 
		$totalwidth = $totalwidth + 1;}
if ($picture10 != "") { 
		$totalwidth = $totalwidth + 1;}

?>
	

<?php if ($pretext != "") { ?>
<br />
<?php echo $pretext ?>
<br /><br />
<?php } ?>


<?php
$br = strtolower($_SERVER['HTTP_USER_AGENT']);
$browser = "other";

if(strrpos($br,"msie 6") > 1) {
$iss_ie6= "yes";} 
else {$iss_ie6 = "no";}

if(strrpos($br,"msie 7") > 1) {
$iss_ie7 = "yes";} 
else {$iss_ie7= "no";}
?>

<div style="display:none;">
<?php if ($picture1 != "") { ?><img alt="" src="<?php echo $picture1 ?>"/><?php } ?>
<?php if ($picture2 != "") { ?><img alt="" src="<?php echo $picture2 ?>"/><?php } ?>
<?php if ($picture3 != "") { ?><img alt="" src="<?php echo $picture3 ?>"/><?php } ?>
<?php if ($picture4 != "") { ?><img alt="" src="<?php echo $picture4 ?>"/><?php } ?>
<?php if ($picture5 != "") { ?><img alt="" src="<?php echo $picture5 ?>"/><?php } ?>
<?php if ($picture6 != "") { ?><img alt="" src="<?php echo $picture6 ?>"/><?php } ?>
<?php if ($picture7 != "") { ?><img alt="" src="<?php echo $picture7 ?>"/><?php } ?>
<?php if ($picture8 != "") { ?><img alt="" src="<?php echo $picture8 ?>"/><?php } ?>
<?php if ($picture9 != "") { ?><img alt="" src="<?php echo $picture9 ?>"/><?php } ?>
<?php if ($picture10 != "") { ?><img alt="" src="<?php echo $picture10 ?>"/><?php } ?>
</div>

<script type="text/javascript">
var picture1link = "<?php echo $picture1link ?>";
var picture1target = "<?php echo $picture1target ?>";
var picture2link = "<?php echo $picture2link ?>";
var picture2target = "<?php echo $picture2target ?>";
var picture3link = "<?php echo $picture3link ?>";
var picture3target = "<?php echo $picture3target ?>";
var picture4link = "<?php echo $picture4link ?>";
var picture4target = "<?php echo $picture4target ?>";
var picture5link = "<?php echo $picture5link ?>";
var picture5target = "<?php echo $picture5target ?>";
var picture6link = "<?php echo $picture6link ?>";
var picture6target = "<?php echo $picture6target ?>";
var picture7link = "<?php echo $picture7link ?>";
var picture7target = "<?php echo $picture7target ?>";
var picture8link = "<?php echo $picture8link ?>";
var picture8target = "<?php echo $picture8target ?>";
var picture9link = "<?php echo $picture9link ?>";
var picture9target = "<?php echo $picture9target ?>";
var picture10link = "<?php echo $picture10link ?>";
var picture10target = "<?php echo $picture10target ?>";
</script>
	

		
		
		

<script type="text/javascript">//<![CDATA[
    document.write('<link href="<?php echo $LiveSite?>/modules/mod_s5_imageslide/s5_imageslide/style.css" rel="stylesheet" type="text/css" media="screen" />');
//]]></script>
<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >var display_time = ".$display_time.";</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var tween_time = ".$tween_time.";</script>";?>
<script type="text/javascript">//<![CDATA[
    document.write('<style type="text/css">.s5_button_if {background:url(<?php echo $LiveSite?>/modules/mod_s5_imageslide/s5_imageslide/nonactive.png) no-repeat;}</style>');
//]]></script>


<?php if ($iss_ie6  == "yes") { ?>
<style type="text/css">
	#s5_ismod_stop {
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo $LiveSiteUrl;?>modules/mod_s5_imageslide/s5_imageslide/stop.png', sizingmethod='crop');}
	#s5_ismod_play {
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo $LiveSiteUrl;?>modules/mod_s5_imageslide/s5_imageslide/play.png', sizingmethod='crop');}
	#s5_is_leftarrow {
	margin-top:120px;
	margin-left:12px;
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo $LiveSiteUrl;?>modules/mod_s5_imageslide/s5_imageslide/left_arrow.png', sizingmethod='crop');}
	#s5_is_rightarrow {
	margin-top:120px;
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo $LiveSiteUrl;?>modules/mod_s5_imageslide/s5_imageslide/right_arrow.png', sizingmethod='crop');}
</style>
<?php } ?>


<script type="text/javascript">
	window.addEvent('domready',function(){
		var s5_startItem = 0;
		var s5_if_thumbs_maskout = $('s5_if_thumbs_maskout').setStyle('left',(s5_startItem*68-568)+'px').setOpacity(0.8);
		var fxOptions7 = {duration:tween_time, transition:Fx.Transitions.<?php echo $s5_imageslidestyle;?>, wait:false}
		var thumbsFx = new Fx.Style(s5_if_thumbs_maskout,'left',fxOptions7);
		var hs7 = new noobSlide({
			box: $('s5_if_innerbox'),
			items: [<?php if ($picture1 != "") { ?>0<?php } ?><?php if ($picture2 != "") { ?>,1<?php } ?><?php if ($picture3 != "") { ?>,2<?php } ?><?php if ($picture4 != "") { ?>,3<?php } ?><?php if ($picture5 != "") { ?>,4<?php } ?><?php if ($picture6 != "") { ?>,5<?php } ?><?php if ($picture7 != "") { ?>,6<?php } ?><?php if ($picture8 != "") { ?>,7<?php } ?><?php if ($picture9 != "") { ?>,8<?php } ?><?php if ($picture10 != "") { ?>,9<?php } ?>],
			autoPlay:  <?php if ($s5_rotate == "truee") { ?>true<?php } else {?>false<?php } ?>,
			handles: $ES('span','s5_if_thumbs_handlesout'),
			fxOptions: fxOptions7,
			buttons: {previous: $('s5_prev'), play: $('s5_play'), stop: $('s5_stop'), next: $('s5_next')},
			button_event: 'click',
			onWalk: function(currentItem){
			thumbsFx.start(currentItem*68-568);},s5_startItem: s5_startItem});	hs7.walk(0);	});
</script>


<div class="s5_is_wrap">
<div <?php if ($s5_stopplayhide == "block") { ?>onmouseout="s5_ismod_outhover();" onmouseover="s5_ismod_onhover();"<?php } ?> >
<div id="s5_ismod_onhover" style="width: <?php echo (($width) / 2) + 50;?>px; position: absolute; z-index: 1; display: none;">
			<div style="margin-left: <?php echo (($width) / 2) - 55;?>px; position: absolute; margin-top:<?php echo (($height) / 2) - 80;?>px;">
			<div id="s5_stop">
				<div onclick="s5_ismod_switchbuttons();" style="margin-top: 4px; cursor: pointer; float: left; margin-left: 4px; margin-right: 4px;" id="s5_ismod_stop"></div>
			</div>	
			<div id="s5_play">
				<div onclick="s5_ismod_switchbuttons();" style="display: none; margin-top: 4px; cursor: pointer; float: left; margin-left: 4px; margin-right: 8px;" id="s5_ismod_play"></div>
			</div>
			</div>
		</div>


	<div class="s5_mask" style="width:<?php echo $width;?>px;height:<?php echo $height;?>px;overflow:hidden;">
	<div id="s5_prev">
		<div id="s5_is_leftarrow" style="display:<?php echo $s5_arrowshide;?>;height:<?php echo $height;?>px;"></div>
	</div>
	
		<div id="s5_if_innerbox">
			<?php if ($picture1 != "") { ?>
			<span>
				<?php if ($picture1link != "") { ?>
					<a href="<?php echo $picture1link ?>" target="<?php echo $picture1target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture1 ?>" alt="Photo" /><?php if ($picture1link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture2 != "") { ?>
			<span>
				<?php if ($picture2link != "") { ?>
					<a href="<?php echo $picture2link ?>" target="<?php echo $picture2target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture2 ?>" alt="Photo" /><?php if ($picture2link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture3 != "") { ?>
			<span>
				<?php if ($picture3link != "") { ?>
					<a href="<?php echo $picture3link ?>" target="<?php echo $picture3target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture3 ?>" alt="Photo" /><?php if ($picture3link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture4 != "") { ?>
			<span>
				<?php if ($picture4link != "") { ?>
					<a href="<?php echo $picture4link ?>" target="<?php echo $picture4target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture4 ?>" alt="Photo" /><?php if ($picture4link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture5 != "") { ?>
			<span>
				<?php if ($picture5link != "") { ?>
					<a href="<?php echo $picture5link ?>" target="<?php echo $picture5target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture5 ?>" alt="Photo" /><?php if ($picture5link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture6 != "") { ?>
			<span>
				<?php if ($picture6link != "") { ?>
					<a href="<?php echo $picture6link ?>" target="<?php echo $picture6target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture6 ?>" alt="Photo" /><?php if ($picture6link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture7 != "") { ?>
			<span>
				<?php if ($picture7link != "") { ?>
					<a href="<?php echo $picture7link ?>" target="<?php echo $picture7target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture7 ?>" alt="Photo" /><?php if ($picture7link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture8 != "") { ?>
			<span>
				<?php if ($picture8link != "") { ?>
					<a href="<?php echo $picture8link ?>" target="<?php echo $picture8target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture8 ?>" alt="Photo" /><?php if ($picture8link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture9 != "") { ?>
			<span>
				<?php if ($picture9link != "") { ?>
					<a href="<?php echo $picture9link ?>" target="<?php echo $picture9target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture9 ?>" alt="Photo" /><?php if ($picture9link != "") { ?></a><?php } ?></span><?php } ?>
			<?php if ($picture10 != "") { ?>
			<span>
				<?php if ($picture10link != "") { ?>
					<a href="<?php echo $picture10link ?>" target="<?php echo $picture10target ?>" style="cursor:pointer"><?php } ?>
						<img src="<?php echo $picture10 ?>" alt="Photo" /><?php if ($picture10link != "") { ?></a><?php } ?></span><?php } ?>
		</div>
	<div id="s5_next">	
		<div id="s5_is_rightarrow" style="display:<?php echo $s5_arrowshide;?>;height:<?php echo $height;?>px;"></div>	
	</div>
	</div>
</div>
	<div id="s5_if_thumbsouter" style="width:<?php echo ($totalwidth) * 70;?>px;display:<?php echo $s5_thumbnailhide;?>;margin-top:<?php echo ($height) - 65;?>px;">
		<div class="s5_if_thumbs">
			<?php if ($picture1 != "") { ?><div><img src="<?php echo $picture1 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture2 != "") { ?><div><img src="<?php echo $picture2 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture3 != "") { ?><div><img src="<?php echo $picture3 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture4 != "") { ?><div><img src="<?php echo $picture4 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture5 != "") { ?><div><img src="<?php echo $picture5 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture6 != "") { ?><div><img src="<?php echo $picture6 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture7 != "") { ?><div><img src="<?php echo $picture7 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture8 != "") { ?><div><img src="<?php echo $picture8 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture9 != "") { ?><div><img src="<?php echo $picture9 ?>" alt="Photo Thumb" /></div><?php } ?>
			<?php if ($picture10 != "") { ?><div><img src="<?php echo $picture10 ?>" alt="Photo Thumb" /></div><?php } ?>
		</div>
		<div id="s5_if_thumbs_maskout"></div>
		<p id="s5_if_thumbs_handlesout">
			<?php if ($picture1 != "") { ?><span></span><?php } ?>
			<?php if ($picture2 != "") { ?><span></span><?php } ?>
			<?php if ($picture3 != "") { ?><span></span><?php } ?>
			<?php if ($picture4 != "") { ?><span></span><?php } ?>
			<?php if ($picture5 != "") { ?><span></span><?php } ?>
			<?php if ($picture6 != "") { ?><span></span><?php } ?>
			<?php if ($picture7 != "") { ?><span></span><?php } ?>
			<?php if ($picture8 != "") { ?><span></span><?php } ?>
			<?php if ($picture9 != "") { ?><span></span><?php } ?>
			<?php if ($picture10 != "") { ?><span></span><?php } ?>
		</p>
	</div>


	
</div>
























