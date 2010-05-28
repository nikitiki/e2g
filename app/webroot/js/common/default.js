//
var IE = navigator.appName.indexOf("Microsoft Internet Explorer",0) != -1;

flag = false;

function getAnchorPos(elementID){
//
var objnew = new Object();
	if(document.getElementById){
		var obj = document.getElementById(elementID);
		objnew.x = obj.offsetLeft;
		objnew.y = obj.offsetTop;
		while((obj = obj.offsetParent) != null){
			objnew.x += obj.offsetLeft;
			objnew.y += obj.offsetTop;
		}
	}
	else if(document.all){
	var obj = document.all(elementID);
	objnew.x = obj.offsetLeft;
	objnew.y = obj.offsetTop;
	while((obj = obj.setParent) != null){
			objnew.x += obj.offsetLeft;
			objnew.y += obj.offsetTop;
		}
	}
	else if(domument.layers){
		objnew = document.anchors[elementID].x;
		objnew = document.anchors[elementID].y;
	}
	else{
		objnew .x = 0;
		objnew.y = 0;
	}
	return objnew;
}

function goToAnchor(elementID){
	if((getAnchorPos(elementID).x >=0 || getAnchorPos(elementID).y >=0)){
		pageScroll(0,getAnchorPos(elementID).y,10);
		}
	else{
		flag = true;
	}
}

function getInnerSize(){
//
var obj = new Object();
	if(document.all || (document.getElementById && IE)){
	obj.width = document.body.clientWidth;
	obj.height = document.body.clientHeight;
	}
	else if(document.layers || document.getElementById){
	obj.width = window.innerWidth;
	obj.height = window.innerHeight;
	}
	return obj;
}

function getScrollLeft(){
//
	if(IE){
		return document.body.scrollLeft;
	}
	else if(window.pageXOffset){
	return window.pageXOffset;
	}
	else{
	return 0;
	}
}

function getScrollTop(){
//
	if(IE){
		return document.body.scrollTop;
	}
	else if(window.pageYOffset){
	return window.pageYOffset;
	}
	else{
	return 0;
	}
}

var timeID;
function pageScroll(endX,endY,frms,cuX,cuY){
//
	if(timeID){
	clearTimeout(timeID);
	}
	if(endX < 0){
		endX = 0;
	}
	if(endY < 0){
	endY = 0;
	}
	if(!cuX){
	cuX = getScrollLeft();
	}
	if(!cuY){
	cuY = getScrollTop();
	}
	if(endY > cuY && endY > (getAnchorPos('end').y) - getInnerSize().height) {
	endY = (getAnchorPos('end').y - getInnerSize().height)+1;
	}
	cuX += (endX - getScrollLeft())/frms;
	if(cuX < 0){cuX = 0;}
	cuY +=(endY - getScrollTop())/frms;
	if(cuY < 0){cuY = 0;}
	var posiX = Math.floor(cuX);
	var posiY = Math.floor(cuY);
	window.scrollTo(posiX,posiY);
	if(posiX != endX || posiY != endY){
	timeID = setTimeout("pageScroll("+endX+","+endY+","+frms+","+cuX+","+cuY+")",10);
	}
}

// change image
var easySwapImg = {
	main : function() {
		var img = document.images, ipt = document.getElementsByTagName('input'), i, preLoadImg = [];
		// img elements
		for (i = 0; i <img.length; i++) {
			if ((img[i].src.match(/.*_off\./))||(img[i].style.filter)){
				preLoadImg[preLoadImg.length] = new Image;
				preLoadImg[preLoadImg.length-1].src = img[i].src.replace('_off.', '_ov.');

				img[i].onmouseover = easySwapImg.over;
				img[i].onmouseout  = easySwapImg.out;
				try {img[i].addEventListener('click', easySwapImg.click, false);}
				catch(e){img[i].attachEvent('onclick', (function(el){return function(){easySwapImg.click.call(el);};})(img[i]));}
			}
		}
		// input[image] elements
		for (i = 0; i <ipt.length; i++) {
			if ((ipt[i].src.match(/.*_off\./))&&(ipt[i].getAttribute('type')=='image')){
				preLoadImg[preLoadImg.length] = new Image;
				preLoadImg[preLoadImg.length-1].src = img[i].src.replace('_off.', '_ov.');

				ipt[i].onmouseover = easySwapImg.over;
				ipt[i].onmouseout  = easySwapImg.out;
				try {ipt[i].addEventListener('click', easySwapImg.click, false);}
				catch(e){ipt[i].attachEvent('onclick', (function(el){return function(){easySwapImg.click.call(el);};})(ipt[i]));}
			}
		}
	}
	,
	
	over : function() {
		var imgSrc, preLoadImgSrc;
		if((this.style.filter)&&(this.style.filter.match(/_off\.png/)))//(IE5.5-6 && png)
			this.style.filter = this.style.filter.replace('_off.png', '_ov.png');
		else
			this.src = this.src.replace('_off.', '_ov.');
	},

	out : function(){
		if((this.style.filter)&&(this.style.filter.match(/_ov\.png/)))//(IE5.5-6 && png)
			this.style.filter = this.style.filter.replace('_ov.png', '_off.png');
		else
			this.src = this.src.replace('_ov.', '_off.');
	},
	
	click : function(){
		if((this.style.filter)&&(this.style.filter.match(/_ov\.png/)))//(IE5.5-6 && png)
			this.style.filter = this.style.filter.replace('_ov.png', '_off.png');
		else
			this.src = this.src.replace('_ov.', '_off.');
	},

	addEvent : function(){
		try {
			window.addEventListener('load', this.main, false);
		} catch (e) {
			window.attachEvent('onload', this.main);
		}
	}
}

easySwapImg.addEvent();


//////////////////////////////
// Footer ELEMENTS
//////////////////////////////

function commonFooter(){
document.write('<div id="footer"><div id="footer_in">' +
'<ul>' +
'<li>原　哲史　tetsushi Hara</li>' +
'</ul>' +
'<div class="copy">&copy;&nbsp;2010 CHAMELEON.</div>' +
'</div></div>')
}


