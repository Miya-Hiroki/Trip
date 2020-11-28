<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>中国地方観光情報ナビ</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="css/base.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="FlexSlider/flexslider.css" type="text/css" />
<!-- jQuery読み込み -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- flexsliderの読み込み（スライド機能） -->
<script src="FlexSlider/jquery.flexslider.js"></script>
<script type="text/javascript" charset="utf-8">
	//FlexSlider
	$(window).load(function() {
		$('.flexslider').flexslider();
		$('.flexslider').css('width', '90%');
		$('.flexslider').css('height', '50%');
		$('.flexslider .slides li img').css('width', '100%');
		$('.flexslider .slides li img').css('height', '100%');
	});
	var navBottom = 750;
 	$(window).on('scroll',function(){     
	    if($(window).scrollTop() > navBottom){
	        $('#globalMenu').addClass('fixed');   
	    }
	    else{
	        $('#globalMenu').removeClass('fixed');   
	    }
	});
 	$(window).trigger('scroll');
	//季節変更機能の読み込み（スライド機能）
	function season_select(num) {
		var season1 = document.getElementById("season1");
		var season2 = document.getElementById("season2");
		var season3 = document.getElementById("season3");
		var season4 = document.getElementById("season4");
		
		var s1 = document.getElementById("s1");
		var s2 = document.getElementById("s2");
		var s3 = document.getElementById("s3");
		var s4 = document.getElementById("s4");

		if (s1.classList.contains("select")) { s1.classList.remove("select"); }
		if (s2.classList.contains("select")) { s2.classList.remove("select"); }
		if (s3.classList.contains("select")) { s3.classList.remove("select"); }
		if (s4.classList.contains("select")) { s4.classList.remove("select"); }

		if (num == 1) {
			season1.style.display = "block";
			season2.style.display = "none";
			season3.style.display = "none";
			season4.style.display = "none";
			s1.classList.add("select");
		} else if (num == 2) {
			season1.style.display = "none";
			season2.style.display = "block";
			season3.style.display = "none";
			season4.style.display = "none";
			s2.classList.add("select");
		} else if (num == 3) {
			season1.style.display = "none";
			season2.style.display = "none";
			season3.style.display = "block";
			season4.style.display = "none";
			s3.classList.add("select");
		} else if (num == 4) {
			season1.style.display = "none";
			season2.style.display = "none";
			season3.style.display = "none";
			season4.style.display = "block";
			s4.classList.add("select");
		}
	}
</script>
</head>
<body ontouchend class="done scrollTop">
<div id="wrapper">
<header id="header">
	<div class="wrap">
		<h1 id="siteName"><a href="/index.html">
		<a href=""><img class="logo" src="images/Logo/logo.png" alt=""></a>
		</h1>
		<button id="navButton"><i></i><i></i><i></i><span>menu</span></button>
	</div>
</header>
<nav id="nav">
	<div id="globalMenu">
		<div class="wrap">
			<ul>
				<li><a href="/areaguide/index.html">エリアガイド<i><svg><use xlink:href="#iconChevronRight"></use></svg></i></a></li>
				<li><a href="/attractions/index.html">観光・体験<i><svg><use xlink:href="#iconChevronRight"></use></svg></i></a></li>
				<li><a href="/dining/index.html">グルメ<i><svg><use xlink:href="#iconChevronRight"></use></svg></i></a></li>
				<li><a href="/booking/index.html">旅の予約<i><svg><use xlink:href="#iconChevronRight"></use></svg></i></a></li>
				<li><a href="/transport/index.html">アクセス<i><svg><use xlink:href="#iconChevronRight"></use></svg></i></a></li>
			</ul>
		</div>
	</div>
	<!-- InstanceBeginEditable name="nav" --><!-- InstanceEndEditable -->
</nav>
<!--end div#header-->
	<main id="main">
		<div id="hero">
			<div class="flexslider">
				<ul class="slides">
					<li><img class="thumb" src="images/sliders/slider1.jpg" width="640px" height="418px"/></li>
					<li><img class="thumb" src="images/sliders/slider2.jpg" width="640px" height="418px"/></li>
					<li><img class="thumb" src="images/sliders/slider3.jpg" width="640px" height="418px"/></li>
					<li><img class="thumb" src="images/sliders/slider4.jpg" width="640px" height="418px"/></li>
				</ul>
			</div>
		</div>
	<article id="recommend">
		<header>
			<div class="wrap">
				<h2>季節のおすすめ</h2>
				<div>
					<div>他のシーズンをチェック</div>
					<ul class="tabMenu" style="margin:0px">
						<li class="" onclick="season_select(1);" id="s1">春</li>
						<li class="" onclick="season_select(2);" id="s2">夏</li>
						<li class="" onclick="season_select(3);" id="s3">秋</li>
						<li class="" onclick="season_select(4);" id="s4">冬</li>
					</ul>
				</div>
			</div>
		</header>
		<section class="tabContents" style="select" id="season1">
			<div class="wrap">
				<h3>春</h3>
				<div>
<?php
$dl = <<<EOF
					<dl>
						<dt><i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
							</svg></i>@@観光地@@</dt>
						<dd><div class="thumb"><img class="" src="@@イメージ@@"></div></dd>
						<dd><a href="" target="_self">詳細はこちら</a></dd>
					</dl>
EOF;
					include("register/db_config.php");
					$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
					$seazon = "春";
					if ($link) {
						$sql = "select subject,filecontents from trip_season where season = '".$seazon."' order by season_sequence";
					    if($result = mysqli_query($link,$sql)){
					      foreach($result as $row) {
					      	echo str_replace("@@イメージ@@", substr($row['filecontents'],3),str_replace("@@観光地@@", $row['subject'], $dl)); //substrは../imagesの最初の3文字を削除する。
					      }
					      mysqli_free_result($result); //メモリの解放
					    }
					}
?>
				</div>
			</div>
		</section>
		
		<section class="tabContents" style="display: none;"  id="season2">
			<div class="wrap">
				<h3>夏</h3>
				<div>
				<?php
				$seazon = "夏";
				if ($link) {
					$sql = "select subject,filecontents from trip_season where season = '".$seazon."'";
				    if($result = mysqli_query($link,$sql)){
				      foreach($result as $row) {
				      	echo str_replace("@@イメージ@@", substr($row['filecontents'],3),str_replace("@@観光地@@", $row['subject'], $dl));
				      }
				      mysqli_free_result($result);
				    }
				}
				?>
				</div>
			</div>
		</section>
		<section class="tabContents" style="display: none;"  id="season3">
			<div class="wrap">
				<h3>秋</h3>
				<div>
				<?php
				$seazon = "秋";
				if ($link) {
					$sql = "select subject,filecontents from trip_season where season = '".$seazon."'";
				    if($result = mysqli_query($link,$sql)){
				      foreach($result as $row) {
				      	echo str_replace("@@イメージ@@", substr($row['filecontents'],3),str_replace("@@観光地@@", $row['subject'], $dl));
				      }
				      mysqli_free_result($result);
				    }
				}
				?>
				</div>
			</div>
		</section>
		
		<section class="tabContents" style="display: none;"  id="season4">
			<div class="wrap">
				<h3>冬</h3>
				<div>
				<?php
				$seazon = "冬";
				if ($link) {
					$sql = "select subject,filecontents from trip_season where season = '".$seazon."'";
				    if($result = mysqli_query($link,$sql)){
				      foreach($result as $row) {
				      	echo str_replace("@@イメージ@@", substr($row['filecontents'],3),str_replace("@@観光地@@", $row['subject'], $dl));
				      }
				      mysqli_free_result($result);
				    }
				}
				mysqli_close($link);
				?>
				</div>
			</div>
		</section>
	</article>	
    <article id="ranking">
		<div class="wrap">
			<h2>アクセス急上昇ランキング</h2>
			<div>
<?php
$dl = <<<EOF
					<dl>
						<dt>@@観光地@@</dt>
						<dd><div class="thumb"><img class="" src="@@イメージ@@"></div></dd>
						<dd><a href="" target="_self">詳細はこちら</a></dd>
					</dl>
EOF;
					include("register/db_config.php");
					$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
					$seazon = "春";
					if ($link) {
						$sql = "select subject,filecontents from trip_ranking order by ranking";
					    if($result = mysqli_query($link,$sql)){
					      foreach($result as $row) {
					      	echo str_replace("@@イメージ@@", substr($row['filecontents'],3),str_replace("@@観光地@@", $row['subject'], $dl)); //substrは../imagesの最初の3文字を削除する。
					      }
					      mysqli_free_result($result); //メモリの解放
					    }
					}
?>
			</div>
		</div>
	</article>
<footer id="footer">
		<div class="wrap">
		  <ul>
		  <li class="widget_text widget col-4 widget_custom_html">
		  	<div class="footer-area">
		  		<h3>－各県の観光公式サイト－ </h3>
		  		<div>
					<a href="https://www.okayama-kanko.jp/">岡山県</a>
					<a href="https://www.hiroshima-kankou.com/">広島県</a>
					<a href="https://www.oidemase.or.jp/">山口県</a>
					<a href="https://www.tottori-guide.jp/">鳥取県</a>
					<a href="https://www.kankou-shimane.com/">島根県</a>
		  		</div>
		  		<br>
            </div>
		 </li>
		 <li>
		  <h3 class="footerTitle">－ お問い合わせ －</h3>
		   <div class="social-media">
             <span class="mr_social_sharing"><a href="https://www.facebook.com/tabijikan.jp" target="_blank" rel="noopener noreferrer"><img src="https://i0.wp.com/tabijikan.jp/wp-content/uploads/2018/02/ico_facebook.png?w=702&amp;ssl=1" class="nopin no-display appear" alt="Friend me on Facebook" title="Friend me on Facebook" data-recalc-dims="1"></a></span><span class="mr_social_sharing"><a href="https://twitter.com/tabijikan_jp" target="_blank" rel="noopener noreferrer"><img src="https://i1.wp.com/tabijikan.jp/wp-content/uploads/2018/02/ico_twitter.png?w=702&amp;ssl=1" class="nopin no-display appear" alt="Follow me on Twitter" title="Follow me on Twitter" data-recalc-dims="1"></a></span><span class="mr_social_sharing"><a href="https://feedly.com/i/subscription/feed%2Fhttps%3A%2F%2Ftabijikan.jp%2Ffeed%2F" target="_blank" rel="noopener noreferrer"><img src="https://i2.wp.com/tabijikan.jp/wp-content/uploads/2018/02/ico_feedly.png?w=702&amp;ssl=1" class="nopin no-display appear" alt="RSS Feed" title="RSS Feed" data-reclc-dims="1"></a></span>
           </div>
         </li>
		 <li class="widget col-4 bunyad-about">	
		  <h3 class="widgettitle">－ 自由旅について －</h3>		
		   <div class="about-widget">
			<p>「自由旅」は旅好きの筆者が実際に現地を訪問して、皆様にお勧めしたい穴場スポット〜定番の観光名所、地域の絶品グルメなど、日本の魅力を今一度お伝えするための情報サイトです。</p>
		   </div>
		</li>		
		</ul>
		
		</div>
		<div class="lowerFooter">
				<p>Copyright＠2020 自由旅. All Rights Reserved.</p>
		</div>
    </main>
</footer>
</div>
<script>
//初期設定の季節は春
season_select(1);
//ハンバーガーメニューの設定
$(function(){
	$('#navButton').wrapInner('<span></span>');
	$('#navButton').prepend('<i></i><i></i><i></i>');
	$('#navButton').click(function(){
	$('body').toggleClass('nav');
	});
	$('body').on('touchstart', onTouchStart); //指が触れたか検知
	$('body').on('touchmove', onTouchMove); //指が動いたか検知
	$('body').on('touchend', onTouchEnd); //指が離れたか検知
	//スワイプ開始時の横方向の座標を格納
	var direction, position;
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
	
</script>
</body>
</html>