/*!
 * headroom.js v0.4.0 - Give your page some headroom. Hide your header until you need it
 * Copyright (c) 2014 Nick Williams - http://wicky.nillia.ms/headroom.js
 * License: MIT
 */

!function(a,b){"use strict";function c(a){this.callback=a,this.ticking=!1}function d(a){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var b,c,e=a||{};for(c=1;c<arguments.length;c++){var f=arguments[c]||{};for(b in f)e[b]="object"==typeof e[b]?d(e[b],f[b]):e[b]||f[b]}return e}function e(a,b){b=d(b,e.options),this.lastKnownScrollY=0,this.elem=a,this.debouncer=new c(this.update.bind(this)),this.tolerance=b.tolerance,this.classes=b.classes,this.offset=b.offset,this.initialised=!1,this.onPin=b.onPin,this.onUnpin=b.onUnpin}var f={bind:!!function(){}.bind,classList:"classList"in b.documentElement,rAF:!!(a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame)};a.requestAnimationFrame=a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame,c.prototype={constructor:c,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},e.prototype={constructor:e,init:function(){return e.cutsTheMustard?(this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this):void 0},destroy:function(){var b=this.classes;this.initialised=!1,a.removeEventListener("scroll",this.debouncer,!1),this.elem.classList.remove(b.unpinned,b.pinned,b.initial)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,a.addEventListener("scroll",this.debouncer,!1))},unpin:function(){var a=this.elem.classList,b=this.classes;(a.contains(b.pinned)||!a.contains(b.unpinned))&&(a.add(b.unpinned),a.remove(b.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var a=this.elem.classList,b=this.classes;a.contains(b.unpinned)&&(a.remove(b.unpinned),a.add(b.pinned),this.onPin&&this.onPin.call(this))},getScrollY:function(){return void 0!==a.pageYOffset?a.pageYOffset:(b.documentElement||b.body.parentNode||b.body).scrollTop},getViewportHeight:function(){return a.innerHeight||b.documentElement.clientHeight||b.body.clientHeight},getDocumentHeight:function(){var a=b.body,c=b.documentElement;return Math.max(a.scrollHeight,c.scrollHeight,a.offsetHeight,c.offsetHeight,a.clientHeight,c.clientHeight)},isOutOfBounds:function(a){var b=0>a,c=a+this.getViewportHeight()>this.getDocumentHeight();return b||c},toleranceExceeded:function(a){return Math.abs(a-this.lastKnownScrollY)>=this.tolerance},shouldUnpin:function(a,b){var c=a>this.lastKnownScrollY,d=a>=this.offset;return c&&d&&b},shouldPin:function(a,b){var c=a<this.lastKnownScrollY,d=a<=this.offset;return c&&b||d},update:function(){var a=this.getScrollY(),b=this.toleranceExceeded(a);this.isOutOfBounds(a)||(this.shouldUnpin(a,b)?this.unpin():this.shouldPin(a,b)&&this.pin(),this.lastKnownScrollY=a)}},e.options={tolerance:0,offset:0,classes:{pinned:"headroom--pinned",unpinned:"headroom--unpinned",initial:"headroom"}},e.cutsTheMustard="undefined"!=typeof f&&f.rAF&&f.bind&&f.classList,a.Headroom=e}(window,document);
(function(e){if(!e)return;e.fn.headroom=function(t){return this.each(function(){var n=e(this),r=n.data("headroom"),i=typeof t=="object"&&t;i=e.extend(!0,{},Headroom.options,i),r||(r=new Headroom(this,i),r.init(),n.data("headroom",r)),typeof t=="string"&&r[t]()})},e("[data-headroom]").each(function(){var t=e(this);t.headroom(t.data())})})(window.Zepto||window.jQuery);

$(document).ready(function() {

	windowWidth  = $(window).width();
	windowHeight = $(window).height();
	infoWidth    = $('.info').width();
	loginHeight  = $('.login').height();

    $('.header .logo').hover(function(){
    	if($('.header img').is(':visible') && $('.header hgroup').is(':hidden'))
    	{
    		$('.header img').fadeOut(300,function(){ $('.header hgroup').fadeIn(300); });
    	}
    });

    $('.header .logo').mouseleave(function(){
    	if($('.header img').is(':hidden') && $('.header hgroup').is(':visible'))
    	{
    		$('.header hgroup').fadeOut(300,function(){ $('.header img').fadeIn(300); });
    	}
    });

    $('.home').click(function(){
    		$('.header').animate({ left: windowWidth + 20 }, 'slow', function(){ $('.main-menu, .content, footer').fadeIn('slow') });
    		
    });

    var delayTime = [];
    $('.main-menu li:has(ul)').each(function(index) {
        $(this).hover(function() {
            var _self = this;
            delayTime[index] = setTimeout(function() {
                $(_self).find('ul:eq(0)').slideDown(200)
            },
            400)
        },
        function() {
            clearTimeout(delayTime[index]);
            $('ul', this).slideUp(200)
        })
    });

    $('.main-menu .search').click(function(){
    	if($('.main-menu .search-area').innerWidth() < 100)
    		$('.main-menu .search-area').animate({padding:'5px 10px', margin:'5px 0', width:160}).focus();
    	else
    		$('.main-menu .search-area').animate({padding:0, margin:0, width:0});
    });

    $('.info').css({'left': -infoWidth});
    $('.login').css({'top': -loginHeight - 100});

    $(".logo").click(function(){
    	if($('.info').css('left') == '0px')
    	{
    		$('.info').animate({left: -infoWidth},'fast');
    	}
    	else
    	{
    		$('.info').animate({left: 0},'fast');
    	}	
    });

    $(".social").click(function(){
    	if($('.login').css('top') == '0px')
    	{
    		$('.login').animate({top: -loginHeight - 100},'fast');
    	}
    	else
    	{
    		$('.login').animate({top: 0},'fast');
    	}	
    });

    $(".main-menu").headroom({
    	offset : 200,
		classes : {
			initial: "animated",
			pinned: "slideDown",
			unpinned: "slideUp"
		}
    });

    $('.content').click(function(){
    	$('.info').animate({left: -infoWidth},'fast');
    	$('.main-menu .search-area').animate({padding:0, margin:0, width:0});
    	$('.login').animate({top: -loginHeight - 100},'fast');
    });

    $('#totop').click(function() {
	        $('body,html').animate({ scrollTop: 0 },500);
	});
	$('#tobottom').click(function() {
			docHeight    = $(document).height();
	        $('body,html').animate({ scrollTop: docHeight },500);
	});
	$('#tocomment').click(function() {
			comHeight    = $('#comment').offset().top;
	        $('body,html').animate({ scrollTop: comHeight },500);
	});

    $(window).scroll(function () {
		  
		if($(window).scrollTop() >= 200)
		{
			$('.sorrow').slideDown(200);
		}
		else
		{
			$('.sorrow').slideUp(200);
		}
	});


});