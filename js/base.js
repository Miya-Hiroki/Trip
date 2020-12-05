// JavaScript Document
"use strict";
$(document).ready(function(){
	$('a[href^="#"]').on('click', function(){
		var speed = 400;
		var href = $(this).attr('href');
		var target = $(href == '#' || href == '' ? 'html' : href);
		var offset = target.offset().top;
		$('body,html').animate({
				scrollTop:offset
			}, speed, 'swing');
		return false;
	});
});

// トップへ戻るリンク
$(function(){
	var topBtn = $('#pageTop');
	topBtn.hide();
	$(window).scroll(function (){
		if ($(this).scrollTop() > $(window).height()){
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
});
// ハンバーガーメニュー
$(function(){
	$('#navButton').wrapInner('<span></span>');
	$('#navButton').prepend('<i></i><i></i><i></i>');
	$('#navButton').click(function(){
		$('body').toggleClass('nav');
	});
	$('body').on('touchstart', onTouchStart); //指が触れたか検知
	$('body').on('touchmove', onTouchMove); //指が動いたか検知
	$('body').on('touchend', onTouchEnd); //指が離れたか検知
	var direction, position;
	//スワイプ開始時の横方向の座標を格納
	function onTouchStart(event) {
		position = getPosition(event);
		direction = ''; //一度リセットする
	}
	//スワイプの方向（left／right）を取得
	function onTouchMove(event) {
		if (position - getPosition(event) > 70) { // 70px以上移動しなければスワイプと判断しない
			direction = 'left'; //左と検知
		} else if (position - getPosition(event) < -70){  // 70px以上移動しなければスワイプと判断しない
			direction = 'right'; //右と検知
		}
	}
	//スワイプの動作
	function onTouchEnd(event) {
		if (direction == 'right'){
			//右から
			$('body').removeClass('nav');
		} else if (direction == 'left'){
			//左から
			//$('body').addClass('nav');
		}
	}
	//横方向の座標を取得
	function getPosition(event) {
		return event.originalEvent.touches[0].pageX;
	}
});


// 画像サムネイル化
$(function(){
	$('.thumb').each(function(){
		var classImg = $(this).attr('class');
		if($(this).hasClass('lazyload')){
			//lazysizes.min.jsを読み込む
			var srcImg = $(this).attr('data-src');
			var userAgent = window.navigator.userAgent.toLowerCase();
			if(userAgent.indexOf('msie') >= 0 || userAgent.indexOf('trident') >= 0) {
				//ls.unveilhooks.min.jsを読み込む
				$(this).wrap('<div class="'+classImg+'" style="background-image:url("'+srcImg+'");">');
				$(this).css('opacity','0');
				$(this).removeClass().addClass('lazyload');
			} else {
				$(this).wrap('<div class="'+classImg+'">');
				$(this).removeClass().addClass("lazyload");
			}
			$(this).after('<svg><use xlink:href="#loadingAnimation"></use></svg>')
		} else {
			var srcImg = $(this).attr('src');
			var userAgent = window.navigator.userAgent.toLowerCase();
			if(userAgent.indexOf('msie') >= 0 || userAgent.indexOf('trident') >= 0) {
				$(this).wrap('<div class="'+classImg+'" style="background-image:url('+srcImg+');">');
				$(this).css('opacity','0');
				$(this).removeClass();
			} else {
				$(this).wrap('<div class="'+classImg+'">');
				$(this).removeClass();
			}
		}
	});
});


// TELリンク無効
var ua = navigator.userAgent.toLowerCase();
var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);
if (!isMobile) {
	$('a[href^="tel:"]').on('click', function(e) {
		e.preventDefault();
	});
}


// svgアイコンセット読み込み
$.ajax({
	type: 'get',
		url: window.location.origin+'/common/images/objectSet.svg'
	}).done(function(data) {
	var svg = $(data).find('svg');
		$('html').append(svg);
});
$(function(){
	$('#globalMenu a').append('<i><svg><use xlink:href="#iconChevronRight"></use></svg></i>');
	$('#extraMenu li a').append('<i><svg><use xlink:href="#iconChevronCircleRight"></use></svg></i>');
	$('#localMenu li a').append('<i><svg><use xlink:href="#iconChevronRight"></use></svg></i>');
	$('#localMenu .linkBut').append('<i><svg><use xlink:href="#iconChevronCircleRight"></use></svg></i>');
	$('#selectLanguage dt').append('<i><svg><use xlink:href="#iconChevronCircleRight"></use></svg></i>');
	$('#pagePath a').after('<i><svg><use xlink:href="#iconChevronRight"></use></svg></i>');
	$('#pageTop a').append('<i><svg><use xlink:href="#iconTotop"></use></svg></i>');
	$('#fNav li a').prepend('<i><svg><use xlink:href="#iconChevronRight"></use></svg></i>');
	$('#fFavorite a').prepend('<i><svg><use xlink:href="#iconFavorite"></use></svg></i>');
});


// svgスプライト表示バグ対策
(function(document, window){
	document.addEventListener('DOMContentLoaded', function() {
		var baseUrl = window.location.href
			.replace(window.location.hash, '');
		[].slice.call(document.querySelectorAll('use[*|href]'))
			.filter(function(element) {
				return (element.getAttribute('xlink:href').indexOf('#') === 0);
			})
			.forEach(function(element) {
				element.setAttribute('xlink:href', baseUrl + element.getAttribute('xlink:href'));
			});
	}, false);
}(document, window));


// 読み込み検知
$(window).on('load',function(){
	$('body').removeClass('do');
	$('body').addClass('done');
});


//スクロール検知
$(window).scroll(function(){
	if( $(window).scrollTop() > 0){
		$('body').removeClass('scrollTop');
	} else {
		$('body').addClass('scrollTop');
	}
});
$(function(){
	var timeoutId;
	window.addEventListener('scroll',function(){
		$('body').addClass('scroll');
		clearTimeout(timeoutId);
		timeoutId = setTimeout(function(){
			$('body').removeClass('scroll');
		},100);
	});
});
$(window).scroll(function(){
	$('.animation').each(function(){
		var imgPos = $(this).offset().top;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		if (scroll > imgPos - windowHeight + windowHeight/4){
			$(this).addClass('done');
		} else {
			$(this).removeClass('done');
		}
	});
});


// 言語選択
$(function(){
	$('#selectLanguage dt').click(function(){
		$('#selectLanguage dd').slideUp();
		$(this).removeClass("open");
		if($('#selectLanguage dd').css('display') == 'none'){
			$('#selectLanguage dd').slideDown();
			$(this).addClass("open");
		}
	});
});


// 検索ボックス
$(function(){
	$(".searchBox").hide();
	$(".searchBox.select").show();
	$("#searchSelect li").click(function(){
		var num = $("#searchSelect li").index(this);
		$(".searchBox").hide();
		$(".searchBox").removeClass('select');
		if(!$("#searchKeyword",$(this)).length) {
			$(".searchBox").eq(num).show();
			$(".searchBox").eq(num).addClass('select');
		}
	});
	$(".searchBoxClose").click(function(){
		$(".searchBox").removeClass('select');
		$(".searchBox").hide();
	});
});


// フローティングメニュー
$(function(){
	if(document.URL.match('/attractions/')){
		$('#fFavorite').css('display','block');
	}
	if(document.URL.match('/festivals/')){
		$('#fFavorite').css('display','block');
	}
});
