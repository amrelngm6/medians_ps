/*4.4.2|*/;var moveLeft={};var moveUp={};var ddlevelsmenu={enableshim:!1,arrowpointers:{downarrow:['data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',0,0],rightarrow:['data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',0,0],showarrow:{toplevel:!1,sublevel:!1}},hideinterval:500,effects:{enableswipe:!1,enablefade:!1,duration:300},httpsiframesrc:'blank.htm',topmenuids:[],topitems:{},subuls:{},lastactivesubul:{},topitemsindex:-1,ulindex:-1,hidetimers:{},shimadded:!1,nonFF:!/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent),getoffset:function(e,t){return(e.offsetParent)?e[t]+this.getoffset(e.offsetParent,t):e[t]},getoffsetof:function(e,t){var i=jQuery(e).position();e._offsets={left:i.left+parseInt(moveLeft[t]),top:i.top+parseInt(moveUp[t])}},getwindowsize:function(){this.docwidth=jQuery(window).width()-25;this.docheight=jQuery(window).height()-25},gettopitemsdimensions:function(){for(var n=0;n<this.topmenuids.length;n++){var o=this.topmenuids[n];for(var i=0;i<this.topitems[o].length;i++){var e=this.topitems[o][i];if(typeof e!=='undefined'){var t=document.getElementById(e.getAttribute('rel'));if(t!==null)e._dimensions={w:e.offsetWidth,h:e.offsetHeight,submenuw:t.offsetWidth,submenuh:t.offsetHeight}}}}},isContained:function(e,t){var t=window.event||t,i=t.relatedTarget||((t.type=='mouseover')?t.fromElement:t.toElement);while(i&&i!=e)try{i=i.parentNode}catch(n){i=e};if(i==e)return!0;else return!1},addpointer:function(e,t,i,n){var o=document.createElement('img');o.src=i[0];o.style.width=i[1]+'px';o.style.height=i[2]+'px';if(t=='rightarrowpointer'){o.style.left=e.offsetWidth-i[2]-2+'px'};o.className=t;var a=e.childNodes[e.firstChild.nodeType!=1?1:0];if(a&&a.tagName=='SPAN'){e=a};if(n=='before')e.insertBefore(o,e.firstChild);else e.appendChild(o)},css:function(e,t,i){var n=new RegExp('(^|\\s+)'+t+'($|\\s+)','ig');if(i=='check')return n.test(e.className);else if(i=='remove')e.className=e.className.replace(n,'');else if(i=='add'&&!n.test(e.className))e.className+=' '+t},addshimmy:function(e){var t=(!window.opera)?document.createElement('iframe'):document.createElement('div');t.className='ddiframeshim';t.setAttribute('src',location.protocol=='https:'?this.httpsiframesrc:'about:blank');t.setAttribute('frameborder','0');e.appendChild(t);try{t.style.filter='progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)'}catch(i){};return t},positionshim:function(e,t,i,n,o){if(e._istoplevel){var o=window.pageYOffset?window.pageYOffset:this.standardbody.scrollTop,a=e._offsets.top-o,s=o+this.docheight-e._offsets.top-e._dimensions.h;if(a>0){this.shimmy.topshim.style.left=n+'px';this.shimmy.topshim.style.top=o+'px';this.shimmy.topshim.style.width='99%';this.shimmy.topshim.style.height=a+'px'};if(s>0){this.shimmy.bottomshim.style.left=n+'px';this.shimmy.bottomshim.style.top=e._offsets.top+e._dimensions.h+'px';this.shimmy.bottomshim.style.width='99%';this.shimmy.bottomshim.style.height=s+'px'}}},hideshim:function(){this.shimmy.topshim.style.width=this.shimmy.bottomshim.style.width=0;this.shimmy.topshim.style.height=this.shimmy.bottomshim.style.height=0},buildmenu:function(e,t,i,n,s,r,o){i._master=e;i._pos=s;i._istoplevel=r;var l=1,d;if(r)d=o;if($('html').hasClass('koTheme4'))l=2;if(r){var a=$(i).find('span');if(l==2){a.find('i').remove();a.append(' <i class="fa fa-angle-right"></i>');o='sidebar'}
else{a.find('i').remove();a.append(' <i class="fa fa-angle-down"></i>')};this.addEvent(i,function(e){ddlevelsmenu.hidemenu(ddlevelsmenu.subuls[this._master][parseInt(this._pos)])},'click')}
else{o='sidebar';if(typeof n==='object'){var a=$(i).first('span');a.find('i').remove();a.prepend('<i class="fa fa-angle-right float-right" style="line-height:35px;width:22px;"></i>')}};this.subuls[e][s]=n;i._dimensions={w:jQuery(i).width(),h:jQuery(i).outerHeight(),submenuw:jQuery(n).width(),submenuh:jQuery(n).height()};this.getoffsetof(i);jQuery(n).css({left:0,top:0,visibility:'hidden'});this.addEvent(i,function(t){if(!ddlevelsmenu.isContained(this,t)){var a=ddlevelsmenu.subuls[this._master][parseInt(this._pos)];if(this._istoplevel){ddlevelsmenu.css(this,'selected','add');clearTimeout(ddlevelsmenu.hidetimers[this._master][this._pos])};ddlevelsmenu.getoffsetof(i,e);var r=window.pageXOffset?window.pageXOffset:ddlevelsmenu.standardbody.scrollLeft,n=window.pageYOffset?window.pageYOffset:ddlevelsmenu.standardbody.scrollTop,d=jQuery(this).offset().left+this._dimensions.submenuw+(this._istoplevel&&o=='topbar'?0:this._dimensions.w),u=jQuery(this).offset().top+this._dimensions.submenuh,l=(this._istoplevel?jQuery(this).offset().left+(o=='sidebar'?this._dimensions.w:0):this._dimensions.w);if(d-r>ddlevelsmenu.docwidth){l+=-this._dimensions.submenuw+(this._istoplevel&&o=='topbar'?this._dimensions.w:-this._dimensions.w)};var s=(this._istoplevel?jQuery(this).offset().top+(o=='sidebar'?0:this._dimensions.h):jQuery(this).position().top);if(u-n>ddlevelsmenu.docheight){if(this._dimensions.submenuh<jQuery(this).offset().top+(o=='sidebar'?this._dimensions.h:0)-n){s+=-this._dimensions.submenuh+(this._istoplevel&&o=='topbar'?-this._dimensions.h:this._dimensions.h)}
else{s+=-(jQuery(this).offset().top-n)+(this._istoplevel&&o=='topbar'?-this._dimensions.h:0)}};if(this._istoplevel)jQuery(a).css({top:s+parseInt(moveUp[e]),left:l+parseInt(moveLeft[e])});else jQuery(a).css({top:s,left:l});if(ddlevelsmenu.enableshim&&(ddlevelsmenu.effects.enableswipe==!1||ddlevelsmenu.nonFF)){ddlevelsmenu.positionshim(i,a,o,r,n)}
else{a.FFscrollInfo={x:r,y:n}};clearTimeout(ddlevelsmenu.hidetimers[this._master][this._pos]);ddlevelsmenu.showmenu(i,a,o)}},'mouseover');this.addEvent(i,function(e){var t=ddlevelsmenu.subuls[this._master][parseInt(this._pos)];if(this._istoplevel){if(!ddlevelsmenu.isContained(this,e)&&!ddlevelsmenu.isContained(t,e)){ddlevelsmenu.hidetimers[this._master][this._pos]=setTimeout(function(){ddlevelsmenu.hidemenu(t)},ddlevelsmenu.hideinterval)}}
else if(!this._istoplevel&&!ddlevelsmenu.isContained(this,e)){ddlevelsmenu.hidetimers[this._master][this._pos]=setTimeout(function(){ddlevelsmenu.hidemenu(t)},ddlevelsmenu.hideinterval)}},'mouseout')},setopacity:function(e,t){e.style.opacity=t;if(typeof e.style.opacity!='string'){e.style.MozOpacity=t;if(e.filters){e.style.filter='progid:DXImageTransform.Microsoft.alpha(opacity='+t*100+')'}}},showmenu:function(e,t,i){var n='#'+t.id;if(jQuery(n).css('visibility')=='visible'&&jQuery(n).css('display')=='block')return;jQuery(n).css({'margin':'0','padding':'0','visibility':'visible','display':'none'});if(this.effects.enableswipe){jQuery(n).slideDown()}
else if(this.effects.enablefade){jQuery(n).fadeIn()}
else{jQuery(n).show()};jQuery(n).addClass('active');return},hidemenu:function(e){jQuery('#'+e.id).removeClass('active').stop().hide()},addEvent:function(e,t,i){if(e.addEventListener)e.addEventListener(i,t,!1);else if(e.attachEvent)e.attachEvent('on'+i,function(){return t.call(e,window.event)})},init:function(e,t){this.standardbody=(document.compatMode=='CSS1Compat')?document.documentElement:document.body;this.topitemsindex=0;this.ulindex=0;this.topmenuids.push(e);this.topitems[e]=[];this.subuls[e]=[];this.hidetimers[e]=[];if(this.enableshim&&!this.shimadded){this.shimmy={};this.shimmy.topshim=this.addshimmy(document.body);this.shimmy.bottomshim=this.addshimmy(document.body);this.shimadded=!0};var a=jQuery('a[rel^=\'dropmenu_'+e+'_\']');this.getwindowsize();for(var n=0;n<a.length;n++){var l=[];if(a[n].getAttribute('rel')){var r=a[n];l=a[n].getAttribute('rel').split('_');this.realpageid=l[1]+'_'+l[2];this.topitemsindex++;this.ulindex++;this.topitems[e][this.topitemsindex]=r;var i=document.getElementById(r.getAttribute('rel'));i._master=e;i._pos=this.topitemsindex;this.addEvent(i,function(){ddlevelsmenu.hidemenu(this)},'click');var u=(t=='sidebar')?'rightarrowpointer':'downarrowpointer',c=(t=='sidebar')?this.arrowpointers.rightarrow:this.arrowpointers.downarrow;this.buildmenu(e,this.realpageid,r,i,this.ulindex,!0,t);i.onmouseover=function(){clearTimeout(ddlevelsmenu.hidetimers[this._master][this._pos])};this.addEvent(i,function(e){if(!ddlevelsmenu.isContained(this,e)&&!ddlevelsmenu.isContained(ddlevelsmenu.topitems[this._master][parseInt(this._pos)],e)){var t=this;if(ddlevelsmenu.enableshim)ddlevelsmenu.hideshim();ddlevelsmenu.hidetimers[this._master][this._pos]=setTimeout(function(){ddlevelsmenu.hidemenu(t)},ddlevelsmenu.hideinterval)}},'mouseout');var s=i.getElementsByTagName('ul');for(var o=0;o<s.length;o++){var d=s[o].parentNode;this.topitemsindex++;this.ulindex++;this.topitems[e][this.topitemsindex]=d;this.buildmenu(e,this.realpageid,d,s[o],this.ulindex,!1,t)}}};this.addEvent(window,function(){ddlevelsmenu.getwindowsize();ddlevelsmenu.gettopitemsdimensions()},'resize')},setup:function(e,t,i,n){jQuery('.dropfirst').prependTo('body');jQuery(function(){moveLeft[e]=i;moveUp[e]=n;ddlevelsmenu.init(e,t)})}};(function(e){e._mobileMenu=function(t,i){var o={menuMaxWidth:768,menuCaption:menuCaption};var n=this,a=e(t),t=t;n.goTo=function(e){var t;if(!e)e=window.event;if(e.target)t=e.target;else if(e.srcElement)t=e.srcElement;if(t.nodeType===3)t=t.parentNode;if(t.value)window.location.href=t.value};n.init=function(){var i=!1,a,s;if(e('html').hasClass('ko_ThemeMobileMenu'))i=!0;if(e(window).outerWidth()>o.menuMaxWidth&&i!=!0){e('#mobileMenu').remove();e(t).show();return}
else{if(e('#mobileMenu').length==0){e(t).before('<div id="mobileMenu"></div>').hide();if(i){if(e(window).outerWidth()>o.menuMaxWidth)e(t).before('<ul class="menuHolder menuStack topmenu"><li><a href="javascript:void(null)" class="" onclick="$(\'html\').addClass(\'ko_ThemeMobileMenuOpen\')"><i class="fas fa-bars"></i></a></li></ul>')}}
else e(t).hide();$_mobileMenu='<div id="mobileMenu">';if(i&&e(window).outerWidth()>o.menuMaxWidth){}
else{$_mobileMenu+='<a href="javascript:void(null)" class="mobileMenuOpen" onclick="$(\'html\').addClass(\'ko_ThemeMobileMenuOpen\')"><i class="fa fa-bars"></i></a>';var n=e('#topmenuSocialShop');if(n.length>0){$_mobileMenu+='<div class="mobileMenuOpen mobileMenuShop">'+n.html()+'</div>'}};$_mobileMenu+='<div id="mobileMenuHolder"><ul class="mobileMenu"><li class="mobileMenuCloseHolder"><a href="javascript:void(null)" class="mobileMenuClose" onclick="$(\'html\').removeClass(\'ko_ThemeMobileMenuOpen\')"><i class="fa fa-times"></i></a></li>';$mobileMenu='<select style="width:100%;" id="mobileMenuSelect">';$mobileMenu+='<option>'+o.menuCaption+'</option>';e(t).find('a').each(function(t){if(e(this).hasClass('dropdown-item')||e(this).hasClass('goog-logo-link')){s=!0;return};if(e(this).parent().parent().hasClass('topmenuSocial')){a=!0;return};$mobileMenu+='<option value="'+e(this).attr('href')+'">'+e(this).text()+'</option>';$_mobileMenu+='<li><a';$_mobileMenu+=' class="mobileMenuLevel_1';if(e(this).parent().hasClass('item_active')){$_mobileMenu+=' mobileActive'};$_mobileMenu+='"';$_mobileMenu+=' href="'+e(this).attr('href')+'">'+e(this).text()+'<i class="fa fa-chevron-right pull-right"></i></a>';$thisSubpage=e(this).attr('rel');$_mMCount=0;$_mobileSubmenuMenu='';if(typeof $thisSubpage!=='undefined'){$_mMCount++;$_mobileSubmenuMenu+='<li><ul class="dropmenudiv">'+e('#'+$thisSubpage).html()+'</ul></li>'};if($_mMCount>0){$_mobileMenu+='<ul>'+$_mobileSubmenuMenu+'</ul>'};$_mobileMenu+='</li>'});$mobileMenu+='</select>';$_mobileMenu+='<li class="mobileMenuSocial">';if(a==!0){$_mobileMenu+=e(t).find('li.topmenuSocial:first').html()};if(s==!0){$_mobileMenu+='<span class="mobileMenuLang">';e(t).find('.dropdown-item').each(function(){$_mobileMenu+='<a href="'+e(this).attr('href')+'"';if(typeof e(this).attr('onclick')!=='undefined'){$_mobileMenu+=' onclick="'+e(this).attr('onclick')+'"'};$_mobileMenu+='>';$_mobileMenu+=e(this).html();$_mobileMenu+='</a>'});$_mobileMenu+='</span>'};$_mobileMenu+='</li>';$_mobileMenu+='</ul>';$_mobileMenu+='</div></div>';$_mobileMenu+='<style>.mobileMenuSocial{ position:relative;bottom:20px;left:0;right:0;margin: 100px 0 -100px !important}.mobileMenu li.mobileMenuSocial span {display:flex;justify-content: center;padding: 20px; flex-wrap: wrap;}.mobileMenuLang {max-width: 100%;overflow-x: auto;padding-bottom: 20px;}.mobileMenu li.mobileMenuSocial a {text-align:center;padding:0;line-height:30px;height:30px;width:auto;padding:0 10px;display:block;border:0;margin-bottom:5px;}.mobileMenu li.mobileMenuSocial a i {margin:0;display:block;line-height:30px;position:relative;left:0;}.mobileMenu li.mobileMenuSocial a i.pull-right {left:auto;right:0}</style>';if(e('.mobileMenu').length){}
else{e('body').append($_mobileMenu);e('.mobileMenu > li:not(.mobileMenuSocial)').find('a').click(function(){e('html').removeClass('ko_ThemeMobileMenuOpen')})}}};e(window).resize(function(){n.init()});n.init()};e.fn._mobileMenu=function(t){return this.each(function(){if(undefined==e(this).data('_mobileMenu')){e(this).data('_mobileMenu',new e._mobileMenu(this,t))}})}})(jQuery);jQuery(function(){jQuery('ul.topmenu')._mobileMenu()});if(!Date.now)Date.now=function(){return new Date().getTime()};(function(){'use strict';var n=['webkit','moz'];for(var t=0;t<n.length&&!window.requestAnimationFrame;++t){var e=n[t];window.requestAnimationFrame=window[e+'RequestAnimationFrame'];window.cancelAnimationFrame=(window[e+'CancelAnimationFrame']||window[e+'CancelRequestAnimationFrame'])};if(/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent)||!window.requestAnimationFrame||!window.cancelAnimationFrame){var i=0;window.requestAnimationFrame=function(e){var t=Date.now(),n=Math.max(i+16,t);return setTimeout(function(){e(i=n)},n-t)};window.cancelAnimationFrame=clearTimeout}}());function is_iOS(){return['iPad Simulator','iPhone Simulator','iPod Simulator','iPad','iPhone','iPod'].includes(navigator.platform)||(navigator.userAgent.includes('Mac')&&'ontouchend' in document)}(function(e){var t=e(window),n=t.height();t.on('resize',function(){n=t.height()});var i=123,o=function(e,o,a,s){if(is_iOS()){return};i+=68;var l='jqueryparallax'+i;e.data('jquery-parallax-instance',l);function r(){var l=e.offset().top,i=t.scrollTop(),r=e.offset().top,d=s?e.outerHeight(!0):e.height();if(r+d<i||r>i+n){return};e.css('backgroundPosition',o+' '+Math.round((l-i)*a)+'px')};t.bind('scroll',function(){window.requestAnimationFrame(r)}).resize(function(){window.requestAnimationFrame(r)});r()},a=function(e){var i=e.data('jquery-parallax-instance');if(i){t.off('.'+i);e.removeData('jquery-parallax-instance');e.css('backgroundPosition','center center')}};e.fn.parallax=function(t,i,n){e(this).each(function(){if(t=='destroy'){a(e(this))}
else{var s=e(this).attr('data-background-pos');if(typeof s==='undefined')s='';if(s.indexOf('-')>0){s=s.split('-');s=s[1].split(' ');s=s[0]}
else s='50%';o(e(this),typeof t!=='undefined'?t:s,typeof i!=='undefined'?i:0.1,typeof n!=='undefined'?n:!0)}})}})(jQuery);$('.parallax-window').parallax();(function(e){e.fn.koVideoLightbox=function(t){t=e.extend({autoplay:!0,button:!0},t);if(e('#koVideoModal').length==0){var i='<div id="koVideoModal" class="kelement"><div>';i+='<a id="koVideoModalClose" href="javascript:void(null)">&times;</a>';i+='<iframe id="koVideoModalFrame" width="870" height="489" frameborder="0" allowfullscreen></iframe>';i+='</div></div>';i+='<style>#koVideoModal{box-sizing:border-box;position:fixed;z-index:65600;left:0;top:-99990px;bottom:0;height:100vh;width:100vw;display: flex; align-items: center; justify-content: center;	    background-color: rgba(0,0,0,0);	    background-image: radial-gradient(circle at center,rgba(127,127,127,0.5) 0%,rgba(0,0,0,0.7) 100%);transition: opacity 0.2s linear;opacity:0;visibility:hidden}';i+='#koVideoModal.modalActive{opacity:1;visibility:visible;top:0}';i+='#koVideoModalFrame{border:5px solid #fff;box-shadow:2px 2px 66px rgba(0,0,0,0.5);background:black;max-width:85vw;max-height:100%}';i+='#koVideoModal div{position:relative; }';i+='#koVideoModalClose{position:absolute;top:0;right:-50px;width:50px;height:50px;background:rgba(255,255,255,1);text-align:center;line-height:45px;font-size:30px;text-decoration:none;color:#666;}';i+='#koVideoModalClose:hover{background:rgba(255,255,255,1);color:#111;}';i+='.koVideoPlay { font-size: 45px; width: 106px; height: 106px;position: absolute;top: 50%;left: 50%;z-index: 2;transform: translate(-50%, -50%);background-color: rgba(0, 0, 0, 0.5);border: 3px solid #000;border-radius: 50%;outline: none;cursor: pointer;box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 0.25),0 0 70px rgba(0,0,0,0.7);transition: transform .5s ease;}';i+='.videoLightbox:hover .koVideoPlay {background-color: rgba(0, 0, 0, 1);transform: translate(-50%, -50%) scale(1.2, 1.2) ;transition: transform .3s ease,opacity .3s ease;opacity:1;}';i+='</style>';e('body').append(i);e('#koVideoModalClose,#koVideoModal').click(function(){e('#koVideoModal').removeClass('modalActive');e('#koVideoModalFrame').attr('src','')})};return this.each(function(i,n){var a=e(n),r=/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,o=a.attr('href').match(r);if(o&&o[2].length==11){var s='https://www.youtube-nocookie.com/embed/'+o[2]}
else{r=/(?:vimeo)\.com.*(?:videos|video|channels|)\/([\d]+)/i;o=a.attr('href').match(r);if(o===null){return'error'};if(o.length>0)var s='//player.vimeo.com/video/'+o[1]};if(typeof s==='undefined')return'error';var l=a;l.click(function(i){i.preventDefault();if(typeof koUrl!=='undefined'){if(!(i.target.tagName=='path'||i.target.tagName=='span'||i.target.tagName=='svg')){return!1}};s+='?showinfo=0&amp;rel=0&amp;autohide=1&amp;disablekb=1&amp;modestbranding=1';if(t.autoplay==!0)s+='&amp;autoplay=1';e('#koVideoModalFrame').attr('src',s);setTimeout(function(){e('#koVideoModal').addClass('modalActive')},200)});if(t.button==!0&&a.find('img').length>0){let vpos=a.attr('data-video-button-pos');if(typeof vpos!=='undefined'){vpos=vpos.split('|');vpos=' style="margin-left:'+vpos[0]+'px;margin-top:'+vpos[1]+'px;"'}
else vpos='';a.append('<span class="koVideoPlay kelement"'+vpos+'><svg height="100px" version="1.1" viewBox="0 0 20 20" width="100px" xmlns="http:\/\/www.w3.org\/2000\/svg" xmlns:xlink="http:\/\/www.w3.org\/1999\/xlink"><title\/><desc\/><defs\/><g fill="none" stroke="none"><g fill="#ffffff" transform="translate(-168.000000, -85.000000)"><g transform="translate(168.000000, 85.000000)"><path d="M8,14.5 L14,10 L8,5.5 L8,14.5 L8,14.5 Z M10,0 C4.5,0 0,4.5 0,10 C0,15.5 4.5,20 10,20 C15.5,20 20,15.5 20,10 C20,4.5 15.5,0 10,0 L10,0 Z M10,18 C5.6,18 2,14.4 2,10 C2,5.6 5.6,2 10,2 C14.4,2 18,5.6 18,10 C18,14.4 14.4,18 10,18 L10,18 Z" \/><\/g><\/g><\/g><\/svg></span>')}})};e('a.videoLightbox').koVideoLightbox()})(jQuery);function socialShare(e){var t='';if(e==0)t='https://www.addtoany.com/share_save?linkurl='+window.location.href;else if(e==1)t='https://www.facebook.com/sharer/sharer.php?u='+window.location.href;else if(e==2)t='https://twitter.com/share?url='+window.location.href+'&text='+document.title;else if(e==3)t='https://plus.google.com/share?url='+window.location.href;else if(e==4)t='https://www.linkedin.com/shareArticle?mini=true&url='+window.location.href;else if(e==9)t='mailto:?subject='+document.title+'&body='+window.location.href;var i=650,n=450;window.open(t,'Share Dialog','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width='+i+',height='+n+',top='+(screen.height/2-n/2)+',left='+(screen.width/2-i/2))};!function(e,t){'object'==typeof exports&&'undefined'!=typeof module?module.exports=t():'function'==typeof define&&define.amd?define(t):(e='undefined'!=typeof globalThis?globalThis:e||self).LazyLoad=t()}(this,(function(){'use strict';function T(){return T=Object.assign||function(e){for(var n=1;n<arguments.length;n++){var i=arguments[n];for(var t in i)Object.prototype.hasOwnProperty.call(i,t)&&(e[t]=i[t])};return e},T.apply(this,arguments)};var o='undefined'!=typeof window,O=o&&!('onscroll' in window)||'undefined'!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),N=o&&'IntersectionObserver' in window,P=o&&'classList' in document.createElement('p'),F=o&&window.devicePixelRatio>1,ue={elements_selector:'.lazy',container:O||o?document:null,threshold:300,thresholds:null,data_src:'src',data_srcset:'srcset',data_sizes:'sizes',data_bg:'bg',data_bg_hidpi:'bg-hidpi',data_bg_multi:'bg-multi',data_bg_multi_hidpi:'bg-multi-hidpi',data_poster:'poster',class_applied:'applied',class_loading:'loading',class_loaded:'loaded',class_error:'error',class_entered:'entered',class_exited:'exited',unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},W=function(e){return T({},ue,e)},z=function(e,t){var i,n='LazyLoad::Initialized',o=new e(t);try{i=new CustomEvent(n,{detail:{instance:o}})}catch(a){(i=document.createEvent('CustomEvent')).initCustomEvent(n,!1,!1,{instance:o})};window.dispatchEvent(i)},i='src',w='srcset',y='sizes',Q='poster',l='llOriginalAttrs',x='loading',V='loaded',D='applied',k='error',q='native',ce='data-',fe='ll-status',e=function(e,t){return e.getAttribute(ce+t)},d=function(t){return e(t,fe)},a=function(e,t){return function(e,t,i){var n='data-ll-status';null!==i?e.setAttribute(n,i):e.removeAttribute(n)}(e,0,t)},m=function(e){return a(e,null)},M=function(e){return null===d(e)},A=function(e){return d(e)===q},me=[x,V,D,k],n=function(e,t,i,n){e&&(void 0===n?void 0===i?e(t):e(t,i):e(t,i,n))},r=function(e,t){P?e.classList.add(t):e.className+=(e.className?' ':'')+t},t=function(e,t){P?e.classList.remove(t):e.className=e.className.replace(new RegExp('(^|\\s+)'+t+'(\\s+|$)'),' ').replace(/^\s+/,'').replace(/\s+$/,'')},B=function(e){return e.llTempImage},p=function(e,t){if(t){var i=t._observer;i&&i.unobserve(e)}},C=function(e,t){e&&(e.loadingCount+=t)},R=function(e,t){e&&(e.toLoadCount=t)},H=function(e){for(var t,i=[],n=0;t=e.children[n];n+=1)'SOURCE'===t.tagName&&i.push(t);return i},S=function(e,t){var i=e.parentNode;i&&'PICTURE'===i.tagName&&H(i).forEach(t)},G=function(e,t){H(e).forEach(t)},h=[i],U=[i,Q],v=[i,w,y],g=function(e){return!!e[l]},Y=function(e){return e[l]},X=function(e){return delete e[l]},u=function(e,t){if(!g(e)){var i={};t.forEach((function(t){i[t]=e.getAttribute(t)})),e[l]=i}},c=function(e,t){if(g(e)){var i=Y(e);t.forEach((function(t){!function(e,t,i){i?e.setAttribute(t,i):e.removeAttribute(t)}(e,t,i[t])}))}},Z=function(e,t,i){r(e,t.class_loading),a(e,x),i&&(C(i,1),n(t.callback_loading,e,i))},s=function(e,t,i){i&&e.setAttribute(t,i)},ee=function(t,n){s(t,y,e(t,n.data_sizes)),s(t,w,e(t,n.data_srcset)),s(t,i,e(t,n.data_src))},te={IMG:function(e,t){S(e,(function(e){u(e,v),ee(e,t)})),u(e,v),ee(e,t)},IFRAME:function(t,n){u(t,h),s(t,i,e(t,n.data_src))},VIDEO:function(t,n){G(t,(function(t){u(t,h),s(t,i,e(t,n.data_src))})),u(t,U),s(t,Q,e(t,n.data_poster)),s(t,i,e(t,n.data_src)),t.load()}},pe=['IMG','IFRAME','VIDEO'],ie=function(e,t){!t||function(e){return e.loadingCount>0}(t)||function(e){return e.toLoadCount>0}(t)||n(e.callback_finish,t)},ne=function(e,t,i){e.addEventListener(t,i),e.llEvLisnrs[t]=i},he=function(e,t,i){e.removeEventListener(t,i)},E=function(e){return!!e.llEvLisnrs},I=function(e){if(E(e)){var i=e.llEvLisnrs;for(var t in i){var n=i[t];he(e,t,n)};delete e.llEvLisnrs}},oe=function(e,i,n){!function(e){delete e.llTempImage}(e),C(n,-1),function(e){e&&(e.toLoadCount-=1)}(n),t(e,i.class_loading),i.unobserve_completed&&p(e,n)},L=function(e,t,i){var o=B(e)||e;E(o)||function(e,t,i){E(e)||(e.llEvLisnrs={});var n='VIDEO'===e.tagName?'loadeddata':'load';ne(e,n,t),ne(e,'error',i)}(o,(function(s){!function(e,t,i,o){var s=A(t);oe(t,i,o),r(t,i.class_loaded),a(t,V),n(i.callback_loaded,t,o),s||ie(i,o)}(0,e,t,i),I(o)}),(function(s){!function(e,t,i,o){var s=A(t);oe(t,i,o),r(t,i.class_error),a(t,k),n(i.callback_error,t,o),s||ie(i,o)}(0,e,t,i),I(o)}))},ve=function(t,o,s){!function(e){e.llTempImage=document.createElement('IMG')}(t),L(t,o,s),function(e){g(e)||(e[l]={backgroundImage:e.style.backgroundImage})}(t),function(t,n,o){var r=e(t,n.data_bg),s=e(t,n.data_bg_hidpi),a=F&&s?s:r;a&&(t.style.backgroundImage='url("'.concat(a,'")'),B(t).setAttribute(i,a),Z(t,n,o))}(t,o,s),function(t,i,o){var d=e(t,i.data_bg_multi),s=e(t,i.data_bg_multi_hidpi),l=F&&s?s:d;l&&(t.style.backgroundImage=l,function(e,t,i){r(e,t.class_applied),a(e,D),i&&(t.unobserve_completed&&p(e,t),n(t.callback_applied,e,i))}(t,i,o))}(t,o,s)},j=function(e,t,i){!function(e){return pe.indexOf(e.tagName)>-1}(e)?ve(e,t,i):function(e,t,i){L(e,t,i),function(e,t,i){var n=te[e.tagName];n&&(n(e,t),Z(e,t,i))}(e,t,i)}(e,t,i)},ae=function(e){e.removeAttribute(i),e.removeAttribute(w),e.removeAttribute(y)},se=function(e){S(e,(function(e){c(e,v)})),c(e,v)},ge={IMG:se,IFRAME:function(e){c(e,h)},VIDEO:function(e){G(e,(function(e){c(e,h)})),c(e,U),e.load()}},be=function(e,i){(function(e){var t=ge[e.tagName];t?t(e):function(e){if(g(e)){var t=Y(e);e.style.backgroundImage=t.backgroundImage}}(e)})(e),function(e,i){M(e)||A(e)||(t(e,i.class_entered),t(e,i.class_exited),t(e,i.class_applied),t(e,i.class_loading),t(e,i.class_loaded),t(e,i.class_error))}(e,i),m(e),X(e)},we=['IMG','IFRAME','VIDEO'],re=function(e){return e.use_native&&'loading' in HTMLImageElement.prototype},ye=function(e,i,o){e.forEach((function(e){return function(e){return e.isIntersecting||e.intersectionRatio>0}(e)?function(e,i,o,s){var l=function(e){return me.indexOf(d(e))>=0}(e);a(e,'entered'),r(e,o.class_entered),t(e,o.class_exited),function(e,t,i){t.unobserve_entered&&p(e,i)}(e,o,s),n(o.callback_enter,e,i,s),l||j(e,o,s)}(e.target,e,i,o):function(e,i,o,a){M(e)||(r(e,o.class_exited),function(e,i,o,a){o.cancel_on_exit&&function(e){return d(e)===x}(e)&&'IMG'===e.tagName&&(I(e),function(e){S(e,(function(e){ae(e)})),ae(e)}(e),se(e),t(e,o.class_loading),C(a,-1),m(e),n(o.callback_cancel,e,i,a))}(e,i,o,a),n(o.callback_exit,e,i,a))}(e.target,e,i,o)}))},le=function(e){return Array.prototype.slice.call(e)},b=function(e){return e.container.querySelectorAll(e.elements_selector)},xe=function(e){return function(e){return d(e)===k}(e)},de=function(e,t){return function(e){return le(e).filter(M)}(e||b(t))},f=function(e,i){var n=W(e);this._settings=n,this.loadingCount=0,function(e,t){N&&!re(e)&&(t._observer=new IntersectionObserver((function(i){ye(i,e,t)}),function(e){return{root:e.container===document?null:e.container,rootMargin:e.thresholds||e.threshold+'px'}}(e)))}(n,this),function(e,i){o&&window.addEventListener('online',(function(){!function(e,i){var n;(n=b(e),le(n).filter(xe)).forEach((function(i){t(i,e.class_error),m(i)})),i.update()}(e,i)}))}(n,this),this.update(i)};return f.prototype={update:function(e){var n,o,i=this._settings,t=de(e,i);R(this,t.length),!O&&N?re(i)?function(e,t,i){e.forEach((function(e){-1!==we.indexOf(e.tagName)&&function(e,t,i){e.setAttribute('loading','lazy'),L(e,t,i),function(e,t){var i=te[e.tagName];i&&i(e,t)}(e,t),a(e,q)}(e,t,i)})),R(i,0)}(t,i,this):(o=t,function(e){e.disconnect()}(n=this._observer),function(e,t){t.forEach((function(t){e.observe(t)}))}(n,o)):this.loadAll(t)},destroy:function(){this._observer&&this._observer.disconnect(),b(this._settings).forEach((function(e){X(e)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(e){var t=this,i=this._settings;de(e,i).forEach((function(e){p(e,t),j(e,i,t)}))},restoreAll:function(){var e=this._settings;b(e).forEach((function(t){be(t,e)}))}},f.load=function(e,t){var i=W(t);j(e,i)},f.resetStatus=function(e){m(e)},o&&function(e,t){if(t)if(t.length)for(var i,n=0;i=t[n];n+=1)z(e,i);else z(e,t)}(f,window.lazyLoadOptions),f}));if(typeof lazyLoadSetup!=='object')var lazyLoadSetup={elements_selector:'.lazy',data_bg:'background',data_src:'src'};var lazyLoadInstance=new LazyLoad(lazyLoadSetup),kappSettings={};function kappInit(e){e.each(function(){var e=$(this).attr('data-app');if(e=='paste'){}
else if(e=='value'){var s=$(this).attr('data-value');if(s=='sitename'){if(typeof koSiteName!=='undefined')$(this).text(koSiteName)}
else if(s=='year'){$(this).text(new Date().getFullYear())}}
else if(e=='document'){if(typeof documentEditor==='function'){documentEditor($(this))}}
else if(e=='countdown'){e+='_'+Math.random().toString(36).substr(2,9);var o=$(this).attr('data-value');window['kappCountdown_setup'+e]=function(e){if(typeof o!=='undefined'&&o.length>5){if(o!='2022-06-07')var t=o};if(typeof t==='undefined'){const today=new Date();const tomorrow=new Date(today);tomorrow.setDate(tomorrow.getDate()+30);var t=tomorrow.toISOString()};if(t.indexOf('T')>0){t=t.split('T');if(t[1].substr(1,1)==':'){t[1]='0'+t[1]};t=t.join('T')};if(typeof timeLocale!=='undefined'){for(var i in timeLocale){if(!timeLocale.hasOwnProperty(i)){continue};e.setConstant(i,timeLocale[i])}};var n=Tick.count.down(t);n.onupdate=function(t){e.value=t};n.onended=function(){}};var t='';t+='<div class="kelement" id="'+e+'"><!-- (c) https://pqina.nl/flip/ --><div class="p-5 d-flex justify-content-center"><div class="tick" data-did-init="kappCountdown_setup'+e+'"><div data-repeat="true" data-layout="horizontal fit" data-transform="preset(d, h, m, s) -> delay">	<div class="tick-group">		<div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">			<span data-view="flip"></span>		</div>		<span data-key="label" data-view="text" class="tick-label"></span>	</div></div>';if(typeof keditPrepare!=='undefined'){t+='<span class="kelement-app" onclick="koToolbarTabs(\'Widget\',this)"><small>'+langPhrase.editWidget+'</small><a href="javascript:void(null)"><i class="fas fa-cog"></i></a></span>'};t+='</div>';if(typeof window.kappCountdown_setup==='undefined'){window.kappCountdown_setup=1;t+='<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pqina/flip@1.7.7/dist/flip.min.css"><script src="https://cdn.jsdelivr.net/npm/@pqina/flip@1.7.7/dist/flip.min.js"></script>'};t+='</div></div>';$(this).html(t)}
else if(e=='textSlider'){e+='_'+Math.random().toString(36).substr(2,9);kappSettings[e]={};var t='<span class="kelement position-relative" id="'+e+'">';if(typeof keditPrepare!=='undefined'){t+='<span class="kelement-app" onclick="koToolbarTabs(\'Widget\',this)"><small>'+langPhrase.editWidget+'</small><a href="javascript:void(null)"><i class="fas fa-cog"></i></a></span>'};t+='<span class="kedit-rotating-text">';var a=$(this).attr('data-text');a=a.split('|');a.forEach(kappWord=>{t+='<span class="word">'+kappWord+'</span>'});t+='</span></span>';$(this).html(t);var n=document.querySelectorAll('#'+e+' .word');n.forEach(word=>{let letters=word.textContent.split('');word.textContent='';letters.forEach(letter=>{let span=document.createElement('span');span.textContent=letter;span.className='letter';word.append(span)})});let currentWordIndex=0;let maxWordIndex=n.length-1;n[currentWordIndex].style.opacity='1';let rotateText=()=>{let currentWord=n[currentWordIndex];let nextWord=currentWordIndex===maxWordIndex?n[0]:n[currentWordIndex+1];Array.from(currentWord.children).forEach((letter,i)=>{setTimeout(()=>{letter.className='letter out'},i*80)});nextWord.style.opacity='1';Array.from(nextWord.children).forEach((letter,i)=>{letter.className='letter behind';setTimeout(()=>{letter.className='letter in'},340+i*80)});currentWordIndex=currentWordIndex===maxWordIndex?0:currentWordIndex+1};rotateText();setInterval(rotateText,3000)}
else if(e=='instagram'){e+='_'+Math.random().toString(36).substr(2,9);kappSettings[e]={};kappSettings[e].username=$(this).attr('data-username');var t='<div class="kelement position-relative">';if(typeof keditPrepare!=='undefined'){t+='<span class="kelement-app" onclick="koToolbarTabs(\'Widget\',this)"><small>'+langPhrase.editWidget+'</small><a href="javascript:void(null)"><i class="fas fa-cog"></i></a></span>'};t+='<div id="'+e+'">';t+='<div class="p-5 d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>';t+='</div></div>';$(this).html(t);kappSettings[e].margin=$(this).attr('data-margin');if(typeof kappSettings[e].margin!=='undefined'){kappSettings[e].margin=parseFloat(kappSettings[e].margin);if(kappSettings[e].margin!=0&&kappSettings[e].margin!=1){kappSettings[e].margin=1}}
else{kappSettings[e].margin=1};kappSettings[e].items=$(this).attr('data-items');if(typeof kappSettings[e].items==='undefined'||parseFloat(kappSettings[e].items)<1)kappSettings[e].items=6;kappSettings[e].rows=$(this).attr('data-rows');if(typeof kappSettings[e].rows==='undefined'||parseFloat(kappSettings[e].rows)<1)kappSettings[e].rows=1;kappSettings[e].itemsPerRow=Math.round(parseFloat(kappSettings[e].items)/parseFloat(kappSettings[e].rows));setTimeout(function(){if($('#'+e+' .spinner-border').length>0){$('#'+e+' .spinner-border').fadeOut(function(){var t='';if(typeof draggableApps!=='undefined')t='<div style="max-width: 500px;" class="mx-auto mt-3 alert alert-info">Sorry! Instagram no longer allows embeding feeds with this widget.</div>';$(this).replaceWith('<div class="w-100"><a class="fade" id="tmp_'+e+'" href="https://www.instagram.com/'+kappSettings[e].username+'/" style="border:1px solid rgba(0,0,0,0.1);border-radius:7px;color:#000;background:linear-gradient(to bottom,#fff 50%,#f5f6f7);padding:0 10px;width:100%;display:block;max-width:500px;text-align:center;margin:0 auto;box-shadow:5px 5px 30px -20px rgba(0,0,0,0.5);text-decoration:none;font-size:25px;line-height:100px;transition:0.3s all;"><i class="fab fa-instagram"></i> '+kappSettings[e].username+'</a>'+t+'</div>');setTimeout(function(){$('#tmp_'+e).addClass('in')},500)})}},500)}
else if(e=='background'){var t='<span class="kelement">';if(typeof keditPrepare!=='undefined'){t+='<span class="kelement-app kelement-app-color" style="left:0;top:0;" onclick="cApplyTo=$(this).closest(\'.kapp-holder\');koMoreMenuOpen(\'colors\')"><small>'+langPhrase.backgroundColor+'</small><a href="javascript:void(null)"><i class="fas fa-paint-brush"></i></a></span>'};t+='</span>';$(this).html(t)}})};$(function(){kappInit($('.kapp'));if(!$('html').hasClass('inAdminMode')){document.querySelectorAll('a[href^="#"]').forEach(anchor=>{if(!anchor.hasAttribute('data-toggle')&&anchor.getAttribute('href')!='#'){anchor.setAttribute('href',window.location.pathname+window.location.search+anchor.getAttribute('href'))}})}});function koFormNumber(e,t){var n=$(e).attr('data-number-input'),i=parseFloat($('#'+n).val());if(i>0){if(t>0)i=i+1;else i=i-1;if(i<1)i=1}
else i=1;$('#'+n).val(i)};function koPopup(e){if(typeof e!=='object'){$('html,body').removeClass('noScrollbars');$('.koPopup').removeClass('active').ready(function(){setTimeout(function(){$('.koPopup').remove()},500)});return!0};e.id=Math.random().toString(36).substr(2,9);var t='<div class="koPopup"><div class="koLightboxOverlay" onclick="koPopup(0)"></div><div class="koLightboxModal"><div style="min-height:500px;width:700px;max-width:100vw;max-height:90vw;position:relative"><div class="row h-100 g-0 no-gutters">',i='10px';if(typeof e.image!=='undefined'){t+='<div class="d-none d-md-block col-4" style="border-radius:10px 0 0 10px;overflow:hidden"><img src="'+e.image+'" style="object-fit:cover;width:100%;height:100%;"></div>';i='0 10px 10px 0'};t+='<div class="col p-5" style="background:#fff;border-radius:'+i+'">';if(typeof e.customHTML_title!=='undefined')t+=e.customHTML_title;else{if(typeof e.title!=='undefined')t+='<h1>'+e.title+'</h1>'};if(typeof e.customHTML_content!=='undefined')t+=e.customHTML_content;else{if(typeof e.content!=='undefined')t+='<p>'+e.content+'</p>'};if(typeof e.button==='object'){t+='<div class="mt-4">';t+='<a href="'+e.button.link+'" target="';if(typeof e.target==='undefined')t+='_top';else t+=e.target;t+='" class="btn btn-primary">'+e.button.text+'</a>';t+='</div>'};t+='</div></div><a style="position:absolute;top:0;right:0;width:40px;height:40px;text-align:center;line-height:40px;display:block;color:black;opacity:0.5" href="javascript:void(null)" onclick="koPopup(0)"><svg xmlns="http://www.w3.org/2000/svg" width="75%" height="75%" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a></div></div>';$('#website').append(t).ready(function(){setTimeout(function(){$('html,body').addClass('noScrollbars');$('.koPopup').addClass('active')},100)})};function headerBanner_close(){if($('html').hasClass('editingHeaderBanner')){koMenuClose()}
else{$('html').removeClass('ko_ThemeFixed ko_ThemeOn ko_ThemeOnSide');$('#headerMenuBar').remove()}};$(document).ready(function(){$(window).resize(function(){$('.keditLayer_video').each(function(){var e=$(this).outerWidth(),t=$(this).outerHeight(),n='16:9'.split(':'),i=n[0]/n[1],o=e/t>i;$(this).children('iframe').width(o?e:t*i).height(o?e/i:t)})});$(window).trigger('resize')});/*
All Levels Navigational Menu (c)http://www.dynamicdrive.com/dynamicindex1/ddlevelsmenu
Lazy Load (c)https://github.com/verlok/lazyload (MIT License)
jQuery Parallax (c)https://github.com/IanLunn/jQuery-Parallax (MIT License) with changes by:
// Updated: mobirise devs: added support for requestAnimationFrame
	// Adapted from https://gist.github.com/paulirish/1579671 which derived from
	// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
	// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

	// requestAnimationFrame polyfill by Erik Möller.
	// Fixes from Paul Irish, Tino Zijdel, Andrew Mao, Klemen Slavič, Darius Bacon

	// MIT license */