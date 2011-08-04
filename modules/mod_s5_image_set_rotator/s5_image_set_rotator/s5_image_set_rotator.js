var is_ie_s5_isr/*@cc_on = {
  // quirksmode : (document.compatMode=="BackCompat"),
  version : parseFloat(navigator.appVersion.match(/MSIE (.+?);/)[1])
}@*/;

function opacity_s5_isr(id_s5_isr, opacStart_s5_isr, opacEnd_s5_isr, millisec_s5_isr) {
	//speed for each frame
	var speed_s5_isr = Math.round(millisec_s5_isr / 100);
	var timer_s5_isr = 0;
	//determine the direction for the blending, if start and end are the same nothing happens
	if(opacStart_s5_isr > opacEnd_s5_isr) {
		for(i = opacStart_s5_isr; i >= opacEnd_s5_isr; i--) {
			setTimeout("changeOpac_s5_isr(" + i + ",'" + id_s5_isr + "')",(timer_s5_isr * speed_s5_isr));
			timer_s5_isr++;
		}
	} else if(opacStart_s5_isr < opacEnd_s5_isr) {
		for(i = opacStart_s5_isr; i <= opacEnd_s5_isr; i++)
			{
			setTimeout("changeOpac_s5_isr(" + i + ",'" + id_s5_isr + "')",(timer_s5_isr * speed_s5_isr));
			timer_s5_isr++;
		}
	}
}

//change the opacity for different browsers
function changeOpac_s5_isr(opacity_s5_isr, id_s5_isr) {
	var object_s5_isr = document.getElementById(id_s5_isr).style; 
	object_s5_isr.opacity = (opacity_s5_isr / 100);
	object_s5_isr.MozOpacity = (opacity_s5_isr / 100);
	object_s5_isr.KhtmlOpacity = (opacity_s5_isr / 100);
    object_s5_isr.filter = "alpha(opacity=" + opacity_s5_isr + ")";
}

function blendimage_s5_isr(divid_s5_isr, imageid_s5_isr, imagefile_s5_isr, millisec_s5_isr) {
	var speed_s5_isr = Math.round(millisec_s5_isr / 100);
	var timer_s5_isr = 0;
	
	//set the current image as background
	document.getElementById(divid_s5_isr).style.backgroundImage = "url(" + document.getElementById(imageid_s5_isr).src + ")";
	
	//make image transparent
	changeOpac_s5_isr(0, imageid_s5_isr);
	
	//make new image
	document.getElementById(imageid_s5_isr).src = imagefile_s5_isr;

	//fade in image
	for(i = 0; i <= 100; i++) {
		setTimeout("changeOpac_s5_isr(" + i + ",'" + imageid_s5_isr + "')",(timer_s5_isr * speed_s5_isr));
		timer_s5_isr++;
	}
}

function currentOpac_s5_isr(id_s5_isr, opacEnd_s5_isr, millisec_s5_isr) {
	//standard opacity is 100
	var currentOpac_s5_isr = 100;
	
	//if the element has an opacity set, get it
	if(document.getElementById(id_s5_isr).style.opacity < 100) {
		currentOpac_s5_isr = document.getElementById(id_s5_isr).style.opacity * 100;
	}

	//call for the function that changes the opacity
	opacity_s5_isr(id_s5_isr, currentOpac_s5_isr, opacEnd_s5_isr, millisec_s5_isr)
}


function s5_isr_load_module() {
if (s5_isr_chrome != "yes") {
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
	}
}


var s5_isr_hover = 0;
var s5_isr_current = 1;

function s5_isr_hover_on() {
	s5_isr_hover = 1;
}

function s5_isr_hover_off() {
	s5_isr_hover = 0;
}


function s5_isr_load1_fade_out() {
	s5_isr_current = 1;
	opacity_s5_isr('s5_isr_middle_outer', 100, 0, 500);
	window.setTimeout('s5_isr_load1_fade_in()',500);
}

function s5_isr_load1_fade_in() {
	document.getElementById("s5_isr_middle").innerHTML = document.getElementById("s5_isr_box1").innerHTML;
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
}

function s5_isr_load2_fade_out() {
	s5_isr_current = 2;
	opacity_s5_isr('s5_isr_middle_outer', 100, 0, 500);
	window.setTimeout('s5_isr_load2_fade_in()',500);
}

function s5_isr_load2_fade_in() {
	document.getElementById("s5_isr_middle").innerHTML = document.getElementById("s5_isr_box2").innerHTML;
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
}

function s5_isr_load3_fade_out() {
	s5_isr_current = 3;
	opacity_s5_isr('s5_isr_middle_outer', 100, 0, 500);
	window.setTimeout('s5_isr_load3_fade_in()',500);
}

function s5_isr_load3_fade_in() {
	document.getElementById("s5_isr_middle").innerHTML = document.getElementById("s5_isr_box3").innerHTML;
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
}

function s5_isr_load4_fade_out() {
	s5_isr_current = 4;
	opacity_s5_isr('s5_isr_middle_outer', 100, 0, 500);
	window.setTimeout('s5_isr_load4_fade_in()',500);
}

function s5_isr_load4_fade_in() {
	document.getElementById("s5_isr_middle").innerHTML = document.getElementById("s5_isr_box4").innerHTML;
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
}

function s5_isr_load5_fade_out() {
	s5_isr_current = 5;
	opacity_s5_isr('s5_isr_middle_outer', 100, 0, 500);
	window.setTimeout('s5_isr_load5_fade_in()',500);
}

function s5_isr_load5_fade_in() {
	document.getElementById("s5_isr_middle").innerHTML = document.getElementById("s5_isr_box5").innerHTML;
	opacity_s5_isr('s5_isr_middle_outer', 0, 100, 500);
}


function s5_isr_left() {
		if (s5_isr_current == "1") {
			if (document.getElementById("s5_isr_box5")) {
				s5_isr_load5_fade_out();
			}
			else if (document.getElementById("s5_isr_box4")) {
				s5_isr_load4_fade_out();
			}
			else if (document.getElementById("s5_isr_box3")) {
				s5_isr_load3_fade_out();
			}
			else if (document.getElementById("s5_isr_box2")) {
				s5_isr_load2_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "2") {
			if (document.getElementById("s5_isr_box1")) {
				s5_isr_load1_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "3") {
			if (document.getElementById("s5_isr_box2")) {
				s5_isr_load2_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "4") {
			if (document.getElementById("s5_isr_box3")) {
				s5_isr_load3_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "5") {
			if (document.getElementById("s5_isr_box4")) {
				s5_isr_load4_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
}

function s5_isr_right() {
		if (s5_isr_current == "1") {
			if (document.getElementById("s5_isr_box2")) {
				s5_isr_load2_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "2") {
			if (document.getElementById("s5_isr_box3")) {
				s5_isr_load3_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "3") {
			if (document.getElementById("s5_isr_box4")) {
				s5_isr_load4_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "4") {
			if (document.getElementById("s5_isr_box5")) {
				s5_isr_load5_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
		else if (s5_isr_current == "5") {
			if (document.getElementById("s5_isr_box6")) {
				s5_isr_load6_fade_out();
			}
			else {
				s5_isr_load1_fade_out();
			}
		}
}


function s5_isr_next() {
	if (s5_isr_hover == "0") {
		s5_isr_right();
	}
}




window.setTimeout('s5_isr_load_module()',1000);


