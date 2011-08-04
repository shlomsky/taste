/* Copyright (C) 2007 - 2011 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

function loadIE6Fix() {

	correctPngBackground('.correct-png', 'crop');
	
	// layout
	
	// typography & joomla
	fixPngBackground('div.info, div.alert, div.download, div.tip, span.info, span.alert, span.download, span.tip');
	fixPngBackground('ul.arrow li, ul.checkbox li, ul.check li, ul.star li');
	fixPngBackground('blockquote.quotation, blockquote.quotation p');
	fixPngBackground('ol.disc');
	fixPngBackground('a.readmore, a.readon');
	fixPngBackground('.default-search div.searchbox');

	// menu
	fixPngBackground('#menu span.icon');
	
	// module
	fixPngBackground('div.module div.badge');
	fixPngBackground('div.module h3.header span.icon');

	DD_belatedPNG.fix('.png_bg');
	
	// menu
	addHover('#menu li.level1, #menu .hover-box1');
	
	// search
	addHover('.default-search div.searchbox');
	addFocus('.default-search div.searchbox input');
	
}

/* Add functions on window load */
jQuery(function(){ loadIE6Fix(); });
jQuery(window).bind('load', correctPngInline);

/* Fix PNG background */
function fixPngBackground(selector) {
	jQuery(selector).each(function(){
		jQuery(this).addClass('png_bg');
	});
}