/* Copyright (C) 2007 - 2011 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($){

	/* Accordion menu */
	$('.menu-accordion').accordionMenu({ mode:'slide' });
	
	/* Smoothscroller */
	$('a[href="#page"]').smoothScroller({ duration: 500 });

	/* Spotlight */
	$('.spotlight').spotlight({fade: 300});

    var matchHeight = function(selector, deepest) {
        
        var deepest  = deepest || ".deepest";
        var elements = $(selector);
        var max      = 0;

        elements.each(function(){
            max = Math.max(max, $(this).outerHeight());
        });
        
        
        elements.each(function(){
            var box = $(this),
                ele = box.find(deepest+":first"),
                height = (ele.height() + (max - box.outerHeight()));

            ele.css("min-height", height+"px");
        });
    };  

	/* Match height of div tags */
	var matchHeights = function() {
		
		matchHeight('#top > .horizontal');
		matchHeight('#bottom .bottom-1 > .horizontal');
		matchHeight('#maintop > .horizontal');
		matchHeight('#mainbottom > .horizontal');
		matchHeight('#contenttop > .horizontal');
		matchHeight('#contentbottom > .horizontal');

		$('#middle,#left,#right').matchHeight(20);
		$('#mainmiddle,#contentleft,#contentright').matchHeight(20);
		$('.wrapper-3').matchHeight($(window).height());

	};
	
	$('#top').matchWidth(".horizontal");
	$('#maintop').matchWidth(".horizontal");
	$('#contenttop').matchWidth(".horizontal");
	$('#mainbottom').matchWidth(".horizontal");
	$('#contenttop').matchWidth(".horizontal");
	$('#contentbottom').matchWidth(".horizontal");
	
	$('#menu').css("visibility", "hidden");
	
	$(window).bind("load", function(){
		
		matchHeights();
		
		/* Dropdown menu */
		$('#menu').dropdownMenu({ mode: 'slide', dropdownSelector: 'div.dropdown:first', fixWidth: true}).css("visibility", "visible");	
		
	})
	
});