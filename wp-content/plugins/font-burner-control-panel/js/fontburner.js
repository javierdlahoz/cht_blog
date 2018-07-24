/*=:project
  scalable Inman Flash Replacement (sIFR) version 3, revision 382

  =:file
    Copyright: 2006 Mark Wubben.
    Author: Mark Wubben, <http://novemberborn.net/>

  =:history
    * IFR: Shaun Inman
    * sIFR 1: Mike Davidson, Shaun Inman and Tomas Jogin
    * sIFR 2: Mike Davidson, Shaun Inman, Tomas Jogin and Mark Wubben

  =:license
    This software is licensed and provided under the CC-GNU LGPL.
    See <http://creativecommons.org/licenses/LGPL/2.1/>    
*/

var sIFR=new function(){var _1=this;var _2="sIFR-active";var _3="sIFR-unloading";var _4="sIFR-replaced";var _5="sIFR-flash";var _6="sIFR-ignore";var _7="sIFR-alternate";var _8="sIFR-class";var _9="sIFR-layout";var _a="sIFR-fixfocus";var _b="sIFR-dummy";var _c="sIFR-zoomdetect";var _d=6;var _e=126;var _f=8;var _10="SIFR-PREFETCHED";var _11=[];var _12=5;var _13="382";this.isActive=false;this.isEnabled=true;this.preserveSingleWhitespace=false;this.fixWrap=true;this.fixHover=true;this.autoInitialize=true;this.setPrefetchCookie=true;this.cookiePath="/";this.domains=[];this.fromLocal=false;this.forceClear=false;this.forceWidth=true;this.fitExactly=false;this.forceTextTransform=true;this.useDomLoaded=true;this.useStyleCheck=false;this.hasFlashClassSet=false;this.repaintOnResize=true;this.callbacks=[];var _14=0;var _15=false,_16=false;function DomUtil(){var _17="http://www.w3.org/1999/xhtml";this.getBody=function(){return document.getElementsByTagName("body")[0]||null};this.querySelectorAll=function(_18){return window.parseSelector(_18)};this.addClass=function(_19,_1a){if(_1a){_1a.className=((_1a.className||"")==""?"":_1a.className+" ")+_19}};this.removeClass=function(_1b,_1c){if(_1c){_1c.className=_1c.className.replace(new RegExp("(^|\\s)"+_1b+"(\\s|$)"),"").replace(/^\s+|(\s)\s+/g,"$1")}};this.hasClass=function(_1d,_1e){return new RegExp("(^|\\s)"+_1d+"(\\s|$)").test(_1e.className)};this.hasOneOfClassses=function(_1f,_20){for(var i=0;i<_1f.length;i++){if(this.hasClass(_1f[i],_20)){return true}}return false};this.create=function(_22){if(document.createElementNS){return document.createElementNS(_17,_22)}return document.createElement(_22)};this.nodeFromHtml=function(_23){var _24=this.create("div");_24.innerHTML=_23;return _24.firstChild};this.getComputedStyle=function(_25,_26){var _27;if(document.defaultView&&document.defaultView.getComputedStyle){var _28=document.defaultView.getComputedStyle(_25,null);_27=_28?_28[_26]:null}else{if(_25.currentStyle){_27=_25.currentStyle[_26]}}return _27||""};this.getStyleAsInt=function(_29,_2a,_2b){var _2c=this.getComputedStyle(_29,_2a);if(_2b&&!/px$/.test(_2c)){return 0}_2c=parseInt(_2c);return isNaN(_2c)?0:_2c};this.getWidthFromStyle=function(_2d){var _2e=this.getStyleAsInt(_2d,"width",ua.ie);if(_2e==0){var _2f=this.getStyleAsInt(_2d,"paddingRight",true);var _30=this.getStyleAsInt(_2d,"paddingLeft",true);var _31=this.getStyleAsInt(_2d,"borderRightWidth",true);var _32=this.getStyleAsInt(_2d,"borderLeftWidth",true);_2e=_2d.offsetWidth-_30-_2f-_32-_31}return _2e};this.getHeightFromStyle=function(_33){var _34=this.getStyleAsInt(_33,"height",ua.ie);if(_34==0){var _35=this.getStyleAsInt(_33,"paddingTop",true);var _36=this.getStyleAsInt(_33,"paddingBottom",true);var _37=this.getStyleAsInt(_33,"borderTopHeight",true);var _38=this.getStyleAsInt(_33,"borderBottomHeight",true);_34=_33.offsetHeight-_36-_35-_38-_37}return _34};this.blurElement=function(_39){if(ua.gecko){_39.blur();return}var _3a=dom.create("input");_3a.style.width="0px";_3a.style.height="0px";_39.parentNode.appendChild(_3a);_3a.focus();_3a.blur();_3a.parentNode.removeChild(_3a)};this.getDimensions=function(_3c){var _3d=_3c.offsetWidth;var _3e=_3c.offsetHeight;if(_3d==0||_3e==0){for(var i=0;i<_3c.childNodes.length;i++){var _40=_3c.childNodes[i];if(_40.nodeType!=1){continue}_3d=Math.max(_3d,_40.offsetWidth);_3e=Math.max(_3e,_40.offsetHeight)}}return {width:_3d,height:_3e}};this.contentIsLink=function(_41){var _42=false;for(var i=0;i<_41.childNodes.length;i++){var _44=_41.childNodes[i];if(_44.nodeType==3&&!_44.nodeValue.match(/^\s*$/)){return false}else{if(_44.nodeType!=1){continue}}var _45=_44.nodeName.toLowerCase()=="a";if(!_45){return false}else{_42=true}}return _42};var dom=this;this.swf={create:function(_46,_47,id,_49,_4a,src,_4c,_4d,_4e){var obj=_46.object(_47,id,src,_49,_4a);return _46.params(obj,"flashvars",_4c,"wmode",_4d,"bgcolor",_4e,"allowScriptAccess","always","quality","best")},ie:{object:function(_50,id,src,_53,_54){return "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" id=\""+id+"\" width=\""+_53+"\" height=\""+_54+"\" class=\""+_5+"\">"+"<param name=\"movie\" value=\""+src+"\"></param></object>"+"<scr"+"ipt event=FSCommand(info,args) for="+id+">"+id+"_DoFSCommand(info, args);"+"</"+"script>"},params:function(obj){var _56="";for(var i=1;i<arguments.length;i+=2){_56+="<param name=\""+arguments[i]+"\" value=\""+arguments[i+1]+"\"></param>"}return obj.replace(/(<\/object>)/,_56+"$1")},insert:function(_58,_59){_58.innerHTML=_59;return _59}},other:{object:function(_5a,id,src,_5d,_5e){var obj=dom.create("object");var _60=["type","application/x-shockwave-flash","id",id,"name",id,"data",src,"width",_5d,"height",_5e];while(_60.length){obj.setAttribute(_60.shift(),_60.shift())}obj.className=_5;if(!_5a){return {root:obj,obj:obj}}var _61=dom.create("div");_61.className=_a;_61.appendChild(obj);return {root:_61,obj:obj}},params:function(obj){for(var i=1;i<arguments.length;i+=2){if(arguments[i]=="name"){continue}var _64=dom.create("param");_64.setAttribute("name",arguments[i]);_64.setAttribute("value",arguments[i+1]);obj.obj.appendChild(_64)}return obj.root},insert:function(_65,_66){while(_65.firstChild){_65.removeChild(_65.firstChild)}_65.appendChild(_66);return _66.cloneNode(true)}}}}var dom=this.dom=new DomUtil();function UserAgentDetection(){var ua=navigator.userAgent.toLowerCase();var _69=(navigator.product||"").toLowerCase();this.macintosh=ua.indexOf("mac")>-1;this.windows=ua.indexOf("windows")>-1;this.quicktime=false;this.opera=ua.indexOf("opera")>-1;this.konqueror=_69.indexOf("konqueror")>-1;this.ie=false/*@cc_on||true@*/;this.ieSupported=this.ie&&!/ppc|smartphone|iemobile|msie\s5\.5/.test(ua)/*@cc_on&&@_jscript_version>=5.5@*/;this.ieWin=this.ie&&this.windows/*@cc_on&&@_jscript_version>=5.1@*/;this.windows=this.windows&&(!this.ie||this.ieWin);this.ieMac=this.ie&&this.macintosh/*@cc_on&&@_jscript_version<5.1@*/;this.macintosh=this.macintosh&&(!this.ie||this.ieMac);this.safari=ua.indexOf("safari")>-1;this.webkit=ua.indexOf("applewebkit")>-1&&!this.konqueror;this.khtml=this.webkit||this.konqueror;this.gecko=!this.webkit&&_69=="gecko";this.ieVersion=this.ie&&/.*msie\s(\d\.\d)/.exec(ua)?parseFloat(RegExp.$1):0;this.operaVersion=this.opera&&/.*opera(\s|\/)(\d+\.\d+)/.exec(ua)?parseFloat(RegExp.$2):0;this.webkitVersion=this.webkit&&/.*applewebkit\/(\d+).*/.exec(ua)?parseFloat(RegExp.$1):0;this.geckoBuildDate=this.gecko&&/.*gecko\/(\d{8}).*/.exec(ua)?parseFloat(RegExp.$1):0;this.konquerorMajor=this.konqueror&&/.*konqueror\/(\d).*/.exec(ua)?parseFloat(RegExp.$1):0;this.konquerorMinor=this.konqueror&&/.*khtml\/\d\.(\d).*/.exec(ua)?parseFloat(RegExp.$1):0;this.konquerorSmall=this.konqueror&&/.*khtml\/\d\.\d\.(\d).*/.exec(ua)?parseFloat(RegExp.$1):0;this.flashVersion=0;if(this.ieWin){var axo;var _6b=false;try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7")}catch(e){try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");this.flashVersion=6;axo.AllowScriptAccess="always"}catch(e){_6b=this.flashVersion==6}if(!_6b){try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash")}catch(e){}}}if(!_6b&&axo){this.flashVersion=parseFloat(/([\d,?]+)/.exec(axo.GetVariable("$version"))[1].replace(/,/g,"."))}}else{if(navigator.plugins&&navigator.plugins["Shockwave Flash"]){var _6c=navigator.plugins["Shockwave Flash"];this.flashVersion=parseFloat(/(\d+\.?\d*)/.exec(_6c.description)[1]);var i=0;while(this.flashVersion>=_f&&i<navigator.mimeTypes.length){var _6e=navigator.mimeTypes[i];if(_6e.type=="application/x-shockwave-flash"&&_6e.enabledPlugin.description.toLowerCase().indexOf("quicktime")>-1){this.flashVersion=0;this.quicktime=true}i++}}}this.flash=this.flashVersion>=_f;this.transparencySupport=this.macintosh||this.windows;this.computedStyleSupport=this.ie||document.defaultView&&document.defaultView.getComputedStyle&&(!this.gecko||this.geckoBuildDate>=20030624);this.requiresPrefetch=this.ieWin||this.khtml;this.fixFocus=this.gecko&&this.windows&&this.geckoBuildDate>20061206;this.nativeDomLoaded=this.gecko||this.webkit&&this.webkitVersion>=525||this.konqueror&&this.konquerorMajor>3||this.opera;this.mustCheckStyle=this.khtml||this.opera;this.forcePageLoad=this.webkit&&this.webkit<523;this.properDocument=typeof (document.location)=="object";this.supported=this.flash&&this.properDocument&&(!this.ie||this.ieSupported)&&(!this.opera)&&(!this.webkit||this.webkitVersion>=412)&&(!this.konqueror)&&this.computedStyleSupport&&(!this.gecko||this.geckoBuildDate>20040804)}var ua=this.ua=new UserAgentDetection();function Util(){var _70={leading:true,"margin-left":true,"margin-right":true,"text-indent":true};var _71=" ";function capitalize($){return $.toUpperCase()}this.normalize=function(str){if(_1.preserveSingleWhitespace){return str.replace(/\s/g,_71)}return str.replace(/(\n|\r)+/g,_71).replace(/(\s)\s+/g,"$1").replace(/\xA0/,_71)};this.textTransform=function(_74,str){switch(_74){case "uppercase":str=str.toUpperCase();break;case "lowercase":str=str.toLowerCase();break;case "capitalize":var _76=str;str=str.replace(/^\w|\s\w/g,capitalize);if(str.indexOf("function capitalize")!=-1){var _77=_76.replace(/(^|\s)(\w)/g,"$1$1$2$2").split(/^\w|\s\w/g);str="";for(var i=0;i<_77.length;i++){str+=_77[i].charAt(0).toUpperCase()+_77[i].substring(1)}}break}return str};this.toHexString=function(str){if(typeof (str)!="string"||!str.charAt(0)=="#"||str.length!=4&&str.length!=7){return str}str=str.replace(/#/,"");if(str.length==3){str=str.replace(/(.)(.)(.)/,"$1$1$2$2$3$3")}return "0x"+str};this.toJson=function(obj){var _7b="";switch(typeof (obj)){case "string":_7b="\""+obj+"\"";break;case "number":case "boolean":_7b=obj.toString();break;case "object":_7b=[];for(var _7c in obj){if(obj[_7c]==Object.prototype[_7c]){continue}_7b.push("\""+_7c+"\":"+util.toJson(obj[_7c]))}_7b="{"+_7b.join(",")+"}";break}return _7b};this.convertCssArg=function(arg){if(!arg){return {}}if(typeof (arg)=="object"){if(arg.constructor==Array){arg=arg.join("")}else{return arg}}var obj={};var _7f=arg.split("}");for(var i=0;i<_7f.length;i++){var $=_7f[i].match(/([^\s{]+)\s*\{(.+)\s*;?\s*/);if(!$||$.length!=3){continue}if(!obj[$[1]]){obj[$[1]]={}}var _82=$[2].split(";");for(var j=0;j<_82.length;j++){var $2=_82[j].match(/\s*([^:\s]+)\s*\:\s*([^;]+)/);if(!$2||$2.length!=3){continue}obj[$[1]][$2[1]]=$2[2].replace(/\s+$/,"")}}return obj};this.extractFromCss=function(css,_86,_87,_88){var _89=null;if(css&&css[_86]&&css[_86][_87]){_89=css[_86][_87];if(_88){delete css[_86][_87]}}return _89};this.cssToString=function(arg){var css=[];for(var _8c in arg){var _8d=arg[_8c];if(_8d==Object.prototype[_8c]){continue}css.push(_8c,"{");for(var _8e in _8d){if(_8d[_8e]==Object.prototype[_8e]){continue}var _8f=_8d[_8e];if(_70[_8e]){_8f=parseInt(_8f,10)}css.push(_8e,":",_8f,";")}css.push("}")}return css.join("")};this.escape=function(str){return escape(str).replace(/\+/g,"%2B")};this.copyProperties=function(_91,to){for(var _93 in _91){if(to[_93]===undefined){to[_93]=_91[_93]}}return to};this.domain=function(){var _94="";try{_94=document.domain}catch(e){}return _94};this.domainMatches=function(_95,_96){if(_96=="*"||_96==_95){return true}var _97=_96.lastIndexOf("*");if(_97>-1){_96=_96.substr(_97+1);var _98=_95.lastIndexOf(_96);if(_98>-1&&(_98+_96.length)==_95.length){return true}}return false};this.uriEncode=function(s){return encodeURI(decodeURIComponent(s))}}var _9a=this.util=new Util();var _9b={};function FragmentIdentifier(){this.fix=true;var _9c;this.cache=function(){_9c=document.title};function doFix(){document.title=_9c}this.restore=function(){if(this.fix){setTimeout(doFix,0)}}}_9b.fragmentIdentifier=new FragmentIdentifier();function PageLoad(){var _9d=null;function pollLoad(){try{if(ua.ie||document.readyState!="loaded"&&document.readyState!="complete"){document.documentElement.doScroll("left")}}catch(e){return setTimeout(pollLoad,10)}afterDomLoad()}function afterDomLoad(){if(_1.useStyleCheck){checkStyle()}else{if(!ua.mustCheckStyle){fire(null,true)}}}function checkStyle(){_9d=dom.create("div");_9d.className=_b;dom.getBody().appendChild(_9d);pollStyle()}function pollStyle(){if(dom.getComputedStyle(_9d,"marginLeft")=="42px"){afterStyle()}else{setTimeout(pollStyle,10)}}function afterStyle(){if(_9d&&_9d.parentNode){_9d.parentNode.removeChild(_9d)}_9d=null;fire(null,true)}function fire(evt,_9f){_1.initialize(_9f);if(evt&&evt.type=="load"){if(document.removeEventListener){document.removeEventListener("DOMContentLoaded",fire,false)}if(window.removeEventListener){window.removeEventListener("load",fire,false)}}}this.attach=function(){if(window.addEventListener){window.addEventListener("load",fire,false)}else{window.attachEvent("onload",fire)}if(!_1.useDomLoaded||ua.forcePageLoad||ua.ie&&window.top!=window){return}if(ua.nativeDomLoaded){document.addEventListener("DOMContentLoaded",afterDomLoad,false)}else{if(ua.ie||ua.khtml){pollLoad()}}}}_9b.pageLoad=new PageLoad();this.hacks={fragmentIdentifier:_9b.fragmentIdentifier};function Errors(){}this.errors=new Errors();function FlashInteractor(id,_a1,_a2,_a3){this.id=id;this.vars=_a1;this._events=_a3;this._forceWidth=_a2;this._firedReplacementEvent=!(_a3.onReplacement!=null);this._rescale=false;this.html=null}FlashInteractor.prototype.getFlashElement=function(){return document.getElementById(this.id)};FlashInteractor.prototype.available=function(){var _a4=this.getFlashElement();return _a4&&_a4.parentNode};FlashInteractor.prototype.handle=function(_a5,arg){if(!this.available()){return}switch(/(FSCommand\:)?(.+)/.exec(_a5)[2]){case "init":this._rescale=true;break;case "resize":var _a7=this.getFlashElement();var $=arg.split(/\:|,/);_a7.setAttribute($[0],$[1]);this.updateVars("renderheight",$[1]);this.storeSize($[0],$[1]);if($.length>2){_a7.style[$[2]]=$[3]+"px";this.storeSize($[2],$[3])}if(ua.khtml){var _a9=_a7.offsetHeight}if(!this._firedReplacementEvent){this._events.onReplacement(this);this._firedReplacementEvent=true}if(this._rescale){this._rescale=false;var cb=this;setTimeout(function(){cb.call("scale")},0)}break;case "resetmovie":this.resetMovie();break;case "blur":dom.blurElement(this.getFlashElement());break;case "event":if(this._events[arg]){this._events[arg](this)}break;default:if(this.debugHandler&&/(FSCommand\:)?debug/.test(_a5)){this.debugHandler(_a5,arg)}}};FlashInteractor.prototype.call=function(_ab,_ac){if(!this.available()){return false}var _ad=this.getFlashElement();try{_ad.SetVariable("callbackType",_ab);_ad.SetVariable("callbackValue",_ac);_ad.SetVariable("callbackTrigger",true)}catch(e){return false}return true};FlashInteractor.prototype.replaceText=function(_ae,_af){var _b0=_9a.escape(_ae);if(this.call("replacetext",_b0)){this.updateVars("content",_b0);var _b1=this.getAlternate();if(_af){while(_b1.firstChild){_b1.removeChild(_b1.firstChild)}for(var i=0;i<_af.length;i++){_b1.appendChild(_af[i])}}else{try{_b1.innerHTML=_ae}catch(e){}}return true}return false};FlashInteractor.prototype.updateVars=function(_b3,_b4){for(var i=0;i<this.vars.length;i++){if(this.vars[i].split("=")[0]==_b3){this.vars[i]=_b3+"="+_b4;break}}if(!ua.ie){this.injectVars(this.getFlashElement());this.injectVars(this.html)}};FlashInteractor.prototype.storeSize=function(_b6,_b7){if(ua.ie){this.html=this.html.replace(_b6=="height"?/(height)="\d+"/:/(width)="\d+"/,"$1=\""+_b7+"\"");this.updateVars(_b6,_b7)}else{this.html.setAttribute(_b6,_b7);this.updateVars(_b6,_b7)}};FlashInteractor.prototype.injectVars=function(_b8){var _b9=_b8.getElementsByTagName("param");for(var i=0;i<_b9.length;i++){if(_b9[i].getAttribute("name")=="flashvars"){_b9[i].setAttribute("value",encodeVars(this.vars));break}}};FlashInteractor.prototype.resetMovie=function(){if(!this.available()){return}var _bb=this.getFlashElement();var _bc=_bb.parentNode;if(ua.ie){this.html=this.html.replace(/(flashvars(=|\"\svalue=)\")[^\"]+/,"$1"+encodeVars(this.vars));_bc.replaceChild(dom.nodeFromHtml(this.html),_bb)}else{_bc.replaceChild(this.html.cloneNode(true),_bb)}};FlashInteractor.prototype.resize=function(){if(!this.available()){return}var _bd=this.getFlashElement();var _be=_bd.offsetWidth;if(_be==0){return}var _bf=_bd.getAttribute("width");var _c0=_bd.getAttribute("height");var _c1=this.getAncestor();var _c2=dom.getHeightFromStyle(_c1);_bd.style.width="0px";_bd.style.height="0px";_c1.style.minHeight=_c2+"px";var _c3=this.getAlternate().childNodes;var _c4=[];for(var i=0;i<_c3.length;i++){var _c6=_c3[i].cloneNode(true);_c4.push(_c6);_c1.appendChild(_c6)}var _c7=dom.getWidthFromStyle(_c1);for(var i=0;i<_c4.length;i++){_c1.removeChild(_c4[i])}_bd.style.width=_bd.style.height=_c1.style.minHeight="";_bd.setAttribute("width",this._forceWidth?_c7:_bf);_bd.setAttribute("height",_c0);if(_c7!=_be){if(this._forceWidth){this.storeSize("width",_c7)}this.call("resize",_c7)}};FlashInteractor.prototype.changeCSS=function(css){css=_9a.escape(_9a.cssToString(_9a.convertCssArg(css)));this.updateVars("css",css);return this.call("changecss",css)};FlashInteractor.prototype.getAlternate=function(){return document.getElementById(this.id+"_alternate")};FlashInteractor.prototype.getAncestor=function(){var _c9=this.getFlashElement().parentNode;return !dom.hasClass(_a,_c9)?_c9:_c9.parentNode};var _ca={kwargs:[],replaceAll:function(_cb){for(var i=0;i<this.kwargs.length;i++){_1.replace(this.kwargs[i])}if(!_cb){this.kwargs=[]}}};function isValidDomain(){if(_1.domains.length==0){return true}var _cd=_9a.domain();for(var i=0;i<_1.domains.length;i++){var _cf=_1.domains[i];if(_9a.domainMatches(_cd,_cf)){return true}}return false}function isFile(){if(!_1.fromLocal&&document.location.protocol=="file:"){if(_1.debug){_1.errors.fire("isFile")}return true}return false}function resize(evt){var _d1=resize.viewport;resize.viewport={width:window.innerWidth||document.documentElement.clientWidth||dom.getBody().clientWidth,height:window.innerHeight||document.documentElement.clientHeight||dom.getBody().clientHeight};if(_d1&&resize.viewport.width==_d1.width&&resize.viewport.height==_d1.height){return}if(resize.timer){clearTimeout(resize.timer)}resize.timer=setTimeout(function(){delete resize.timer;for(var i=0;i<_1.callbacks.length;i++){_1.callbacks[i].resize()}},200)}this.activate=function(){if(!ua.supported||!this.isEnabled||this.isActive||!isValidDomain()||isFile()){return}if(arguments.length>0){this.prefetch.apply(this,arguments)}this.isActive=true;this.setFlashClass();_9b.fragmentIdentifier.fix=ua.ieWin&&_9b.fragmentIdentifier.fix&&window.location.hash!="";if(_9b.fragmentIdentifier.fix){_9b.fragmentIdentifier.cache()}if(!this.autoInitialize){return}_9b.pageLoad.attach();if(ua.ie){window.attachEvent("onunload",function(){dom.addClass(_3,document.documentElement)})}};this.setFlashClass=function(){if(this.hasFlashClassSet){return}dom.addClass(_2,dom.getBody()||document.documentElement);this.hasFlashClassSet=true};this.removeFlashClass=function(){if(!this.hasFlashClassSet){return}dom.removeClass(_2,dom.getBody());dom.removeClass(_2,document.documentElement);this.hasFlashClassSet=false};this.initialize=function(_d3){if(!this.isActive||!this.isEnabled){return}if(_16){if(!_d3){_ca.replaceAll(false)}return}_16=true;_ca.replaceAll(_d3);if(_1.repaintOnResize){if(window.addEventListener){window.addEventListener("resize",resize,false)}else{window.attachEvent("onresize",resize)}}clearPrefetch()};function getSource(src){if(typeof (src)!="string"){if(src.src){src=src.src}if(typeof (src)!="string"){var _d5=[];for(var _d6 in src){if(src[_d6]!=Object.prototype[_d6]){_d5.push(_d6)}}_d5.sort().reverse();var _d7="";var i=-1;while(!_d7&&++i<_d5.length){if(parseFloat(_d5[i])<=ua.flashVersion){_d7=src[_d5[i]]}}src=_d7}}if(!src&&_1.debug){_1.errors.fire("getSource")}if(ua.ie&&src.charAt(0)=="/"){src=window.location.toString().replace(/([^:]+)(:\/?\/?)([^\/]+).*/,"$1$2$3")+src}return src}this.prefetch=function(){if((!ua.requiresPrefetch&&!this.isActive)||!ua.supported||!this.isEnabled||!isValidDomain()){return}if(this.setPrefetchCookie&&new RegExp(";?"+_10+"=true;?").test(document.cookie)){return}try{_15=true;if(ua.ieWin){prefetchIexplore(arguments)}else{prefetchLight(arguments)}if(this.setPrefetchCookie){document.cookie=_10+"=true;path="+this.cookiePath}}catch(e){if(_1.debug){throw e}}};function prefetchIexplore(_d9){for(var i=0;i<_d9.length;i++){document.write("<script defer type=\"sifr/prefetch\" src=\""+getSource(_d9[i])+"\"></script>")}}function prefetchLight(_db){for(var i=0;i<_db.length;i++){new Image().src=getSource(_db[i])}}function clearPrefetch(){if(!ua.ieWin||!_15){return}try{var _dd=document.getElementsByTagName("script");for(var i=_dd.length-1;i>=0;i--){var _df=_dd[i];if(_df.type=="sifr/prefetch"){_df.parentNode.removeChild(_df)}}}catch(e){}}function getRatio(_e0,_e1){for(var i=0;i<_e1.length;i+=2){if(_e0<=_e1[i]){return _e1[i+1]}}return _e1[_e1.length-1]||1}function getFilters(obj){var _e4=[];for(var _e5 in obj){if(obj[_e5]==Object.prototype[_e5]){continue}var _e6=obj[_e5];_e5=[_e5.replace(/filter/i,"")+"Filter"];for(var _e7 in _e6){if(_e6[_e7]==Object.prototype[_e7]){continue}_e5.push(_e7+":"+_9a.escape(_9a.toJson(_9a.toHexString(_e6[_e7]))))}_e4.push(_e5.join(","))}return _9a.escape(_e4.join(";"))}function calculate(_e8){var _e9,_ea;if(!ua.ie){_e9=dom.getStyleAsInt(_e8,"lineHeight");_ea=Math.floor(dom.getStyleAsInt(_e8,"height")/_e9)}else{if(ua.ie){var _eb=dom.getComputedStyle(_e8,"fontSize");if(_eb.indexOf("px")>0){_e9=parseInt(_eb)}else{var _ec=_e8.innerHTML;_e8.style.visibility="visible";_e8.style.overflow="visible";_e8.style.position="static";_e8.style.zoom="normal";_e8.style.writingMode="lr-tb";_e8.style.width=_e8.style.height="auto";_e8.style.maxWidth=_e8.style.maxHeight=_e8.style.styleFloat="none";var _ed=_e8;var _ee=_e8.currentStyle.hasLayout;if(_ee){_e8.innerHTML="<div class=\""+_9+"\">X<br />X<br />X</div>";_ed=_e8.firstChild}else{_e8.innerHTML="X<br />X<br />X"}var _ef=_ed.getClientRects();_e9=_ef[1].bottom-_ef[1].top;_e9=Math.ceil(_e9*0.8);if(_ee){_e8.innerHTML="<div class=\""+_9+"\">"+_ec+"</div>";_ed=_e8.firstChild}else{_e8.innerHTML=_ec}_ef=_ed.getClientRects();_ea=_ef.length;if(_ee){_e8.innerHTML=_ec}_e8.style.visibility=_e8.style.width=_e8.style.height=_e8.style.maxWidth=_e8.style.maxHeight=_e8.style.overflow=_e8.style.styleFloat=_e8.style.position=_e8.style.zoom=_e8.style.writingMode=""}}}return {lineHeight:_e9,lines:_ea}}this.replace=function(_f0,_f1){if(!ua.supported){return}if(_f1){_f0=_9a.copyProperties(_f0,_f1)}if(!_16){return _ca.kwargs.push(_f0)}if(_1.onReplacementStart){_1.onReplacementStart(_f0)}var _f2=_f0.elements;if(!_f2){_f2=dom.querySelectorAll(_f0.selector)}if(_f2.length==0){return}var src=getSource(_f0.src);var css=_9a.convertCssArg(_f0.css);var _f5=getFilters(_f0.filters);var _f6=(_f0.forceClear==null)?_1.forceClear:_f0.forceClear;var _f7=_f0.forceSingleLine===true;var _f8=_f7||((_f0.fitExactly==null)?_1.fitExactly:_f0.fitExactly);var _f9=_f8||(_f0.forceWidth==null?_1.forceWidth:_f0.forceWidth);var _fa=!!(_f0.preventWrap&&!_f7);var _fb=parseInt(_9a.extractFromCss(css,".sIFR-root","leading"))||0;var _fc=_9a.extractFromCss(css,".sIFR-root","font-size",true)||0;var _fd=_9a.extractFromCss(css,".sIFR-root","background-color",true)||"#FFFFFF";var _fe=_9a.extractFromCss(css,".sIFR-root","kerning",true)||"";var _ff=_f0.gridFitType||_9a.extractFromCss(css,".sIFR-root","text-align")=="right"?"subpixel":"pixel";var _100=_1.forceTextTransform?_9a.extractFromCss(css,".sIFR-root","text-transform",true)||"none":"none";var _101=_9a.extractFromCss(css,".sIFR-root","opacity",true)||"100";var _102=_9a.extractFromCss(css,".sIFR-root","cursor",true)||"default";var _103=_f0.pixelFont||false;var _104=_f0.ratios||_11;var _105=parseInt(_f0.tuneHeight)||0;var _106=!!_f0.onRelease||!!_f0.onRollOver||!!_f0.onRollOut;if(parseInt(_fc).toString()!=_fc&&_fc.indexOf("px")==-1){_fc=0}else{_fc=parseInt(_fc)}if(parseFloat(_101)<1){_101=100*parseFloat(_101)}var _107="";if(_f8){_9a.extractFromCss(css,".sIFR-root","text-align",true)}if(!_f0.modifyCss){_107=_9a.cssToString(css)}var _108=_f0.wmode||"";if(!_108){if(_f0.transparent){_108="transparent"}else{if(_f0.opaque){_108="opaque"}}}if(_108=="transparent"){if(!ua.transparencySupport){_108="opaque"}else{_fd="transparent"}}for(var i=0;i<_f2.length;i++){var node=_f2[i];if(dom.hasOneOfClassses([_4,_6,_7],node)){continue}var _10b=dom.getDimensions(node);var _10c=_10b.height;var _10d=_10b.width;var _10e=dom.getComputedStyle(node,"display");if(!_10c||!_10d||_10e==null||_10e=="none"){continue}if(_f6&&ua.gecko){node.style.clear="both"}var html=null;if(_1.fixWrap&&ua.ie&&_10e=="block"){html=node.innerHTML;node.innerHTML="X"}_10d=dom.getWidthFromStyle(node);if(html&&_1.fixWrap&&ua.ie){node.innerHTML=html}var _110,_111;if(!_fc){var _112=calculate(node);_110=Math.min(_e,Math.max(_d,_112.lineHeight));if(_103){_110=Math.max(8,8*Math.round(_110/8))}_111=_112.lines;if(isNaN(_111)||!isFinite(_111)||_111==0){_111=1}if(_111>1&&_fb){_10c+=Math.round((_111-1)*_fb)}}else{_110=_fc;_111=1}_10c=Math.round(_111*_110);if(_f6&&ua.gecko){node.style.clear=""}var _113=dom.create("span");_113.className=_7;var _114=node.cloneNode(true);node.parentNode.appendChild(_114);for(var j=0,l=_114.childNodes.length;j<l;j++){_113.appendChild(_114.childNodes[j].cloneNode(true))}if(_f0.modifyContent){_f0.modifyContent(_114,_f0.selector)}if(_f0.modifyCss){_107=_f0.modifyCss(css,_114,_f0.selector)}var _117=_1.fixHover&&dom.contentIsLink(_114);var _118=handleContent(_114,_100,_f0.uriEncode);_114.parentNode.removeChild(_114);if(_f0.modifyContentString){_118.text=_f0.modifyContentString(_118.text,_f0.selector)}if(_118.text==""){continue}var _119=Math.round(_111*getRatio(_110,_104)*_110)+_12+_105;var _11a=_f9?_10d:"100%";var vars=["content="+_9a.escape(_118.text),"antialiastype="+(_f0.antiAliasType||""),"width="+_10d,"height="+_10c,"renderheight="+_119,"fitexactly="+_f8,"tunewidth="+(_f0.tuneWidth||0),"tuneheight="+_105,"offsetleft="+(_f0.offsetLeft||""),"offsettop="+(_f0.offsetTop||""),"thickness="+(_f0.thickness||""),"sharpness="+(_f0.sharpness||""),"kerning="+_fe,"gridfittype="+_ff,"flashfilters="+_f5,"opacity="+_101,"blendmode="+(_f0.blendMode||""),"size="+_110,"css="+_9a.escape(_107),"selectable="+(_f0.selectable==null?"true":_f0.selectable),"fixhover="+_117,"preventwrap="+_fa,"forcesingleline="+_f7,"link="+_9a.escape(_118.primaryLink[0]||""),"target="+_9a.escape(_118.primaryLink[1]||""),"events="+_106,"cursor="+_102,"version="+_13];var _11c=encodeVars(vars);var _11d="sIFR_callback_"+_14++;var _11e=new FlashInteractor(_11d,vars,_f9,{onReplacement:_f0.onReplacement,onRollOver:_f0.onRollOver,onRollOut:_f0.onRollOut,onRelease:_f0.onRelease});window[_11d+"_DoFSCommand"]=(function(_11f){return function(info,arg){_11f.handle(info,arg)}})(_11e);_113.setAttribute("id",_11d+"_alternate");var _122=ua.ie?dom.swf.ie:dom.swf.other;var _123=dom.swf.create(_122,ua.fixFocus&&_f0.fixFocus,_11d,_11a,_119,src,_11c,_108,_fd);_11e.html=_122.insert(node,_123);_1.callbacks.push(_11e);if(_f0.selector){if(!_1.callbacks[_f0.selector]){_1.callbacks[_f0.selector]=[_11e]}else{_1.callbacks[_f0.selector].push(_11e)}}node.appendChild(_113);dom.addClass(_4,node)}_9b.fragmentIdentifier.restore()};this.getCallbackByFlashElement=function(node){for(var i=0;i<_1.callbacks.length;i++){if(_1.callbacks[i].id==node.getAttribute("id")){return _1.callbacks[i]}}};this.redraw=function(){for(var i=0;i<_1.callbacks.length;i++){_1.callbacks[i].resetMovie()}};function encodeVars(vars){return vars.join("&").replace(/%/g,"%25")}function handleContent(_128,_129,_12a){_12a=_12a||_9a.uriEncode;var _12b=[],_12c=[],_12d=[];var _12e=_128.childNodes;var i=0;while(i<_12e.length){var node=_12e[i];if(node.nodeType==3){var text=_9a.normalize(node.nodeValue);text=_9a.textTransform(_129,text);text=text.replace(/</g,"&lt;");_12c.push(text)}if(node.nodeType==1){var _132=[];var _133=node.nodeName.toLowerCase();var _134=node.className||"";if(/\s+/.test(_134)){if(_134.indexOf(_8)>-1){_134=_134.match("(\\s|^)"+_8+"-([^\\s$]*)(\\s|$)")[2]}else{_134=_134.match(/^([^\s]+)/)[1]}}if(_134!=""){_132.push("class=\""+_134+"\"")}if(_133=="a"){var href=_12a(node.getAttribute("href")||"");var _136=node.getAttribute("target")||"";_132.push("href=\""+href+"\"","target=\""+_136+"\"");if(_12d.length==0){_12d=[href,_136]}}_12c.push("<"+_133+(_132.length>0?" ":"")+_132.join(" ")+">");if(node.hasChildNodes()){_12b.push(i);i=0;_12e=node.childNodes;continue}else{if(!/^(br|img)$/i.test(node.nodeName)){_12c.push("</",node.nodeName.toLowerCase(),">")}}}if(_12b.length>0&&!node.nextSibling){do{i=_12b.pop();_12e=node.parentNode.parentNode.childNodes;node=_12e[i];if(node){_12c.push("</",node.nodeName.toLowerCase(),">")}}while(i==_12e.length-1&&_12b.length>0)}i++}return {text:_12c.join("").replace(/\n|\r/g,""),primaryLink:_12d}}};
var parseSelector=(function(){var _137=/\s*,\s*/;var _138=/\s*([\s>+~(),]|^|$)\s*/g;var _139=/([\s>+~,]|[^(]\+|^)([#.:@])/g;var _13a=/^[^\s>+~]/;var _13b=/[\s#.:>+~()@]|[^\s#.:>+~()@]+/g;function parseSelector(_13c,node){node=node||document.documentElement;var _13e=_13c.split(_137),_13f=[];for(var i=0;i<_13e.length;i++){var _141=[node],_142=toStream(_13e[i]);for(var j=0;j<_142.length;){var _144=_142[j++],_145=_142[j++],args="";if(_142[j]=="("){while(_142[j++]!=")"&&j<_142.length){args+=_142[j]}args=args.slice(0,-1)}_141=select(_141,_144,_145,args)}_13f=_13f.concat(_141)}return _13f}function toStream(_147){var _148=_147.replace(_138,"$1").replace(_139,"$1*$2");if(_13a.test(_148)){_148=" "+_148}return _148.match(_13b)||[]}function select(_149,_14a,_14b,args){return (parseSelector.selectors[_14a])?parseSelector.selectors[_14a](_149,_14b,args):[]}var util={toArray:function(_14e){var a=[];for(var i=0;i<_14e.length;i++){a.push(_14e[i])}return a}};var dom={isTag:function(node,tag){return (tag=="*")||(tag.toLowerCase()==node.nodeName.toLowerCase())},previousSiblingElement:function(node){do{node=node.previousSibling}while(node&&node.nodeType!=1);return node},nextSiblingElement:function(node){do{node=node.nextSibling}while(node&&node.nodeType!=1);return node},hasClass:function(name,node){return (node.className||"").match("(^|\\s)"+name+"(\\s|$)")},getByTag:function(tag,node){return node.getElementsByTagName(tag)}};var _15a={"#":function(_15b,_15c){for(var i=0;i<_15b.length;i++){if(_15b[i].getAttribute("id")==_15c){return [_15b[i]]}}return []}," ":function(_15e,_15f){var _160=[];for(var i=0;i<_15e.length;i++){_160=_160.concat(util.toArray(dom.getByTag(_15f,_15e[i])))}return _160},">":function(_162,_163){var _164=[];for(var i=0,node;i<_162.length;i++){node=_162[i];for(var j=0,_168;j<node.childNodes.length;j++){_168=node.childNodes[j];if(_168.nodeType==1&&dom.isTag(_168,_163)){_164.push(_168)}}}return _164},".":function(_169,_16a){var _16b=[];for(var i=0,node;i<_169.length;i++){node=_169[i];if(dom.hasClass([_16a],node)){_16b.push(node)}}return _16b},":":function(_16e,_16f,args){return (parseSelector.pseudoClasses[_16f])?parseSelector.pseudoClasses[_16f](_16e,args):[]}};parseSelector.selectors=_15a;parseSelector.pseudoClasses={};parseSelector.util=util;parseSelector.dom=dom;return parseSelector})();